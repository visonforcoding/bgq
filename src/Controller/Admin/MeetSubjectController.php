<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * MeetSubject Controller
 *
 * @property \App\Model\Table\MeetSubjectTable $MeetSubject
 */
class MeetSubjectController extends AppController {
    
    public function initialize() {
        parent::initialize();
        $this->loadModel('MeetSubject');
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index($id=null) {
        if($id){
            $this->set('user_id',$id);
        }
        $this->set('meetSubject', $this->MeetSubject);
    }

    /**
     * View method
     * @param string|null $id Meet Subject id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->autoLayout(false);
        $meetSubject = $this->MeetSubject->get($id, [
            'contain' => ['User']
        ]);
        $this->set('meetSubject', $meetSubject);
        $this->set('_serialize', ['meetSubject']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $meetSubject = $this->MeetSubject->newEntity();
        if ($this->request->is('post')) {
            $meetSubject = $this->MeetSubject->patchEntity($meetSubject, $this->request->data);
            $UserTable = \Cake\ORM\TableRegistry::get('User');
            $user = $UserTable->get($this->request->data('user_id'));
            if ($this->MeetSubject->save($meetSubject)) {
                $user->subject_update_time = date('Y-m-d H:i:s');
                $UserTable->save($user);
                $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $errors = $meetSubject->errors();
                $this->Util->ajaxReturn(['status' => false, 'msg' => getMessage($errors), 'errors' => $errors]);
            }
        }
        $user = $this->MeetSubject->User->find('list', ['limit' => 200]);
        $this->set(compact('meetSubject', 'user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Meet Subject id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $meetSubject = $this->MeetSubject->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['post', 'put'])) {
            $meetSubject = $this->MeetSubject->patchEntity($meetSubject, $this->request->data);
            $UserTable = \Cake\ORM\TableRegistry::get('User');
            $user = $UserTable->get($meetSubject->user_id);
            if ($this->MeetSubject->save($meetSubject)) {
                $user->subject_update_time = date('Y-m-d H:i:s');
                $UserTable->save($user);
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $errors = $meetSubject->errors();
                $this->Util->ajaxReturn(false, getMessage($errors));
            }
        }
        $user = $this->MeetSubject->User->find('list', ['limit' => 200]);
        $this->set(compact('meetSubject', 'user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Meet Subject id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod('post');
        $id = $this->request->data('id');
        if ($this->request->is('post')) {
            $meetSubject = $this->MeetSubject->get($id);
            $meetSubject->is_del = 1;
            if ($this->MeetSubject->save($meetSubject)) {
                $this->Util->ajaxReturn(true, '删除成功');
            } else {
                $errors = $meetSubject->errors();
                $this->Util->ajaxReturn(true, getMessage($errors));
            }
        }
    }

    /**
     * get jqgrid data 
     *
     * @return json
     */
    public function getDataList($id=null) {
        $this->request->allowMethod('ajax');
        $page = $this->request->data('page');
        $rows = $this->request->data('rows');
        $sort = 'MeetSubject.' . $this->request->data('sidx');
        $order = $this->request->data('sord');
        $keywords = $this->request->data('keywords');
        $begin_time = $this->request->data('begin_time');
        $end_time = $this->request->data('end_time');
        $where = ['MeetSubject.is_del'=>0];
        if($id){
            $where['MeetSubject.user_id'] = $id;
        }
        if (!empty($keywords)) {
            $where['OR'] = [
                ['User.`truename` like' => "%$keywords%"],
                ['MeetSubject.`title` like' => "%$keywords%"],
            ];
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(`create_time`) >' => $begin_time], ['date(`create_time`) <' => $end_time]];
        }
        $query = $this->MeetSubject->find()->contain(['User']);
        $query->hydrate(false);
        if (!empty($where)) {
            $query->where($where);
        }
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
    public function exportExcel($id=null) {
        $sort = $this->request->data('sidx');
        $order = $this->request->data('sord');
        $keywords = $this->request->data('keywords');
        $begin_time = $this->request->data('begin_time');
        $end_time = $this->request->data('end_time');
        $where = ['MeetSubject.is_del'=>0];
        if($id){
            $where['MeetSubject.user_id'] = $id;
        }
        if (!empty($keywords)) {
            $where['username like'] = "%$keywords%";
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(`ctime`) >' => $begin_time], ['date(`ctime`) <' => $end_time]];
        }
        $Table = $this->MeetSubject;
        $column = ['专家id', '标题', '简介', '类型:1对1,2对多', '约见时间', '价格', '地址', '持续时间', 'create_time', 'update_time'];
        $query = $Table->find();
        $query->hydrate(false);
        $query->select(['user_id', 'title', 'summary', 'type', 'invite_time', 'price', 'address', 'last_time', 'create_time', 'update_time']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = 'MeetSubject_' . date('Y-m-d') . '.csv';
        \Wpadmin\Utils\Export::exportCsv($column, $res, $filename);
    }

}
