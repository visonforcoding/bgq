<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * Pvtag Controller
 *
 * @property \App\Model\Table\PvtagTable $Pvtag
 */
class PvtagController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->set('pvtag', $this->Pvtag);
    }

    /**
     * View method
     *
     * @param string|null $id Pvtag id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->autoLayout(false);
        $pvtag = $this->Pvtag->get($id, [
            'contain' => []
        ]);
        $this->set('pvtag', $pvtag);
        $this->set('_serialize', ['pvtag']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $pvtag = $this->Pvtag->newEntity();
        if ($this->request->is(['post', 'put'])) {
            $pvtag = $this->Pvtag->patchEntity($pvtag, $this->request->data);
            if ($this->Pvtag->save($pvtag)) {
                $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $errors = $pvtag->errors();
                $this->Util->ajaxReturn(['status' => false, 'msg' => getMessage($errors), 'errors' => $errors]);
            }
        }
        $counts = $this->Pvtag->find()->count();
        $pvtag = $this->Pvtag->find()->orderDesc('ptag')->first();
        if(!$pvtag){
            $tag = 10000;
        }else{
            $tag = $counts+10000;
        }
        $this->set(compact('tag'));
        $this->set(compact('pvtag'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Pvtag id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $pvtag = $this->Pvtag->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['post', 'put'])) {
            $pvtag = $this->Pvtag->patchEntity($pvtag, $this->request->data);
            if ($this->Pvtag->save($pvtag)) {
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $errors = $pvtag->errors();
                $this->Util->ajaxReturn(false, getMessage($errors));
            }
        }
        $this->set(compact('pvtag'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Pvtag id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod('post');
        $id = $this->request->data('id');
        if ($this->request->is('post')) {
            $pvtag = $this->Pvtag->get($id);
            if ($this->Pvtag->delete($pvtag)) {
                $this->Util->ajaxReturn(true, '删除成功');
            } else {
                $errors = $pvtag->errors();
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
        $sort = 'Pvtag.' . $this->request->data('sidx');
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
        $Table = $this->Pvtag;
        $column = ['pvtag', '描述', 'create_time', 'update_time'];
        $query = $Table->find();
        $query->hydrate(false);
        $query->select(['pvtag', 'desc', 'create_time', 'update_time']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = 'Pvtag_' . date('Y-m-d') . '.csv';
        \Wpadmin\Utils\Export::exportCsv($column, $res, $filename);
    }

}
