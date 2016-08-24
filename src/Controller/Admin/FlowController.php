<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * Flow Controller
 *
 * @property \App\Model\Table\FlowTable $Flow
 */
class FlowController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->set('flow', $this->Flow);
    }

    /**
     * View method
     *
     * @param string|null $id Flow id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->autoLayout(false);
        $flow = $this->Flow->get($id, [
            'contain' => ['Users']
        ]);
        $this->set('flow', $flow);
        $this->set('_serialize', ['flow']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $flow = $this->Flow->newEntity();
        if ($this->request->is('post')) {
            $flow = $this->Flow->patchEntity($flow, $this->request->data);
            if ($this->Flow->save($flow)) {
                $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $errors = $flow->errors();
                $this->Util->ajaxReturn(['status' => false, 'msg' => getMessage($errors), 'errors' => $errors]);
            }
        }
        $users = $this->Flow->Users->find('list', ['limit' => 200]);
        $this->set(compact('flow', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Flow id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $flow = $this->Flow->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['post', 'put'])) {
            $flow = $this->Flow->patchEntity($flow, $this->request->data);
            if ($this->Flow->save($flow)) {
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $errors = $flow->errors();
                $this->Util->ajaxReturn(false, getMessage($errors));
            }
        }
        $users = $this->Flow->Users->find('list', ['limit' => 200]);
        $this->set(compact('flow', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Flow id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod('post');
        $id = $this->request->data('id');
        if ($this->request->is('post')) {
            $flow = $this->Flow->get($id);
            if ($this->Flow->delete($flow)) {
                $this->Util->ajaxReturn(true, '删除成功');
            } else {
                $errors = $flow->errors();
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
        $sort = 'Flow.' . $this->request->data('sidx');
        $order = $this->request->data('sord');
        $keywords = $this->request->data('keywords');
        $begin_time = $this->request->data('begin_time');
        $end_time = $this->request->data('end_time');
        $where = [];
        if (!empty($keywords)) {
            $where['User.truename like'] = "%$keywords%";
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(`create_time`) >' => $begin_time], ['date(`create_time`) <' => $end_time]];
        }
        $query = $this->Flow->find();
        $query->hydrate(false);
        if (!empty($where)) {
            $query->where($where);
        }
        $query->contain(['Users','Buyer']);
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
            $where['and'] = [['date(`create_time`) >' => $begin_time], ['date(`create_time`) <' => $end_time]];
        }
        $Table = $this->Flow;
        $column = ['用户', '关联id', '交易类型', '类型名称', '是否收入1:收入2:支出', '交易金额', '交易前金额', '交易后金额', '交易状态', '备注', '创建时间', '修改时间'];
        $query = $Table->find();
        $query->hydrate(false);
        $query->select(['user_id', 'relate_id', 'type', 'type_msg', 'income', 'amount', 'pre_amount', 'after_amount', 'status', 'remark', 'create_time', 'update_time']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = 'Flow_' . date('Y-m-d') . '.csv';
        \Wpadmin\Utils\Export::exportCsv($column, $res, $filename);
    }

}
