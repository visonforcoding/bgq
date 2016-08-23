<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * Activityneed Controller
 *
 * @property \App\Model\Table\ActivityneedTable $Activityneed
 */
class ActivityneedController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->set('activityneed', $this->Activityneed);
    }

    /**
     * View method
     *
     * @param string|null $id Activityneed id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->autoLayout(false);
        $activityneed = $this->Activityneed->get($id, [
            'contain' => ['Users']
        ]);
        $this->set('activityneed', $activityneed);
        $this->set('_serialize', ['activityneed']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $activityneed = $this->Activityneed->newEntity();
        if ($this->request->is('post')) {
            $activityneed = $this->Activityneed->patchEntity($activityneed, $this->request->data);
            if ($this->Activityneed->save($activityneed)) {
                $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $errors = $activityneed->errors();
                $this->Util->ajaxReturn(['status' => false, 'msg' => getMessage($errors), 'errors' => $errors]);
            }
        }
        $this->set(compact('activityneed', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Activityneed id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $activityneed = $this->Activityneed->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['post', 'put'])) {
            $activityneed = $this->Activityneed->patchEntity($activityneed, $this->request->data);
            if ($this->Activityneed->save($activityneed)) {
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $errors = $activityneed->errors();
                $this->Util->ajaxReturn(false, getMessage($errors));
            }
        }
        $this->set(compact('activityneed', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Activityneed id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod('post');
        $id = $this->request->data('id');
        if ($this->request->is('post')) {
            $activityneed = $this->Activityneed->get($id);
            if ($this->Activityneed->delete($activityneed)) {
                $this->Util->ajaxReturn(true, '删除成功');
            } else {
                $errors = $activityneed->errors();
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
        $sort = 'Activityneed.' . $this->request->data('sidx');
        $order = $this->request->data('sord');
        $keywords = $this->request->data('keywords');
        $begin_time = $this->request->data('begin_time');
        $end_time = $this->request->data('end_time');
        $where = [];
        if (!empty($keywords)) {
            $where['or'] = [['Activityneed.truename like' => "%$keywords%"], ['(`title`) like' => "%$keywords%"], ['(Activityneed.`company`) like' => "%$keywords%"]];
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(`create_time`) >' => $begin_time], ['date(`create_time`) <' => $end_time]];
        }
        $query = $this->Activityneed->find();
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
        $Table = $this->Activityneed;
        $column = ['user_id', '姓名', '公司', '职位', '活动', '内容', '创建时间', '修改时间'];
        $query = $Table->find();
        $query->hydrate(false);
        $query->select(['user_id', 'truename', 'company', 'position', 'title', 'body', 'create_time', 'update_time']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = 'Activityneed_' . date('Y-m-d') . '.csv';
        \Wpadmin\Utils\Export::exportCsv($column, $res, $filename);
    }

}
