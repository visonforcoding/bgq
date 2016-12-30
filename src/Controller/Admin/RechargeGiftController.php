<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * RechargeGift Controller
 *
 * @property \App\Model\Table\RechargeGiftTable $RechargeGift
 */
class RechargeGiftController extends AppController {
    
    public function initialize() {
        parent::initialize();
        $this->RechargeGift = \Cake\ORM\TableRegistry::get('RechargeGift');
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->set('rechargeGift', $this->RechargeGift);
    }
    
    
    public function rechargeList(){
        $this->set('order', \Cake\ORM\TableRegistry::get('Order'));
    }

    /**
     * View method
     *
     * @param string|null $id Recharge Gift id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->autoLayout(false);
        $rechargeGift = $this->RechargeGift->get($id, [
            'contain' => []
        ]);
        $this->set('rechargeGift', $rechargeGift);
        $this->set('_serialize', ['rechargeGift']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $rechargeGift = $this->RechargeGift->newEntity();
        if ($this->request->is('post')) {
            $rechargeGift = $this->RechargeGift->patchEntity($rechargeGift, $this->request->data);
            if ($this->RechargeGift->save($rechargeGift)) {
                $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $errors = $rechargeGift->errors();
                $this->Util->ajaxReturn(['status' => false, 'msg' => getMessage($errors), 'errors' => $errors]);
            }
        }
        $this->set(compact('rechargeGift'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Recharge Gift id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $rechargeGift = $this->RechargeGift->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['post', 'put'])) {
            $rechargeGift = $this->RechargeGift->patchEntity($rechargeGift, $this->request->data);
            if ($this->RechargeGift->save($rechargeGift)) {
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $errors = $rechargeGift->errors();
                $this->Util->ajaxReturn(false, getMessage($errors));
            }
        }
        $this->set(compact('rechargeGift'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Recharge Gift id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod('post');
        $id = $this->request->data('id');
        if ($this->request->is('post')) {
            $rechargeGift = $this->RechargeGift->get($id);
            if ($this->RechargeGift->delete($rechargeGift)) {
                $this->Util->ajaxReturn(true, '删除成功');
            } else {
                $errors = $rechargeGift->errors();
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
        $sort = 'RechargeGift.' . $this->request->data('sidx');
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
        $data = $this->getJsonForJqrid($page, $rows, '', $sort, $order, $where);
        $this->autoRender = false;
        $this->response->type('json');
        echo json_encode($data);
    }
    
    
    public function getList() {
        $this->request->allowMethod('ajax');
        $page = $this->request->data('page');
        $rows = $this->request->data('rows');
        $sort = 'Lmorder.' . $this->request->data('sidx');
        $order = $this->request->data('sord');
        $keywords = $this->request->data('keywords');
        $where = [];
        $where['Lmorder.type'] = 3;
        $where['Lmorder.status'] = 1;
        if (!empty($keywords)) {
            $where['Users.truename like'] = "%$keywords%";
        }
        $OrderTable = \Cake\ORM\TableRegistry::get('Order');
        $query = $OrderTable->find();
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
        $Table = $this->RechargeGift;
        $column = ['充值金额', '充值赠送金额'];
        $query = $Table->find();
        $query->hydrate(false);
        $query->select(['recharge_money', 'gift']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = 'RechargeGift_' . date('Y-m-d') . '.csv';
        \Wpadmin\Utils\Export::exportCsv($column, $res, $filename);
    }
    
    /**
     * 数据统计
     */
    public function chart(){
        
    }
    
    public function getRechargeChart(){
        $date = $this->request->query('date');
        $date = date('Y-m-d H:i:s',  strtotime($date));
        $type = $this->request->query('type');
        $connection = \Cake\Datasource\ConnectionManager::get('default');
        if($type=='month'){
            $sql = "select sum(o.fee) as nums, day(o.create_time) as time_item, date(o.create_time) as date
                            from `order` o where month(o.create_time) = month('".$date."') and o.type = 3
                            group by date(o.create_time)";
            $name = date('n',  strtotime($date)).'月';
        }
        if($type=='year'){
            $sql = "select sum(o.fee) as nums, month(o.create_time) as time_item
                            from `order` o where year(o.create_time) = year('".$date."') and o.type = 3
                            group by month(o.create_time)";
            $name = date('Y',  strtotime($date)).'年';
        }
        if($type=='week'){
            $sql = "select sum(o.fee) as nums, weekday(o.create_time) as time_item
                            from `order` o where week(o.create_time) = week('".$date."') and o.type = 3
                            group by weekday(o.create_time)";
            $name = date('Y',  strtotime($date)).'年第'.date('W',  strtotime($date)).'周';
        }
        $result = $connection->execute($sql)->fetchAll('assoc');
        $this->loadComponent('Echart');
        $title['text'] = '充值统计';
        echo $this->Echart->setLineChart($result,$type,$name,$title,'个');
        exit();
    }
    
    /**
     * 赠送统计
     */
    public function getGiftChart(){
        $date = $this->request->query('date');
        $date = date('Y-m-d H:i:s',  strtotime($date));
        $type = $this->request->query('type');
        $connection = \Cake\Datasource\ConnectionManager::get('default');
        if($type=='month'){
            $sql = "select sum(o.gift) as nums, day(o.create_time) as time_item, date(o.create_time) as date
                            from `order` o where month(o.create_time) = month('".$date."') and o.type = 3
                            group by date(o.create_time)";
            $name = date('n',  strtotime($date)).'月';
        }
        if($type=='year'){
            $sql = "select sum(o.gift) as nums, month(o.create_time) as time_item
                            from `order` o where year(o.create_time) = year('".$date."') and o.type = 3
                            group by month(o.create_time)";
            $name = date('Y',  strtotime($date)).'年';
        }
        if($type=='week'){
            $sql = "select sum(o.gift) as nums, weekday(o.create_time) as time_item
                            from `order` o where week(o.create_time) = week('".$date."') and o.type = 3
                            group by weekday(o.create_time)";
            $name = date('Y',  strtotime($date)).'年第'.date('W',  strtotime($date)).'周';
        }
        $result = $connection->execute($sql)->fetchAll('assoc');
        $this->loadComponent('Echart');
        $title['text'] = '充值统计';
        echo $this->Echart->setLineChart($result,$type,$name,$title,'个');
        exit();
    }

}
