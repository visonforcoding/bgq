<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * LikeLogs Controller
 *
 * @property \App\Model\Table\LikeLogsTable $LikeLogs
 */
class LikeLogsController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadModel('LikeLogs');
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index($id = '') {
        $type = $this->request->query('type');
        $this->set('id', $id);
        if($type){
            $this->set([
                'type'=>$type
            ]);
        }
        $this->set('likeLogs', $this->LikeLogs);
    }

    /**
     * View method
     *
     * @param string|null $id Like Log id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->autoLayout(false);
        $likeLog = $this->LikeLogs->get($id, [
            'contain' => ['Users', 'Relates']
        ]);
        $this->set('likeLog', $likeLog);
        $this->set('_serialize', ['likeLog']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $likeLog = $this->LikeLogs->newEntity();
        if ($this->request->is('post')) {
            $likeLog = $this->LikeLogs->patchEntity($likeLog, $this->request->data);
            if ($this->LikeLogs->save($likeLog)) {
                $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $errors = $likeLog->errors();
                $this->Util->ajaxReturn(['status' => false, 'msg' => getMessage($errors), 'errors' => $errors]);
            }
        }
        $users = $this->LikeLogs->Users->find('list', ['limit' => 200]);
        $relates = $this->LikeLogs->Relates->find('list', ['limit' => 200]);
        $this->set(compact('likeLog', 'users', 'relates'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Like Log id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $likeLog = $this->LikeLogs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['post', 'put'])) {
            $likeLog = $this->LikeLogs->patchEntity($likeLog, $this->request->data);
            if ($this->LikeLogs->save($likeLog)) {
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $errors = $likeLog->errors();
                $this->Util->ajaxReturn(false, getMessage($errors));
            }
        }
        $users = $this->LikeLogs->Users->find('list', ['limit' => 200]);
        $relates = $this->LikeLogs->Relates->find('list', ['limit' => 200]);
        $this->set(compact('likeLog', 'users', 'relates'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Like Log id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod('post');
        $id = $this->request->data('id');
        if ($this->request->is('post')) {
            $likeLog = $this->LikeLogs->get($id);
            if ($this->LikeLogs->delete($likeLog)) {
                $this->Util->ajaxReturn(true, '删除成功');
            } else {
                $errors = $likeLog->errors();
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
        $sort = 'LikeLogs.' . $this->request->data('sidx');
        $order = $this->request->data('sord');
        $keywords = $this->request->data('keywords');
        $begin_time = $this->request->data('begin_time');
        $end_time = $this->request->data('end_time');
        $where = [];
        if (!empty($keywords)) {
            $where['User.`truename` like'] = "%$keywords%";
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['LikeLogs.`create_time` >' => $begin_time], ['LikeLogs.`create_time` <' => $end_time]];
        }
        if ($id) {
            $query = $this->LikeLogs->find()->where(['relate_id' => $id]);
        } else {
            $query = $this->LikeLogs->find();
        }
        $query->hydrate(false);
        if (!empty($where)) {
            $query->where($where);
        }
        $nums = $query->count();
        $type = $this->request->query('type');
        if($type=='1'){
            $contain = 'News';
        }else{
            $contain = 'Activities';
        }
        $query->contain(['Users',$contain]);
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }

        $query->limit(intval($rows))
                ->page(intval($page));
        $res = $query->toArray();
//         debug($res);die;
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
        $Table = $this->LikeLogs;
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
        $filename = 'LikeLogs_' . date('Y-m-d') . '.csv';
        \Wpadmin\Utils\Export::exportCsv($column, $res, $filename);
    }

}
