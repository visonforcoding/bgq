<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * Agency Controller
 *
 * @property \App\Model\Table\AgencyTable $Agency
 */
class AgencyController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->set('agency', $this->Agency);
    }

    /**
     * View method
     *
     * @param string|null $id Agency id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->autoLayout(false);
        $agency = $this->Agency->get($id, [
            'contain' => []
        ]);
        $this->set('agency', $agency);
        $this->set('_serialize', ['agency']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $agency = $this->Agency->newEntity();
        if ($this->request->is('post')) {
            $this->autoRender = false;
            $this->response->type('json');
            $agency = $this->Agency->patchEntity($agency, $this->request->data);
            if ($this->Agency->save($agency)) {
                echo json_encode(array('status' => true, 'msg' => '添加成功'));
            } else {
                $errors = $agency->errors();
                echo json_encode(array('status' => false, 'msg' => getMessage($errors), 'errors' => $errors));
            }
            return;
        }
        $agencys = $this->Agency->find()->hydrate(false)->all()->toArray();
        $agencys = \Wpadmin\Utils\Util::tree($agencys, 0, 'id', 'pid');
        $this->set(compact('agency'));
        $this->set(compact('agencys'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Agency id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $agency = $this->Agency->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['post', 'put'])) {
            $this->autoRender = false;
            $this->response->type('json');
            $agency = $this->Agency->patchEntity($agency, $this->request->data);
            if ($this->Agency->save($agency)) {
                echo json_encode(array('status' => true, 'msg' => '修改成功'));
            } else {
                $errors = $agency->errors();
                echo json_encode(array('status' => false, 'msg' => getMessage($errors)));
            }
            return;
        }
        $agencys = $this->Agency->find()->hydrate(false)->all()->toArray();
        $agencys = \Wpadmin\Utils\Util::tree($agencys, 0, 'id', 'pid');
        $this->set(compact('agency'));
        $this->set(compact('agencys'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Agency id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod('post');
        $id = $this->request->data('id');
        if ($this->request->is('post')) {
            $this->autoRender = false;
            $this->response->type('json');
            $agency = $this->Agency->get($id);
            if ($this->Agency->delete($agency)) {
                echo json_encode(array('status' => true, 'msg' => '删除成功'));
            } else {
                $errors = $agency->errors();
                echo json_encode(array('status' => false, 'msg' => getMessage($errors)));
            }
        }
        return;
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
            $where['and'] = [['date(`ctime`) >' => $begin_time], ['date(`ctime`) <' => $end_time]];
        }
        $Table = $this->Agency;
        $column = ['父id', '名称'];
        $query = $Table->find();
        $query->hydrate(false);
        $query->select(['pid', 'name']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = 'Agency_' . date('Y-m-d') . '.csv';
        \Wpadmin\Utils\Export::exportCsv($column, $res, $filename);
    }

}
