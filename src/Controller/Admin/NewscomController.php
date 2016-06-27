<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * Newscom Controller
 *
 * @property \App\Model\Table\NewscomTable $Newscom
 */
class NewscomController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadModel('Newscom');
    }
    
    /**
     * Index method
     *
     * @return void
     */
    public function index($id = '') {
        $this->set('id', $id);
        $this->set('newscom', $this->Newscom);
    }

    /**
     * View method
     *
     * @param string|null $id Newscom id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->autoLayout(false);
        $newscom = $this->Newscom->get($id, [
            'contain' => ['News', 'Users']
        ]);
        $this->set('newscom', $newscom);
        $this->set('_serialize', ['newscom']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $newscom = $this->Newscom->newEntity();
        if ($this->request->is('post')) {
            $newscom = $this->Newscom->patchEntity($newscom, $this->request->data);
            if ($this->Newscom->save($newscom)) {
                $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $errors = $newscom->errors();
                $this->Util->ajaxReturn(['status' => false, 'msg' => getMessage($errors), 'errors' => $errors]);
            }
        }
        $activities = $this->Newscom->Activities->find('list', ['limit' => 200]);
        $users = $this->Newscom->Users->find('list', ['limit' => 200]);
        $replyusers = $this->Newscom->Replyusers->find('list', ['limit' => 200]);
        $this->set(compact('newscom', 'activities', 'users', 'replyusers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Newscom id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $newscom = $this->Newscom->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['post', 'put'])) {
            $newscom = $this->Newscom->patchEntity($newscom, $this->request->data);
            if ($this->Newscom->save($newscom)) {
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $errors = $newscom->errors();
                $this->Util->ajaxReturn(false, getMessage($errors));
            }
        }
        $activities = $this->Newscom->Activities->find('list', ['limit' => 200]);
        $users = $this->Newscom->Users->find('list', ['limit' => 200]);
        $replyusers = $this->Newscom->Replyusers->find('list', ['limit' => 200]);
        $this->set(compact('newscom', 'activities', 'users', 'replyusers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Newscom id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod('post');
        $id = $this->request->data('id');
        if ($this->request->is('post')) {
            $newscom = $this->Newscom->get($id);
            if ($this->Newscom->delete($newscom)) {
                $this->Util->ajaxReturn(true, '删除成功');
            } else {
                $errors = $newscom->errors();
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
        $sort = 'Newscom.' . $this->request->data('sidx');
        $order = $this->request->data('sord');
        $keywords = $this->request->data('keywords');
        $begin_time = $this->request->data('begin_time');
        $end_time = $this->request->data('end_time');
        $where = [];
        if (!empty($keywords)) {
            $where[' Newscom.`body` like'] = "%$keywords%";
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['Newscom.`create_time` >' => $begin_time], ['Newscom.`create_time` <' => $end_time]];
        }
        if ($id) {
            $query = $this->Newscom->find()->where(['news_id' => $id]);
        } else {
            $query = $this->Newscom->find();
        }
        $query->hydrate(false);
        if (!empty($where)) {
            $query->where($where);
        }
        $nums = $query->count();
        $query->contain(['News', 'Users', 'Reply']);
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
        $Table = $this->Newscom;
        $column = ['父id', '用户id', '回复人的id', '活动id', '评论内容', '点赞数', '评论时间'];
        $query = $Table->find();
        $query->hydrate(false);
        $query->select(['pid', 'user_id', 'reply_id', 'activity_id', 'body', 'praise_nums', 'create_time']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = 'Newscom_' . date('Y-m-d') . '.csv';
        \Wpadmin\Utils\Export::exportCsv($column, $res, $filename);
    }

}
