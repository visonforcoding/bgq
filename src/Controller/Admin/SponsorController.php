<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * Sponsor Controller
 *
 * @property \App\Model\Table\SponsorTable $Sponsor
 */
class SponsorController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index($id = '') {
        $this->set('id', $id);
        if ($this->request->query('do')) {
            $this->set('do', 'check');
        }
        $this->set('sponsor', $this->Sponsor);
    }

    /**
     * View method
     *
     * @param string|null $id Sponsor id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->autoLayout(false);
        $sponsor = $this->Sponsor->get($id, [
            'contain' => ['Users', 'Activities']
        ]);
        $recommendTypes = \Cake\Core\Configure::read('recommendTypes');
        $sponsor->recommendTypes = $recommendTypes[$sponsor->type];
        $this->set('sponsor', $sponsor);
        $this->set('_serialize', ['sponsor']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $sponsor = $this->Sponsor->newEntity();
        if ($this->request->is('post')) {
            $sponsor = $this->Sponsor->patchEntity($sponsor, $this->request->data);
            if ($this->Sponsor->save($sponsor)) {
                $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $errors = $sponsor->errors();
                $this->Util->ajaxReturn(['status' => false, 'msg' => getMessage($errors), 'errors' => $errors]);
            }
        }
        $users = $this->Sponsor->Users->find('list', ['limit' => 200]);
        $activities = $this->Sponsor->Activities->find('list', ['limit' => 200]);
        $this->set(compact('sponsor', 'users', 'activities'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Sponsor id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $sponsor = $this->Sponsor->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['post', 'put'])) {
            $sponsor = $this->Sponsor->patchEntity($sponsor, $this->request->data);
            if ($this->Sponsor->save($sponsor)) {
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $errors = $sponsor->errors();
                $this->Util->ajaxReturn(false, getMessage($errors));
            }
        }
        $users = $this->Sponsor->Users->find('list', ['limit' => 200]);
        $activities = $this->Sponsor->Activities->find('list', ['limit' => 200]);
        $this->set(compact('sponsor', 'users', 'activities'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sponsor id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod('post');
        $id = $this->request->data('id');
        if ($this->request->is('post')) {
            $sponsor = $this->Sponsor->get($id);
            if ($this->Sponsor->delete($sponsor)) {
                $this->Util->ajaxReturn(true, '删除成功');
            } else {
                $errors = $sponsor->errors();
                $this->Util->ajaxReturn(true, getMessage($errors));
            }
        }
    }

    /**
     * get jqgrid data 
     *
     * @return json
     */
    public function getDataList($id = '') {
        $this->request->allowMethod('ajax');
        $page = $this->request->data('page');
        $rows = $this->request->data('rows');
        $sort = 'Sponsor.' . $this->request->data('sidx');
        $order = $this->request->data('sord');
        $keywords = $this->request->data('keywords');
        $begin_time = $this->request->data('begin_time');
        $end_time = $this->request->data('end_time');
        $status = $this->request->data('status');
        $where = [];
        if (is_numeric($status)) {
            $where = ['Sponsor.status' => $status];
        }
        if($this->request->query('do')=='check'&&$status===NULL){
            $where = ['Sponsor.status' => 0];
        }
        if (!empty($keywords)) {
            $where['username like'] = "%$keywords%";
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(`ctime`) >' => $begin_time], ['date(`ctime`) <' => $end_time]];
        }
        if ($id) {
            $query = $this->Sponsor->find()->where(['activity_id' => $id]);
        } else {
            $query = $this->Sponsor->find();
        }
        $query->hydrate(false);
        if (!empty($where)) {
            $query->where($where);
        }
        $query->contain(['Users', 'Activities']);
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
         $status = $this->request->data('status');
        $where = [];
        if (is_numeric($status)) {
            $where = ['Sponsor.status' => $status];
        }
        if($this->request->query('do')=='check'&&$status===NULL ){
            $where = ['Sponsor.status' => 0];
        }
        if (!empty($keywords)) {
            $where['username like'] = "%$keywords%";
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(`ctime`) >' => $begin_time], ['date(`ctime`) <' => $end_time]];
        }
        $Table = $this->Sponsor;
        $column = ['用户id', '活动id', '提交时间', '类型值：1：嘉宾推荐；2：场地赞助；3：现金赞助；4：物品赞助；5：其他', '描述', '姓名', '公司/机构', '部门', '职务', '地址', '容纳人数'];
        $query = $Table->find();
        $query->hydrate(false);
        $query->select(['user_id', 'activity_id', 'create_time', 'type', 'description', 'name', 'company', 'department', 'position', 'address', 'people']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = 'Sponsor_' . date('Y-m-d') . '.csv';
        \Wpadmin\Utils\Export::exportCsv($column, $res, $filename);
    }

    /**
     * 标记处理
     */
    public function check($id) {
        if ($this->request->is('ajax')) {
            $sponsor = $this->Sponsor->get($id);
            $sponsor->status = 1;
            $sponsor->check_man = $this->_user->truename;
            if ($this->Sponsor->save($sponsor)) {
                $this->Util->ajaxReturn(true, '标注成功!');
            } else {
                $this->Util->ajaxReturn(false, '标记失败');
            }
        }
    }

    /**
     * 标记处理
     */
    public function uncheck($id) {
        if ($this->request->is('ajax')) {
            $sponsor = $this->Sponsor->get($id);
            $sponsor->status = 0;
            $sponsor->check_man = $this->_user->truename;
            if ($this->Sponsor->save($sponsor)) {
                $this->Util->ajaxReturn(true, '标注成功!');
            } else {
                $this->Util->ajaxReturn(false, '标记失败');
            }
        }
    }

}
