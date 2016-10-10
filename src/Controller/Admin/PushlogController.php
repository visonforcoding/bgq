<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * Pushlog Controller
 *
 * @property \App\Model\Table\PushlogTable $Pushlog
 */
class PushlogController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->set('pushlog', $this->Pushlog);
    }

    /**
     * View method
     *
     * @param string|null $id Pushlog id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->autoLayout(false);
        $pushlog = $this->Pushlog->get($id);
        $id = unserialize($pushlog->get_message_uid);
        $UserTable = \Cake\ORM\TableRegistry::get('user');
        $user = $UserTable->find()->where(['id in'=>$id, 'enabled'=>1])->toArray();
        $this->set('user', $user);
//        $this->set('_serialize', ['pushlog']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $pushlog = $this->Pushlog->newEntity();
        if ($this->request->is('post')) {
            $pushlog = $this->Pushlog->patchEntity($pushlog, $this->request->data);
            if ($this->Pushlog->save($pushlog)) {
                $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $errors = $pushlog->errors();
                $this->Util->ajaxReturn(['status' => false, 'msg' => getMessage($errors), 'errors' => $errors]);
            }
        }
        $pushes = $this->Pushlog->Pushes->find('list', ['limit' => 200]);
        $receives = $this->Pushlog->Receives->find('list', ['limit' => 200]);
        $this->set(compact('pushlog', 'pushes', 'receives'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Pushlog id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $pushlog = $this->Pushlog->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['post', 'put'])) {
            $pushlog = $this->Pushlog->patchEntity($pushlog, $this->request->data);
            if ($this->Pushlog->save($pushlog)) {
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $errors = $pushlog->errors();
                $this->Util->ajaxReturn(false, getMessage($errors));
            }
        }
        $pushes = $this->Pushlog->Pushes->find('list', ['limit' => 200]);
        $receives = $this->Pushlog->Receives->find('list', ['limit' => 200]);
        $this->set(compact('pushlog', 'pushes', 'receives'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Pushlog id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod('post');
        $id = $this->request->data('id');
        if ($this->request->is('post')) {
            $pushlog = $this->Pushlog->get($id);
            if ($this->Pushlog->delete($pushlog)) {
                $this->Util->ajaxReturn(true, '删除成功');
            } else {
                $errors = $pushlog->errors();
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
        $sort = 'Pushlog.' . $this->request->data('sidx');
        $order = $this->request->data('sord');
        $keywords = $this->request->data('keywords');
        $begin_time = $this->request->data('begin_time');
        $end_time = $this->request->data('end_time');
        $where = [];
        if (!empty($keywords)) {
            $where['title like'] = "%$keywords%";
        }
        if (empty($begin_time) && !empty($end_time)) {
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(Pushlog.`create_time`) <' => $end_time]];
        }
        if (!empty($begin_time) && empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $where['and'] = [['date(Pushlog.`create_time`) >' => $begin_time]];
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(Pushlog.`create_time`) >' => $begin_time], ['date(Pushlog.`create_time`) <' => $end_time]];
        }
        $query = $this->Pushlog->find();
        $query->hydrate(false);
        if (!empty($where)) {
            $query->where($where);
        }
        $query->contain(['Pusher', 'Receiver']);
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
        $Table = $this->Pushlog;
        $column = ['推送用户id', '接收推送id', '推送标题', '推送内容', '推送类型：1：广播；2：单播；3：群播', '是否成功', '备注', '创建时间'];
        $query = $Table->find();
        $query->hydrate(false);
        $query->select(['push_id', 'receive_id', 'title', 'body', 'type', 'is_success', 'remark', 'create_time']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = 'Pushlog_' . date('Y-m-d') . '.csv';
        \Wpadmin\Utils\Export::exportCsv($column, $res, $filename);
    }

}
