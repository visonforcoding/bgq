<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * Newstag Controller
 *
 * @property \App\Model\Table\NewstagTable $Newstag
 */
class NewstagController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->set('newstag', $this->Newstag);
    }

    /**
     * View method
     *
     * @param string|null $id Newstag id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->autoLayout(false);
        $newstag = $this->Newstag->get($id, [
            'contain' => []
        ]);
        $this->set('newstag', $newstag);
        $this->set('_serialize', ['newstag']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $newstag = $this->Newstag->newEntity();
        if ($this->request->is('post')) {
            $newstag = $this->Newstag->patchEntity($newstag, $this->request->data);
            if ($this->Newstag->save($newstag)) {
                $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $errors = $newstag->errors();
                $this->Util->ajaxReturn(['status' => false, 'msg' => getMessage($errors), 'errors' => $errors]);
            }
        }
        $this->set(compact('newstag'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Newstag id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $newstag = $this->Newstag->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['post', 'put'])) {
            $newstag = $this->Newstag->patchEntity($newstag, $this->request->data);
            if ($this->Newstag->save($newstag)) {
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $errors = $newstag->errors();
                $this->Util->ajaxReturn(false, getMessage($errors));
            }
        }
        $this->set(compact('newstag'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Newstag id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod('post');
        $id = $this->request->data('id');
        if ($this->request->is('post')) {
            $newstag = $this->Newstag->get($id);
            if ($this->Newstag->delete($newstag)) {
                $this->Util->ajaxReturn(true, '删除成功');
            } else {
                $errors = $newstag->errors();
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
        $sort = 'Newstag.' . $this->request->data('sidx');
        $order = $this->request->data('sord');
        $keywords = $this->request->data('keywords');
        $begin_time = $this->request->data('begin_time');
        $end_time = $this->request->data('end_time');
        $where = [];
        if (!empty($keywords)) {
            $where['name like'] = "%$keywords%";
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(`ctime`) >' => $begin_time], ['date(`ctime`) <' => $end_time]];
        }
        $data = $this->getJsonForJqrid($page, $rows, '', $sort, $order, $where);
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
            $where['name like'] = "%$keywords%";
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(`ctime`) >' => $begin_time], ['date(`ctime`) <' => $end_time]];
        }
        $Table = $this->Newstag;
        $column = ['name'];
        $query = $Table->find();
        $query->hydrate(false);
        $query->select(['name']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = 'Newstag_' . date('Y-m-d') . '.csv';
        \Wpadmin\Utils\Export::exportCsv($column, $res, $filename);
    }

}
