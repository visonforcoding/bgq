<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * Projneed Controller
 *
 * @property \App\Model\Table\ProjneedTable $Projneed
 */
class ProjneedController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->set('projneed', $this->Projneed);
    }

    /**
     * View method
     *
     * @param string|null $id Projneed id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->autoLayout(false);
        $projneed = $this->Projneed->get($id, [
            'contain' => ['Industries']
        ]);
        $this->set('projneed', $projneed);
        $this->set('_serialize', ['projneed']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $projneed = $this->Projneed->newEntity();
        if ($this->request->is('post')) {
            $projneed = $this->Projneed->patchEntity($projneed, $this->request->data);
            if ($this->Projneed->save($projneed)) {
                $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $errors = $projneed->errors();
                $this->Util->ajaxReturn(['status' => false, 'msg' => getMessage($errors), 'errors' => $errors]);
            }
        }

        $this->set(compact('projneed'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Projneed id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $projneed = $this->Projneed->get($id, [
            'contain' => ['Industries']
        ]);
        if ($this->request->is(['post', 'put'])) {
            $projneed = $this->Projneed->patchEntity($projneed, $this->request->data);
            if ($this->Projneed->save($projneed)) {
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $errors = $projneed->errors();
                $this->Util->ajaxReturn(false, getMessage($errors));
            }
        }
        $selIndustryIds = [];
        foreach ($projneed->industries as $industry) {
            $selIndustryIds[] = $industry->id;
        }
        $this->set(compact('projneed', 'selIndustryIds'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Projneed id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod('post');
        $id = $this->request->data('id');
        if ($this->request->is('post')) {
            $projneed = $this->Projneed->get($id);
            if ($this->Projneed->delete($projneed)) {
                $this->Util->ajaxReturn(true, '删除成功');
            } else {
                $errors = $projneed->errors();
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
        $sort = 'Projneed.' . $this->request->data('sidx');
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
        $query = $this->Projneed->find();
        $query->hydrate(false);
        if (!empty($where)) {
            $query->where($where);
        }
        $nums = $query->count();
        $query->contain(['Industries']);
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
        $Table = $this->Projneed;
        $column = ['标题', '内容', '需求方', '跟进人', '进度描述', '创建时间', '更新时间'];
        $query = $Table->find();
        $query->hydrate(false);
        $query->select(['title', 'body', 'needer', 'follower', 'stage_remark', 'create_time', 'update_time']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = 'Projneed_' . date('Y-m-d') . '.csv';
        \Wpadmin\Utils\Export::exportCsv($column, $res, $filename);
    }

}
