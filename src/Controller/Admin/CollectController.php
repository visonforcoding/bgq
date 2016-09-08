<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * Collect Controller
 *
 * @property \App\Model\Table\CollectTable $Collect
 */
class CollectController extends AppController {

    public function initialize() {
        parent::initialize();
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index($id = '') {
        $this->set('id', $id);
        $type = $this->request->query('type');
        if($type){
            $this->set([
                'type'=>$type
            ]);
        }
        $this->set('collectLogs', $this->Collect);
    }

    /**
     * View method
     *
     * @param string|null $id Collect Log id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->autoLayout(false);
        $collectLog = $this->Collect->get($id, [
            'contain' => ['Users', 'Activities']
        ]);
        $this->set('collectLog', $collectLog);
        $this->set('_serialize', ['collectLog']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $collectLog = $this->Collect->newEntity();
        if ($this->request->is('post')) {
            $collectLog = $this->Collect->patchEntity($collectLog, $this->request->data);
            if ($this->Collect->save($collectLog)) {
                $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $errors = $collectLog->errors();
                $this->Util->ajaxReturn(['status' => false, 'msg' => getMessage($errors), 'errors' => $errors]);
            }
        }
        $users = $this->Collect->Users->find('list', ['limit' => 200]);
        $activities = $this->Collect->Activities->find('list', ['limit' => 200]);
        $this->set(compact('collectLog', 'users', 'activities'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Collect Log id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $collectLog = $this->Collect->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['post', 'put'])) {
            $collectLog = $this->Collect->patchEntity($collectLog, $this->request->data);
            if ($this->Collect->save($collectLog)) {
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $errors = $collectLog->errors();
                $this->Util->ajaxReturn(false, getMessage($errors));
            }
        }
        $users = $this->Collect->Users->find('list', ['limit' => 200]);
        $activities = $this->Collect->Activities->find('list', ['limit' => 200]);
        $this->set(compact('collectLog', 'users', 'activities'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Collect Log id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod('post');
        $id = $this->request->data('id');
        if ($this->request->is('post')) {
            $collectLog = $this->Collect->get($id);
            if ($this->Collect->delete($collectLog)) {
                $this->Util->ajaxReturn(true, '删除成功');
            } else {
                $errors = $collectLog->errors();
                $this->Util->ajaxReturn(true, getMessage($errors));
            }
        }
    }

    /**
     * get jqgrid data 
     *
     * @return json
     */
    public function getDataList($id = '') {
        $this->request->allowMethod('ajax');
        $page = $this->request->data('page');
        $rows = $this->request->data('rows');
        $sort = 'Collect.' . $this->request->data('sidx');
        $order = $this->request->data('sord');
        $keywords = $this->request->data('keywords');
        $begin_time = $this->request->data('begin_time');
        $end_time = $this->request->data('end_time');
        $where = [];
        if (!empty($keywords)) {
            $where[' username like'] = "%$keywords%";
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['Collect.`create_time` >' => $begin_time], ['Collect.`create_time` <' => $end_time]];
        }
        if ($id) {
            $query = $this->Collect->find()->where(['relate_id' => $id]);
        } else {
            $query = $this->Collect->find();
        }
        $query->hydrate(false);
        $type = $this->request->query('type');
        $type = empty($type)?'0':$type;
        if($type=='1'){
            $contain = 'News';
        }else{
            $contain = 'Activities';
        }
        $where['type'] = $type;
        if (!empty($where)) {
            $query->where($where);
        }
        $nums = $query->count();
        $query->contain(['Users',$contain]);
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
        $sort = $this->request->data('sidx');
        $order = $this->request->data('sord');
        $keywords = $this->request->data('keywords');
        $begin_time = $this->request->data('begin_time');
        $end_time = $this->request->data('end_time');
        $where = [];
        if (!empty($keywords)) {
            $where[' username like'] = "%$keywords%";
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(`ctime`) >' => $begin_time], ['date(`ctime`) <' => $end_time]];
        }
        $Table = $this->Collect;
        $column = ['用户id', '关联id（活动id或资讯id）', '日志内容', '记录时间', '更新时间', '类型值：0：活动；1：资讯'];
        $query = $Table->find();
        $query->hydrate(false);
        $query->select(['user_id', 'relate_id', 'msg', 'create_time', 'update_time', 'type']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = 'Collect_' . date('Y-m-d') . '.csv';
        \Wpadmin\Utils\Export::exportCsv($column, $res, $filename);
    }
}
