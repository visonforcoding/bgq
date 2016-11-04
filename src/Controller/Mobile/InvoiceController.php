<?php

/**
 * @date : 2016-5-5
 * @author : Wash Cai <1020183302@qq.com>
 */

namespace App\Controller\Mobile;

use Wpadmin\Utils\Util;
use PhpParser\Node\Stmt\Switch_;
use App\Controller\Mobile\AppController;
/**
 * Activity Controller  活动
 *
 * @property \App\Model\Table\ActivityTable $Activity
 * @property \App\Controller\Component\BusinessComponent $Business
 * @property \App\Controller\Component\PushComponent $Push
 */
class InvoiceController extends AppController {
    
    /**
     * 发票管理
     */
    public function index(){
        $this->handCheckLogin();
        if($this->request->is('post')){
            $data = $this->request->data;
            $order_id['_ids'] = array_filter($data['order_id']['_ids']);
            $this->request->session()->write('reg.invoice_order_id', $order_id);
            return $this->Util->ajaxReturn(true);
        }
        $this->set([
            'pageTitle' => '发票管理',
        ]);
    }
    
    /**
     * 获取订单信息
     */
    public function getOrder(){
        $user_id = $this->user->id;
        $OrderTable = \Cake\ORM\TableRegistry::get('order');
        $order = $OrderTable
                ->find()
                ->contain(['Activityapplys', 'Activityapplys.Activities'=>function($q){
                    return $q->where(['is_invoice'=>1, 'Activities.status'=>1]);
                }])
                ->notMatching('InvoiceOrders')
                ->where(['Lmorder.user_id'=>$user_id, 'Lmorder.status'=>1])
                ->toArray();
        if($order !== false){
            return $this->Util->ajaxReturn(['status'=>true, 'data'=>$order]);
        } else {
            return $this->Util->ajaxReturn(false, '系统错误');
        }
    }
    
    /**
     * 填写发票信息
     */
    public function completeInfo(){
        $this->handCheckLogin();
        $UserTable = \Cake\ORM\TableRegistry::get('user');
        $user = $UserTable->get($this->user->id, [
            'fields' => ['id', 'truename', 'company', 'phone']
        ]);
        $order_id = $this->request->session()->read('reg.invoice_order_id');
        $OrderTable = \Cake\ORM\TableRegistry::get('order');
        $order = $OrderTable->find()->where(['id in'=>$order_id['_ids']])->toArray();
        $invoice_money = 0;
        foreach ($order as $k=>$v){
            $invoice_money += $v['fee'];
        }
        $user->invoice_money = $invoice_money;
        $this->set([
            'user'=>$user,
            'pageTitle'=>'开具发票',
        ]);
    }
    
    /**
     * 保存发票信息
     */
    public function saveInvoice(){
        if($this->request->is('post')){
            $data = $this->request->data;
            foreach($data as $k=>$v){
                $v = trim($v);
                if(!$v){
                    return $this->Util->ajaxReturn(false, '请填写全部内容');
                }
            }
            $order_id['invoice_orders'] = $this->request->session()->read('reg.invoice_order_id');
            if(empty($order_id)){
                return $this->Util->ajaxReturn(false, '请不要重复提交');
            }
            $InvoiceOrderTable = \Cake\ORM\TableRegistry::get('invoice_order');
            $order = $InvoiceOrderTable->find()->where(['order_id in'=>$order_id['invoice_orders']['_ids']])->toArray();
            if(!empty($order)){
                return $this->Util->ajaxReturn(false, '请不要重复提交');
            }
            $InvoiceTable = \Cake\ORM\TableRegistry::get('invoice');
            $invoice = $InvoiceTable->newEntity();
            $invoice = $InvoiceTable->patchEntity($invoice, array_merge($data, $order_id));
            $invoice->user_id = $this->user->id;
            $res = $InvoiceTable->save($invoice);
            if($res){
                $this->request->session()->write('reg.invoice_order_id', '');
                return $this->Util->ajaxReturn(true, '提交成功');
            } else {
                return $this->Util->ajaxReturn(false, '提交失败');
            }
        }
    }
    
    /**
     * 提交发票成功
     */
    public function success(){
        $this->set([
            'pageTitle' => '提交成功',
        ]);
    }
    
    /**
     * 开票历史
     */
    public function history(){
        $this->set([
            'pageTitle' => '开票历史',
        ]);
    }
    
    /**
     * 获取发票历史
     */
    public function getInvoice(){
        if($this->request->is('post')){
            $InvoiceTable = \Cake\ORM\TableRegistry::get('invoice');
            $invoice = $InvoiceTable
                    ->find()
                    ->where(['user_id'=>$this->user->id])
                    ->formatResults(function($items){
                        return $items->map(function($item) {
                            $item->create_time = $item->create_time->format('Y-m-d H:i');
                            return $item;
                        });
                    })
                    ->toArray();
            if($invoice){
                return $this->Util->ajaxReturn(['status'=>true, 'data'=>$invoice]);
            } elseif($invoice == []){
                return $this->Util->ajaxReturn(false, '历史为空');
            } else {
                return $this->Util->ajaxReturn(false, '系统错误');
            }
        }
    }
    
    /**
     * 发票详情
     * @param type $id 发票id
     */
    public function detail($id=null){
        if(!$id){
            return $this->Util->ajaxReturn(false, '系统错误');
        }
        $InvoiceTable = \Cake\ORM\TableRegistry::get('invoice');
        $invoice = $InvoiceTable->get($id);
        $invoice->create_time = $invoice->create_time->format('Y-m-d H:i');
        $this->set([
            'pageTitle' => '发票详情',
            'invoice' => $invoice,
        ]);
    }
    
    public function includeOrder($id=NULL){
        if(!$id){
            return $this->Util->ajaxReturn(false, '系统错误');
        }
        $InvoiceOrderTable = \Cake\ORM\TableRegistry::get('invoice_order');
        $invoiceOrder = $InvoiceOrderTable
                ->find()
                ->contain(['Lmorder', 'Lmorder.Activityapplys', 'Lmorder.Activityapplys.Activities'])
                ->where(['invoice_id'=>$id])
                ->toArray();
        $this->set([
            'pageTitle' => '所含订单',
            'order' => $invoiceOrder
        ]);
    }
}