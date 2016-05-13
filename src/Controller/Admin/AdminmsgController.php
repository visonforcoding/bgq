<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * Adminmsg Controller
 *
 * @property \App\Model\Table\AdminmsgTable $Adminmsg
 */
class AdminmsgController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->set('adminmsg', $this->Adminmsg);
    }

    /**
     * View method
     *
     * @param string|null $id Adminmsg id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->autoLayout(false);
        $adminmsg = $this->Adminmsg->get($id, [
            'contain' => []
        ]);
        $this->set('adminmsg', $adminmsg);
        $this->set('_serialize', ['adminmsg']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $adminmsg = $this->Adminmsg->newEntity();
        if ($this->request->is('post')) {
            $adminmsg = $this->Adminmsg->patchEntity($adminmsg, $this->request->data);
            if ($this->Adminmsg->save($adminmsg)) {
                $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $errors = $adminmsg->errors();
                $this->Util->ajaxReturn(['status' => false, 'msg' => getMessage($errors), 'errors' => $errors]);
            }
        }
        $this->set(compact('adminmsg'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Adminmsg id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $adminmsg = $this->Adminmsg->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['post', 'put'])) {
            $adminmsg = $this->Adminmsg->patchEntity($adminmsg, $this->request->data);
            if ($this->Adminmsg->save($adminmsg)) {
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $errors = $adminmsg->errors();
                $this->Util->ajaxReturn(false, getMessage($errors));
            }
        }
        $this->set(compact('adminmsg'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Adminmsg id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod('post');
        $id = $this->request->data('id');
        if ($this->request->is('post')) {
            $adminmsg = $this->Adminmsg->get($id);
            if ($this->Adminmsg->delete($adminmsg)) {
                $this->Util->ajaxReturn(true, '删除成功');
            } else {
                $errors = $adminmsg->errors();
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
        $sort = 'adminmsg.' . $this->request->data('sidx');
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
        $Table = $this->Adminmsg;
        $column = ['类型', '内容', '状态', '创建时间', '修改时间'];
        $query = $Table->find();
        $query->hydrate(false);
        $query->select(['type', 'msg', 'status', 'create_time', 'update_time']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = 'Adminmsg_' . date('Y-m-d') . '.csv';
        \Wpadmin\Utils\Export::exportCsv($column, $res, $filename);
    }

    /**
     * 处理jgqrid 的 celledit
     */
    public function handChange() {
        if ($this->request->is('post')) {
            $entity = $this->Adminmsg->get($this->request->data('id'));
            $data = $this->request->data();
            unset($data['id']);
            unset($data['oper']);
            $entity = $this->Adminmsg->patchEntity($entity, $data);
            if ($this->Adminmsg->save($entity)) {
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $this->Util->ajaxReturn(false, '保存失败');
            }
        }
    }

}
