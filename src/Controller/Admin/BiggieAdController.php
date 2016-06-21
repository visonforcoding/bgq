<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * BiggieAd Controller
 *
 * @property \App\Model\Table\BiggieAdTable $BiggieAd
 */
class BiggieAdController extends AppController {
    
    public function initialize() {
        parent::initialize();
        $this->loadModel('BiggieAd');
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->set('biggieAd', $this->BiggieAd);
    }

    /**
     * View method
     *
     * @param string|null $id Biggie Ad id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->autoLayout(false);
        $biggieAd = $this->BiggieAd->get($id, [
            'contain' => ['Savants']
        ]);
        $this->set('biggieAd', $biggieAd);
        $this->set('_serialize', ['biggieAd']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $biggieAd = $this->BiggieAd->newEntity();
        if ($this->request->is('post')) {
            $biggieAd = $this->BiggieAd->patchEntity($biggieAd, $this->request->data);
            if ($this->BiggieAd->save($biggieAd)) {
                $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $errors = $biggieAd->errors();
                $this->Util->ajaxReturn(['status' => false, 'msg' => getMessage($errors), 'errors' => $errors]);
            }
        }
        $savants = $this->BiggieAd->Savants->find('list', ['limit' => 200]);
        $userTable = \Cake\ORM\TableRegistry::get('User');
        $users = $userTable->find('list', ['limit' => 200]);
        $this->set(compact('biggieAd', 'savants', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Biggie Ad id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $biggieAd = $this->BiggieAd->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['post', 'put'])) {
            $biggieAd = $this->BiggieAd->patchEntity($biggieAd, $this->request->data);
            if ($this->BiggieAd->save($biggieAd)) {
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $errors = $biggieAd->errors();
                $this->Util->ajaxReturn(false, getMessage($errors));
            }
        }
        $savants = $this->BiggieAd->Savants->find('list', ['limit' => 200]);
        $this->set(compact('biggieAd', 'savants'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Biggie Ad id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod('post');
        $id = $this->request->data('id');
        if ($this->request->is('post')) {
            $biggieAd = $this->BiggieAd->get($id);
            if ($this->BiggieAd->delete($biggieAd)) {
                $this->Util->ajaxReturn(true, '删除成功');
            } else {
                $errors = $biggieAd->errors();
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
        $sort = 'biggiead.' . $this->request->data('sidx');
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
        $query = $this->BiggieAd->find();
        $query->hydrate(false);
        if (!empty($where)) {
            $query->where($where);
        }
        $nums = $query->count();
        $query->contain(['Savants']);
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
        $Table = $this->BiggieAd;
        $column = ['大咖id', '图片地址', '创建时间'];
        $query = $Table->find();
        $query->hydrate(false);
        $query->select(['savant_id', 'url', 'create_time']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = 'BiggieAd_' . date('Y-m-d') . '.csv';
        \Wpadmin\Utils\Export::exportCsv($column, $res, $filename);
    }

}
