<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * Course Controller
 *
 * @property \App\Model\Table\CourseTable $Course
 */
class CourseController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $domain = $this->request->scheme().'://'.$this->request->env('SERVER_NAME');
        $this->set(compact('domain'));
        $this->set('course', $this->Course);
    }

    /**
     * View method
     *
     * @param string|null $id Course id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->autoLayout(false);
        $course = $this->Course->get($id, [
            'contain' => ['Class']
        ]);
        $this->set('course', $course);
        $this->set('_serialize', ['course']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $course = $this->Course->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $course = $this->Course->patchEntity($course, $data);
//            if($data['bonus_start_time'] > $data['bonus_end_time']){
//                $this->Util->ajaxReturn(false, '优惠结束时间比开始时间早');
//            }
            if ($this->Course->save($course)) {
                $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $errors = $course->errors();
                $this->Util->ajaxReturn(['status' => false, 'msg' => getMessage($errors), 'errors' => $errors]);
            }
        }
        $this->set(compact('course'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Course id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $course = $this->Course->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['post', 'put'])) {
            $course = $this->Course->patchEntity($course, $this->request->data);
            if ($this->Course->save($course)) {
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $errors = $course->errors();
                $this->Util->ajaxReturn(false, getMessage($errors));
            }
        }
        $this->set(compact('course'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Course id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod('post');
        $id = $this->request->data('id');
        if ($this->request->is('post')) {
            $course = $this->Course->get($id);
            $course->is_del = 1;
            if ($this->Course->save($course)) {
                $this->Util->ajaxReturn(true, '删除成功');
            } else {
                $errors = $course->errors();
                $this->Util->ajaxReturn(true, getMessage($errors));
            }
        }
    }

    /**
     * get jqgrid data 
     *
     * @return json
     */
    public function getDataList() {
        $this->request->allowMethod('ajax');
        $page = $this->request->data('page');
        $rows = $this->request->data('rows');
        $sort = 'Course.' . $this->request->data('sidx');
        $order = $this->request->data('sord');
        $keywords = $this->request->data('keywords');
        $begin_time = $this->request->data('begin_time');
        $end_time = $this->request->data('end_time');
        $where = [];
        $order_sort = ['is_online'=>'desc'];
        $where['Course.is_del'] = 0;
        if (!empty($keywords)) {
            $where['Course.title like'] = "%$keywords%";
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['Course.create_time >' => $begin_time], ['Course.create_time <' => $end_time]];
        }
        $query = $this->Course->find();
        $query->hydrate(false);
        if (!empty($where)) {
            $query->where($where);
        }
        $query->contain(['Classes'=>function($q){
            return $q->where(['Classes.is_del'=>0]);
        }]);
        $nums = $query->count();
        if (!empty($sort) && !empty($order)) {
            $order_sort[$sort] = $order;
        }
        $query->order($order_sort);
        $query->limit(intval($rows))
                ->page(intval($page));
        $res = $query->toArray();
        if (empty($res)) {
            $res = array();
        }
        if ($nums > 0) {
            $total_pages = ceil($nums / $rows);
        } else {
            $total_pages = 0;
        }
        $data = array('page' => $page, 'total' => $total_pages, 'records' => $nums, 'rows' => $res);
        $this->autoRender = false;
        $this->response->type('json');
        echo json_encode($data);
    }

    /**
     * export csv
     *
     * @return csv 
     */
    public function exportExcel() {
        $sort = $this->request->query('sidx');
        $order = $this->request->query('sord');
        $keywords = $this->request->query('keywords');
        $begin_time = $this->request->query('begin_time');
        $end_time = $this->request->query('end_time');
        $where = [];
        if (!empty($keywords)) {
            $where['username like'] = "%$keywords%";
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(`create_time`) >' => $begin_time], ['date(`create_time`) <' => $end_time]];
        }
        $Table = $this->Course;
        $column = ['培训标题', '内容介绍', '培训费用', '优惠费用', '优惠开始时间', '优惠结束时间', '是否上架', '创建时间', '更新时间'];
        $query = $Table->find();
        $query->hydrate(false);
        $query->select(['title', 'abstract', 'fee', 'bonus_fee', 'bonus_start_time', 'bonus_end_time', 'is_online', 'create_time', 'update_time']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = 'Course_' . date('Y-m-d') . '.csv';
        \Wpadmin\Utils\Export::exportCsv($column, $res, $filename);
    }
    
    public function online(){
        if($this->request->is('post')){
            $id = $this->request->data('id');
            $course = $this->Course->get($id);
            $course->is_online = $course->is_online ? 0 : 1;
            $res = $this->Course->save($course);
            if($res){
                return $this->Util->ajaxReturn(TRUE, '修改成功');
            } else {
                return $this->Util->ajaxReturn(false, getMessage($course->errors()));
            }
        }
    }
    
    public function recom(){
        if($this->request->is('post')){
            $id = $this->request->data('id');
            $course = $this->Course->get($id);
            $course->is_recom = $course->is_recom ? 0 : 1;
            $res = $this->Course->save($course);
            if($res){
                return $this->Util->ajaxReturn(TRUE, '修改成功');
            } else {
                return $this->Util->ajaxReturn(false, getMessage($course->errors()));
            }
        }
    }

}
