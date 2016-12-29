<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * Mentor Controller
 *
 * @property \App\Model\Table\MentorTable $Mentor
 */
class MentorController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->set('mentor', $this->Mentor);
    }

    /**
     * View method
     *
     * @param string|null $id Mentor id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->autoLayout(false);
        $mentor = $this->Mentor->get($id, [
            'contain' => ['Class', 'MentorSubscribe']
        ]);
        $this->set('mentor', $mentor);
        $this->set('_serialize', ['mentor']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $mentor = $this->Mentor->newEntity();
        if ($this->request->is('post')) {
            $mentor = $this->Mentor->patchEntity($mentor, $this->request->data);
            if ($this->Mentor->save($mentor)) {
                $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $errors = $mentor->errors();
                $this->Util->ajaxReturn(['status' => false, 'msg' => getMessage($errors), 'errors' => $errors]);
            }
        }
        $this->set(compact('mentor'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Mentor id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $mentor = $this->Mentor->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['post', 'put'])) {
            $mentor = $this->Mentor->patchEntity($mentor, $this->request->data);
            if ($this->Mentor->save($mentor)) {
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $errors = $mentor->errors();
                $this->Util->ajaxReturn(false, getMessage($errors));
            }
        }
        $this->set(compact('mentor'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Mentor id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod('post');
        $id = $this->request->data('id');
        if ($this->request->is('post')) {
            $mentor = $this->Mentor->get($id);
            $mentor->is_del = 1;
            if ($this->Mentor->save($mentor)) {
                $this->Util->ajaxReturn(true, '删除成功');
            } else {
                $errors = $mentor->errors();
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
        $sort = 'Mentor.' . $this->request->data('sidx');
        $order = $this->request->data('sord');
        $keywords = $this->request->data('keywords');
        $begin_time = $this->request->data('begin_time');
        $end_time = $this->request->data('end_time');
        $where = [];
        $where['Mentor.is_del'] = 0;
        if (!empty($keywords)) {
//            $where['name like'] = "%$keywords%";
            $where['or'] = [
                'Mentor.name like' => "%$keywords%",
                'Mentor.company like' => "%$keywords%",
                'Mentor.position like' => "%$keywords%",
            ];
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['Mentor.create_time >' => $begin_time], ['Mentor.create_time <' => $end_time]];
        }
        $query = $this->Mentor->find();
        $query->hydrate(false);
        if (!empty($where)) {
            $query->where($where);
        }
        $query->contain(['Classes'=>function($q){
            return $q->where(['Classes.is_del'=>0]);
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
        $Table = $this->Mentor;
        $column = ['导师姓名', '导师公司', '导师职位', '导师介绍', '添加时间'];
        $query = $Table->find();
        $query->hydrate(false);
        $query->select(['name', 'company', 'position', 'introduce', 'create_time']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = '导师数据_' . date('Y-m-d') . '.xls';
        $this->loadComponent('Export');
        $this->Export->phpexcelExport($filename, $column, $res);
    }

}
