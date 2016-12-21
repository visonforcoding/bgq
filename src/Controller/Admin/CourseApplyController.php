<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * CourseApply Controller
 *
 * @property \App\Model\Table\CourseApplyTable $CourseApply
 */
class CourseApplyController extends AppController {
    
    public function initialize() {
        parent::initialize();
        $this->CourseApply = \Cake\ORM\TableRegistry::get('CourseApply');
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index($id=NULL) {
        $this->set([
            'courseApply'=>$this->CourseApply,
            'course_id' => $id
        ]);
    }

    /**
     * View method
     *
     * @param string|null $id Course Apply id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->autoLayout(false);
        $courseApply = $this->CourseApply->get($id, [
            'contain' => ['Courses', 'Users']
        ]);
        $this->set('courseApply', $courseApply);
        $this->set('_serialize', ['courseApply']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add($course_id=NULL) {
        $courseApply = $this->CourseApply->newEntity();
        if ($this->request->is('post')) {
            $courseApply = $this->CourseApply->patchEntity($courseApply, $this->request->data);
            if($course_id){
                $courseApply->course_id = $course_id;
            }
            $courseApply->is_pay = 1;
            $res = $this->CourseApply->save($courseApply);
            if ($res) {
                $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $errors = $courseApply->errors();
                $this->Util->ajaxReturn(['status' => false, 'msg' => getMessage($errors), 'errors' => $errors]);
            }
        }
        $courses = $this->CourseApply->Courses->find('list', ['limit' => 200]);
        $users = $this->CourseApply->Users->find('list', ['limit' => 200]);
        $this->set(compact('courseApply', 'courses', 'users', 'course_id'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Course Apply id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $courseApply = $this->CourseApply->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['post', 'put'])) {
            $courseApply = $this->CourseApply->patchEntity($courseApply, $this->request->data);
            if ($this->CourseApply->save($courseApply)) {
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $errors = $courseApply->errors();
                $this->Util->ajaxReturn(false, getMessage($errors));
            }
        }
        $courses = $this->CourseApply->Courses->find('list', ['limit' => 200]);
        $users = $this->CourseApply->Users->find('list', ['limit' => 200]);
        $this->set(compact('courseApply', 'courses', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Course Apply id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod('post');
        $id = $this->request->data('id');
        if ($this->request->is('post')) {
            $courseApply = $this->CourseApply->get($id);
            if ($this->CourseApply->delete($courseApply)) {
                $this->Util->ajaxReturn(true, '删除成功');
            } else {
                $errors = $courseApply->errors();
                $this->Util->ajaxReturn(true, getMessage($errors));
            }
        }
    }

    /**
     * get jqgrid data 
     *
     * @return json
     */
    public function getDataList($course_id=NULL) {
        $this->request->allowMethod('ajax');
        $page = $this->request->data('page');
        $rows = $this->request->data('rows');
        $sort = 'CourseApply.' . $this->request->data('sidx');
        $order = $this->request->data('sord');
        $keywords = $this->request->data('keywords');
        $begin_time = $this->request->data('begin_time');
        $end_time = $this->request->data('end_time');
        $where = [];
        $where['CourseApply.is_pay'] = 1;
        $where['course_id'] = $course_id;
        if (!empty($keywords)) {
            $where['Users.truename like'] = "%$keywords%";
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['CourseApply.create_time >' => $begin_time], ['CourseApply.create_time <' => $end_time]];
        }
        $query = $this->CourseApply->find();
        $query->hydrate(false);
        if (!empty($where)) {
            $query->where($where);
        }
        $query->contain(['Courses'=>function($q){
            return $q->where(['Courses.is_del'=>0]);
        }, 'Users'=>function($q){
            return $q->where(['Users.enabled'=>1]);
        }]);
        $nums = $query->count();
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }

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
        $Table = $this->CourseApply;
        $column = ['报名用户', '培训id', '评价星数', '是否已付款', '创建时间', '更新时间'];
        $query = $Table->find();
        $query->hydrate(false);
        $query->select(['uid', 'course_id', 'star', 'is_pay', 'create_time', 'update_time']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = '培训报名_' . date('Y-m-d') . '.xls';
        $this->loadComponent('Export');
        $this->Export->phpexcelExport($filename, $column, $res);
    }

}
