<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * Withdraw Controller
 *
 * @property \App\Model\Table\WithdrawTable $Withdraw
 */
class WithdrawController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        if ($this->request->query('do')) {
            $this->set('do', 'check');
        }
        $this->set('withdraw', $this->Withdraw);
    }

    /**
     * View method
     *
     * @param string|null $id Withdraw id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->autoLayout(false);
        $withdraw = $this->Withdraw->get($id, [
            'contain' => ['Users']
        ]);
        $this->set('withdraw', $withdraw);
        $this->set('_serialize', ['withdraw']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $withdraw = $this->Withdraw->newEntity();
        if ($this->request->is('post')) {
            $withdraw = $this->Withdraw->patchEntity($withdraw, $this->request->data);
            if ($this->Withdraw->save($withdraw)) {
                $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $errors = $withdraw->errors();
                $this->Util->ajaxReturn(['status' => false, 'msg' => getMessage($errors), 'errors' => $errors]);
            }
        }
        $users = $this->Withdraw->Users->find('list', ['limit' => 200]);
        $this->set(compact('withdraw', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Withdraw id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $withdraw = $this->Withdraw->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['post', 'put'])) {
            $withdraw = $this->Withdraw->patchEntity($withdraw, $this->request->data);
            if ($this->Withdraw->save($withdraw)) {
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $errors = $withdraw->errors();
                $this->Util->ajaxReturn(false, getMessage($errors));
            }
        }
        $users = $this->Withdraw->Users->find('list', ['limit' => 200]);
        $this->set(compact('withdraw', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Withdraw id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod('post');
        $id = $this->request->data('id');
        if ($this->request->is('post')) {
            $withdraw = $this->Withdraw->get($id);
            if ($this->Withdraw->delete($withdraw)) {
                $this->Util->ajaxReturn(true, '删除成功');
            } else {
                $errors = $withdraw->errors();
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
        $sort = 'Withdraw.' . $this->request->data('sidx');
        $order = $this->request->data('sord');
        $keywords = $this->request->data('keywords');
        $begin_time = $this->request->data('begin_time');
        $end_time = $this->request->data('end_time');
        $status = $this->request->data('status');
        $where = [];
        if (is_numeric($status)) {
            $where = ['Withdraw.status' => $status];
        }
        if($this->request->query('do')=='check'&&$status===NULL){
            $where = ['Withdraw.status' => 0];
        }
        if (!empty($keywords)) {
            $where['username like'] = "%$keywords%";
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(`create_time`) >' => $begin_time], ['date(`create_time`) <' => $end_time]];
        }
        $query = $this->Withdraw->find();
        $query->hydrate(false);
        if (!empty($where)) {
            $query->where($where);
        }
        $nums = $query->count();
        $query->contain(['Users', 'Admin']);
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
        $status = $this->request->data('status');
        $where = [];
        if (is_numeric($status)) {
            $where = ['Withdraw.status' => $status];
        }
        if($this->request->query('do')=='check'&&$status===NULL){
            $where = ['Withdraw.status' => 0];
        }
        if (!empty($keywords)) {
            $where[' username like'] = "%$keywords%";
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(`ctime`) >' => $begin_time], ['date(`ctime`) <' => $end_time]];
        }
        $Table = $this->Withdraw;
        $column = ['对象id', '提现金额', '银行卡号', '银行', '持卡人姓名', '手续费', '备注', '状态,0未审核，1审核通过', 'create_time', 'update_time'];
        $query = $Table->find();
        $query->hydrate(false);
        $query->select(['user_id', 'amount', 'cardno', 'bank', 'truename', 'fee', 'remark', 'status', 'create_time', 'update_time']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = 'Withdraw_' . date('Y-m-d') . '.csv';
        \Wpadmin\Utils\Export::exportCsv($column, $res, $filename);
    }

    /**
     * 审核通过
     * 1。该记录状态更改
     * 2。流水记录状态更改
     */
    public function pass() {
        $id = $this->request->data('id');
        $withdraw = $this->Withdraw->get($id);
        $withdraw->status = 1;
        $withdraw->admin_id = $this->_user->id;
        $WithdrawTable = $this->Withdraw;
        $transRes = $this->Withdraw->connection()->transactional(function()use($withdraw, $WithdrawTable) {
            $FlowTable = \Cake\ORM\TableRegistry::get('Flow');
            $flow = $FlowTable->find()->where(['relate_id' => $withdraw->id, 'status' => 0])->first();
            $flow->status = 1;
            return $FlowTable->save($flow) && $WithdrawTable->save($withdraw);
        });
        if ($transRes) {
            $this->Util->ajaxReturn(true, '保存成功');
        } else {
            $this->Util->ajaxReturn(false, '保存失败');
        }
    }

    /**
     * 审核不通过
     * 1。该记录状态更改，记录失败原因
     * 2。流水记录状态更改
     * 3.返回余额
     * 4.生成退回流水
     */
    public function unpass() {
        $id = $this->request->data('id');
        $remark = $this->request->data('remark');
        $withdraw = $this->Withdraw->get($id);
        $withdraw->status = 2; //不通过状态
        $withdraw->remark = $remark; //不通过理由
        $withdraw->admin_id = $this->_user->id;
        $WithdrawTable = $this->Withdraw;
        $transRes = $this->Withdraw->connection()->transactional(function()use($withdraw, $WithdrawTable) {
            $FlowTable = \Cake\ORM\TableRegistry::get('Flow');
            $flow = $FlowTable->find()->where(['relate_id' => $withdraw->id, 'status' => 0])->first();
            $flow->status = 2; //记录作废
            $UserTable = \Cake\ORM\TableRegistry::get('User');
            $user = $UserTable->get($withdraw->user_id);
            $preAmount = $user->money;
            $user->money += $withdraw->amount; //金额退回
            $backFlow = $FlowTable->newEntity([
                'user_id' => $withdraw->user_id,
                'type' => 4,
                'type_msg' => '提现失败退回',
                'income' => 1,
                'relate_id' => $withdraw->id,
                'amount' => $withdraw->amount,
                'pre_amount' => $preAmount,
                'after_amount' => $user->money,
                'status' => 1,
                'remark' => '用户提现失败退回'
            ]);
            return $FlowTable->save($flow) && $WithdrawTable->save($withdraw) && $UserTable->save($user) && $FlowTable->save($backFlow);
        });
        if ($transRes) {
            //消息
            $this->loadComponent('Business');
            $this->Business->usermsg('-1', $withdraw->user_id, '提现消息', '您的体现审核不通过！原因为：' . $remark, 10, $id);
            $this->Util->ajaxReturn(true, '保存成功');
        } else {
            $this->Util->ajaxReturn(false, '保存失败');
        }
    }

}
