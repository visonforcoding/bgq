<?php

namespace App\Controller\Admin;

use Psy\TabCompletion\Matcher\ClassNamesMatcher;
use Wpadmin\Controller\AppController;
use vendor\umeng;

/**
 * Need Controller
 *
 * @property \App\Model\Table\NeedTable $Need
 * @property \App\Controller\Component\BusinessComponent $Business 通用业务处理组件
 */
class NeedController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        if($this->request->query('do')){
            $this->set('do','check');
        }
        $this->set('need', $this->Need);
    }

    /**
     * View method
     *
     * @param string|null $id Need id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->autoLayout(false);
        $needs = $this->Need->find()
                ->contain(['User'=>function($q){
                    return $q->select(['truename','avatar','company','position']);
                }])
                ->where(['user_id' => $id])->orWhere(['reply_id'=>$id])->orderAsc('Need.create_time')
                ->toArray();
        $last_need = $this->Need->find()
                ->contain(['User'=>function($q){
                    return $q->select(['truename','avatar','company','position']);
                }])
                ->where(['user_id' => $id])->orWhere(['reply_id'=>$id])->orderDesc('Need.create_time')
                ->first();
        $last_need->status = 1;
        $this->Need->save($last_need);
        $this->set('needs', $needs);
        $this->set('id', $id);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $need = $this->Need->newEntity();
        if ($this->request->is('post')) {
            $need = $this->Need->patchEntity($need, $this->request->data);
            if ($this->Need->save($need)) {
                $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $errors = $need->errors();
                $this->Util->ajaxReturn(['status' => false, 'msg' => getMessage($errors), 'errors' => $errors]);
            }
        }
        $users = $this->Need->User->find('list', ['limit' => 200]);
        $this->set(compact('need', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Need id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $need = $this->Need->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['post', 'put'])) {
            $need = $this->Need->patchEntity($need, $this->request->data);
            if ($this->Need->save($need)) {
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $errors = $need->errors();
                $this->Util->ajaxReturn(false, getMessage($errors));
            }
        }
        $users = $this->Need->User->find('list', ['limit' => 200]);
        $this->set(compact('need', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Need id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod('post');
        $id = $this->request->data('id');
        if ($this->request->is('post')) {
            $need = $this->Need->get($id);
            if ($this->Need->delete($need)) {
                $this->Util->ajaxReturn(true, '删除成功');
            } else {
                $errors = $need->errors();
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
        $sort = $this->request->data('sidx');
        $order = $this->request->data('sord');
        $keywords = $this->request->data('keywords');
        $begin_time = $this->request->data('begin_time');
        $end_time = $this->request->data('end_time');
        $status = $this->request->data('status');
        $where_need = '';
        if(is_numeric($status)){
            $where_need =  'where status = '.$status;
        }
        if($this->request->query('do')=='check'&&$status===NULL){
             $where_need =  'where status = 0';
        }
        $where = [];
        if (!empty($keywords)) {
            $where['OR'] = [
                ['User.`truename` like' => "%$keywords%"],
                ['msg like' => "%$keywords%"],
            ]; //搜索关键字为用户名和内容
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['Need.`create_time` >' => $begin_time], ['Need.`create_time` <' => $end_time]];
        }
        $offset = ($page - 1) * $rows;
        $connection = \Cake\Datasource\ConnectionManager::get('default');
        $result = $connection->execute("select u.phone,u.truename,u.company,u.position,n.* from user u
                        inner join 
                        (select * from need $where_need  order by create_time desc ) n
                        on n.user_id = u.id where u.id != '-1'
                        group by u.id order by $sort $order limit  $offset, $rows")->fetchAll('assoc');
        $nums = count($result);
        if (empty($result)) {
            $res = array();
        }
        if ($nums > 0) {
            $total_pages = ceil($nums / $rows);
        } else {
            $total_pages = 0;
        }
        $data = array('page' => $page, 'total' => $total_pages, 'records' => $nums, 'rows' => $result);
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
        $Table = $this->Need;
        $column = ['用户', '内容', '状态', '创建时间', '修改时间'];
        $query = $Table->find();
        $query->hydrate(false);
        $query->select(['user_id', 'msg', 'status', 'create_time', 'update_time']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = 'Need_' . date('Y-m-d') . '.csv';
        \Wpadmin\Utils\Export::exportCsv($column, $res, $filename);
    }

    /**
     * 回复
     * @param int $user_id
     */
    public function reply($user_id) {
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $new = [
                'user_id' =>-1, //后台回复
                'reply_id' => $user_id,
                'msg' => $data['msg'],
            ];
            $need = $this->Need->newEntity();
            $need = $this->Need->patchEntity($need, $new);
            $res = $this->Need->save($need);
            if ($res) {
                $this->loadComponent('Business');
                $this->Business->usermsg($user_id, '您有新的消息', '您有新的小秘书消息', '6', $need->id);
                return $this->Util->ajaxReturn(true, '回复成功');
            } else {
                return $this->Util->ajaxReturn(false, '系统错误');
            }
        }
    }

}
