<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * Invoice Controller
 *
 * @property \App\Model\Table\InvoiceTable $Invoice
 */
class InvoiceController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->set('invoice', $this->Invoice);
    }

    /**
     * View method
     *
     * @param string|null $id Invoice id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->autoLayout(false);
        $invoice = $this->Invoice->get($id, [
            'contain' => ['Users']
        ]);
        $this->set('invoice', $invoice);
        $this->set('_serialize', ['invoice']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $invoice = $this->Invoice->newEntity();
        if ($this->request->is('post')) {
            $invoice = $this->Invoice->patchEntity($invoice, $this->request->data);
            if ($this->Invoice->save($invoice)) {
                $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $errors = $invoice->errors();
                $this->Util->ajaxReturn(['status' => false, 'msg' => getMessage($errors), 'errors' => $errors]);
            }
        }
        $users = $this->Invoice->Users->find('list', ['limit' => 200]);
        $invoiceOrders = $this->Invoice->InvoiceOrders->find('list', ['limit' => 200]);
        $this->set(compact('invoice', 'users', 'invoiceOrders'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Invoice id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $invoice = $this->Invoice->get($id, [
            'contain' => ['Users']
        ]);
        if ($this->request->is(['post', 'put'])) {
            $invoice = $this->Invoice->patchEntity($invoice, $this->request->data);
            if ($this->Invoice->save($invoice)) {
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $errors = $invoice->errors();
                $this->Util->ajaxReturn(false, getMessage($errors));
            }
        }
        $users = $this->Invoice->Users->find('list', ['limit' => 200]);
        $invoiceOrders = $this->Invoice->InvoiceOrders->find('list', ['limit' => 200]);
        $this->set(compact('invoice', 'users', 'invoiceOrders'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Invoice id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod('post');
        $id = $this->request->data('id');
        if ($this->request->is('post')) {
            $invoice = $this->Invoice->get($id);
            if ($this->Invoice->delete($invoice)) {
                $this->Util->ajaxReturn(true, '删除成功');
            } else {
                $errors = $invoice->errors();
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
        $sort = 'Invoice.' . $this->request->data('sidx');
        $order = $this->request->data('sord');
        $keywords = $this->request->data('keywords');
        $begin_time = $this->request->data('begin_time');
        $end_time = $this->request->data('end_time');
        $is_VAT = $this->request->data('is_VAT');
        $is_shipment = $this->request->data('is_shipment');
        $where = [];
        if ($is_VAT !== 'all_VAT' && !empty($is_VAT)) {
            $where['is_VAT'] = $is_VAT;
        }
        if ($is_shipment !== 'all_shipment' && !empty($is_shipment)) {
            $where['is_shipment'] = $is_shipment;
        }
        if (!empty($keywords)) {
            $where['or'] = [
                'Users.truename like' => "%$keywords%",
                'Invoice.company like' => "%$keywords%",
                'Invoice.shipment_number like' => "%$keywords%",
            ];
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['create_time >' => $begin_time], ['create_time <' => $end_time]];
        }
        $query = $this->Invoice->find();
        $query->hydrate(false);
        if (!empty($where)) {
            $query->where($where);
        }
        $query->contain(['Users']);
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
        $Table = $this->Invoice;
        $column = ['用户id', '是否是增值税发票', '公司名称', '总金额', '收件人', '收件人电话', '收件人地址', '纳税人识别号', '公司地址', '公司电话', '开户行', '开户账号', '是否发货', '快递', '快递单号', '创建时间', '更新时间'];
        $query = $Table->find();
        $query->hydrate(false);
        $query->select(['user_id', 'is_VAT', 'company', 'sum', 'recipient', 'recipient_phone', 'recipient_address', 'registration_num', 'company_address', 'company_phone', 'bank', 'bank_account', 'is_shipment', 'shipment_express', 'shipment_number', 'create_time', 'update_time']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = 'Invoice_' . date('Y-m-d') . '.csv';
        \Wpadmin\Utils\Export::exportCsv($column, $res, $filename);
    }

    public function shipment($id = NULL) {
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $InvoiceTable = \Cake\ORM\TableRegistry::get('invoice');
            $invoice = $InvoiceTable->get($id);
            $invoice->shipment_express = $data['shipment_express'];
            $invoice->shipment_number = $data['shipment_number'];
            $invoice->is_shipment = 1;
            $res = $InvoiceTable->save($invoice);
            if($res){
                return $this->Util->ajaxReturn(true, '保存成功');
            } else {
                return $this->Util->ajaxReturn(false, '保存失败');
            }
        }
    }

}
