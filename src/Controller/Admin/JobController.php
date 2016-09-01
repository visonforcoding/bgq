<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * Job Controller
 *
 * @property \App\Model\Table\JobTable $Job
 */
class JobController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->set('job', $this->Job);
    }

    /**
     * View method
     *
     * @param string|null $id Job id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->autoLayout(false);
        $job = $this->Job->get($id, [
            'contain' => ['Admins', 'Industries']
        ]);
        $this->set('job', $job);
        $this->set('_serialize', ['job']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $job = $this->Job->newEntity();
        if ($this->request->is('post')) {
            $job = $this->Job->patchEntity($job, $this->request->data);
            if ($this->Job->save($job)) {
                $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $errors = $job->errors();
                $this->Util->ajaxReturn(['status' => false, 'msg' => getMessage($errors), 'errors' => $errors]);
            }
        }
        $this->set(compact('job'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Job id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $job = $this->Job->get($id, [
            'contain' => ['Industries']
        ]);
        if ($this->request->is(['post', 'put'])) {
            $job = $this->Job->patchEntity($job, $this->request->data);
            if ($this->Job->save($job)) {
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $errors = $job->errors();
                $this->Util->ajaxReturn(false, getMessage($errors));
            }
        }
        $selIndustryIds = [];
        foreach ($job->industries as $industry) {
            $selIndustryIds[] = $industry->id;
        }
        $this->set(compact('job', 'selIndustryIds'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Job id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod('post');
        $id = $this->request->data('id');
        if ($this->request->is('post')) {
            $job = $this->Job->get($id);
            if ($this->Job->delete($job)) {
                $this->Util->ajaxReturn(true, '删除成功');
            } else {
                $errors = $job->errors();
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
        $sort = 'Job.' . $this->request->data('sidx');
        $order = $this->request->data('sord');
        $keywords = $this->request->data('keywords');
        $begin_time = $this->request->data('begin_time');
        $end_time = $this->request->data('end_time');
        $where = [];
        if (!empty($keywords)) {
            $where['or'] = [['company like' => "%$keywords%"], ['position like' => "%$keywords%"]];
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(`ctime`) >' => $begin_time], ['date(`ctime`) <' => $end_time]];
        }
        $query = $this->Job->find();
        $query->hydrate(false);
        if (!empty($where)) {
            $query->where($where);
        }
        $nums = $query->count();
        $query->contain(['Admins', 'Industries']);
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
            $where['or'] = [['company like' => "%$keywords%"], ['position like' => "%$keywords%"]];
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(`ctime`) >' => $begin_time], ['date(`ctime`) <' => $end_time]];
        }
        $Table = $this->Job;
        $column = ['公司',  '联系方式', '分成方式', '招聘职位', '薪资范围', '工作地点',  '录入时间'];
        $query = $Table->find();
        $query->hydrate(false);
        $query->select(['company', 'contact', 'earnings', 'position', 'salary', 'address', 'create_time']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = '招聘信息_' . date('Y-m-d') . '.xls';
        $this->loadComponent('Export');
        $this->Export->phpexcelExport($filename, $column, $res);
    }
    
    /**
     * 标记通过
     */
    public function check(){
        $id = $this->request->data('id');
        $job = $this->Job->get($id);
        $job->is_finish = $job->is_finish == '1'?'0':'1';
        if($this->Job->save($job)){
            $this->Util->ajaxReturn(true,'保存成功');
        }else{
            $this->Util->ajaxReturn(false,'保存失败');
        }
    }

}
