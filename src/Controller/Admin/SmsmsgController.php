<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * Smsmsg Controller
 *
 * @property \App\Model\Table\SmsmsgTable $Smsmsg
 */
class SmsmsgController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->set('smsmsg', $this->Smsmsg);
    }

    /**
     * View method
     *
     * @param string|null $id Smsmsg id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->autoLayout(false);
        $smsmsg = $this->Smsmsg->get($id, [
            'contain' => []
        ]);
        $this->set('smsmsg', $smsmsg);
        $this->set('_serialize', ['smsmsg']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $smsmsg = $this->Smsmsg->newEntity();
        if ($this->request->is('post')) {
            $smsmsg = $this->Smsmsg->patchEntity($smsmsg, $this->request->data);
            if ($this->Smsmsg->save($smsmsg)) {
                $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $errors = $smsmsg->errors();
                $this->Util->ajaxReturn(['status' => false, 'msg' => getMessage($errors), 'errors' => $errors]);
            }
        }
        $this->set(compact('smsmsg'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Smsmsg id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $smsmsg = $this->Smsmsg->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['post', 'put'])) {
            $smsmsg = $this->Smsmsg->patchEntity($smsmsg, $this->request->data);
            if ($this->Smsmsg->save($smsmsg)) {
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $errors = $smsmsg->errors();
                $this->Util->ajaxReturn(false, getMessage($errors));
            }
        }
        $this->set(compact('smsmsg'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Smsmsg id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod('post');
        $id = $this->request->data('id');
        if ($this->request->is('post')) {
            $smsmsg = $this->Smsmsg->get($id);
            if ($this->Smsmsg->delete($smsmsg)) {
                $this->Util->ajaxReturn(true, '删除成功');
            } else {
                $errors = $smsmsg->errors();
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
        $sort = 'Smsmsg.' . $this->request->data('sidx');
        $order = $this->request->data('sord');
        $keywords = $this->request->data('keywords');
        $begin_time = $this->request->data('begin_time');
        $end_time = $this->request->data('end_time');
        $where = [];
        if (!empty($keywords)) {
            $where['OR'] = [
                ['Users.`truename` like' => "%$keywords%"],
                ['Users.`phone` like' => "%$keywords%"],
            ];
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(`create_time`) >' => $begin_time], ['date(`create_time`) <' => $end_time]];
        }
        $query = $this->Smsmsg->find()->contain(['Users'=>function($q){
            return $q->select(['Users.truename', 'Users.phone', 'Users.company', 'Users.position']);
        }]);
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
        $Table = $this->Smsmsg;
        $column = ['手机号', '验证码', 'content', 'create_time'];
        $query = $Table->find();
        $query->hydrate(false);
        $query->select(['phone', 'code', 'content', 'create_time']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = 'Smsmsg_' . date('Y-m-d') . '.csv';
        \Wpadmin\Utils\Export::exportCsv($column, $res, $filename);
    }

}
