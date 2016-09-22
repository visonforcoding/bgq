<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * Pvlog Controller
 *
 * @property \App\Model\Table\PvlogTable $Pvlog
 */
class PvchartController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->set('pvlog', $this->Pvlog);
    }

    /**
     * View method
     *
     * @param string|null $id Pvlog id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->autoLayout(false);
        $pvlog = $this->Pvlog->get($id, [
            'contain' => []
        ]);
        $this->set('pvlog', $pvlog);
        $this->set('_serialize', ['pvlog']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $pvlog = $this->Pvlog->newEntity();
        if ($this->request->is('post')) {
            $pvlog = $this->Pvlog->patchEntity($pvlog, $this->request->data);
            if ($this->Pvlog->save($pvlog)) {
                $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $errors = $pvlog->errors();
                $this->Util->ajaxReturn(['status' => false, 'msg' => getMessage($errors), 'errors' => $errors]);
            }
        }
        $this->set(compact('pvlog'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Pvlog id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $pvlog = $this->Pvlog->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['post', 'put'])) {
            $pvlog = $this->Pvlog->patchEntity($pvlog, $this->request->data);
            if ($this->Pvlog->save($pvlog)) {
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $errors = $pvlog->errors();
                $this->Util->ajaxReturn(false, getMessage($errors));
            }
        }
        $this->set(compact('pvlog'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Pvlog id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod('post');
        $id = $this->request->data('id');
        if ($this->request->is('post')) {
            $pvlog = $this->Pvlog->get($id);
            if ($this->Pvlog->delete($pvlog)) {
                $this->Util->ajaxReturn(true, '删除成功');
            } else {
                $errors = $pvlog->errors();
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
        $sort = 'Pvlog.' . $this->request->data('sidx');
        if ($this->request->data('sidx') == 'counts') {
            $sort = $this->request->data('sidx');
        }
        $order = $this->request->data('sord');
        $keywords = $this->request->data('keywords');
        $begin_time = $this->request->data('begin_time');
        $end_time = $this->request->data('end_time');
        $where = [];
        if (!empty($keywords)) {
            $where['url like'] = "%$keywords%";
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(`create_time`) >' => $begin_time], ['date(`create_time`) <' => $end_time]];
        }
        $Table = \Cake\ORM\TableRegistry::get('Pvlog');
        $query = $Table->find();
        $query->contain(['Pvtag']);
        $query->select(['counts' => $query->func()->count('*'), 'ptag', 'act', 'Pvtag.descb', 'url']);
        $query->hydrate(false);
        if (!empty($where)) {
            $query->where($where);
        }
        $query->group(['Pvlog.ptag', 'act', 'urlmap']);
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
        $Table = \Cake\ORM\TableRegistry::get('Pvlog');
        $column = ['ptag', 'ip', '屏幕尺寸', '访问页', 'act', '用户头', 'create_time'];
        $query = $Table->find();
        $query->hydrate(false);
        $query->select(['ptag', 'ip', 'screen', 'refer', 'act', 'useragent', 'create_time']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = 'Pvlog_' . date('Y-m-d') . '.csv';
        \Wpadmin\Utils\Export::exportCsv($column, $res, $filename);
    }

    public function chart() {
        
    }

    /**
     * 安卓ios 占比
     */
    public function getPieChart1() {
        $connection = \Cake\Datasource\ConnectionManager::get('default');
        $result = $connection->execute('select u.os as name,count(u.id) as nums from `pvlog` u
                 group by u.os')->fetchAll('assoc');
        foreach($result as $k=>$v){
            switch ($v['name']) {
                case 1:
                    $result[$k]['name'] = 'iphone';
                    break;
                case 2:
                    $result[$k]['name'] = 'android';
                    break;
                case 3:
                    $result[$k]['name'] = '其他';
                    break;
                default:
                    break;
            }
        }
        $this->loadComponent('Echart');
        $name = '访问用户操作系统占比';
        $title['text'] = '访问用户操作系统占比';
        echo $this->Echart->setPieChart($result, $name, $title);
        exit();
    }
    
    /**
     * 安卓ios 占比
     */
    public function getPieChart2() {
        $connection = \Cake\Datasource\ConnectionManager::get('default');
        $result = $connection->execute('select u.is_app as name,count(u.id) as nums from `pvlog` u
                 group by u.is_app')->fetchAll('assoc');
        foreach($result as $k=>$v){
            switch ($v['name']) {
                case 1:
                    $result[$k]['name'] = 'app';
                    break;
                case 2:
                    $result[$k]['name'] = '微信';
                    break;
                case 3:
                    $result[$k]['name'] = '其他';
                    break;
                default:
                    break;
            }
        }
        $this->loadComponent('Echart');
        $name = '访问渠道占比';
        $title['text'] = '访问渠道占比';
        echo $this->Echart->setPieChart($result, $name, $title);
        exit();
    }
    /**
     * 安卓ios 占比
     */
    public function getPieChart3() {
        $connection = \Cake\Datasource\ConnectionManager::get('default');
        $result = $connection->execute('select u.os_version as name,u.os,count(u.id) as nums from `pvlog` u
                 group by u.os_version,u.os')->fetchAll('assoc');
        foreach($result as $k=>$v){
            switch ($v['os']) {
                case 1:
                    $result[$k]['name'] = 'ios '.$v['name'];
                    break;
                case 2:
                    $result[$k]['name'] = 'android '.$v['name'];
                    break;
                case 3:
                    $result[$k]['name'] = '其他';
                    break;
                default:
                    break;
            }
        }
        $this->loadComponent('Echart');
        $name = '访问用户操作系统版本占比';
        $title['text'] = '访问用户操作系统版本占比';
        echo $this->Echart->setPieChart($result, $name, $title);
        exit();
    }

}
