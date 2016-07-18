<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * Savant Controller
 *
 * @property \App\Model\Table\SavantTable $Savant
 * @property \App\Controller\Component\BusinessComponent $Business 通用业务处理组件
 * @property \App\Model\Table\UserTable $User
 */
class SavantController extends AppController {
    
    
    public function initialize() {
        parent::initialize();
        $this->loadModel('User');
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->set('savant', $this->Savant);
    }

    /**
     * View method
     *
     * @param string|null $id Savant id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->autoLayout(false);
        $savant = $this->Savant->get($id, [
            'contain' => ['Users', 'News', 'Activity']
        ]);
        $this->set('savant', $savant);
        $this->set('_serialize', ['savant']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $savant = $this->Savant->newEntity();
        if ($this->request->is('post')) {
            $savant = $this->Savant->patchEntity($savant, $this->request->data);
            if ($this->Savant->save($savant)) {
                $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $errors = $savant->errors();
                $this->Util->ajaxReturn(['status' => false, 'msg' => getMessage($errors), 'errors' => $errors]);
            }
        }
        $users = $this->Savant->Users->find('list', ['limit' => 200]);
        $this->set(compact('savant', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Savant id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $savant = $this->Savant->get($id, [
            'contain' => ['Users'=>function($q){
                    return $q->contain(['Subjects']);
                }]
        ]);
//        debug($savant);die;
        if ($this->request->is(['post', 'put'])) {
            $savant = $this->Savant->patchEntity($savant, $this->request->data);
            if ($this->Savant->save($savant)) {
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $errors = $savant->errors();
                $this->Util->ajaxReturn(false, getMessage($errors));
            }
        }
        $users = $this->Savant->Users->find('list', ['limit' => 200]);
        $selUserIds = [];
        if($savant->user)
        {
            $selUserIds[] = $savant->user->id;
        }
        $this->set(compact('savant', 'users', 'selUserIds'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Savant id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod('post');
        $id = $this->request->data('id');
        if ($this->request->is('post')) {
            $savant = $this->Savant->get($id);
            if ($this->Savant->delete($savant)) {
                $this->Util->ajaxReturn(true, '删除成功');
            } else {
                $errors = $savant->errors();
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
        $sort = 'User.' . $this->request->data('sidx');
        $order = $this->request->data('sord');
        $keywords = $this->request->data('keywords');
        $begin_time = $this->request->data('begin_time');
        $end_time = $this->request->data('end_time');
        $where = ['User.savant_status >'=>1];
        if (!empty($keywords)) {
            $where[' User.truename like'] = "%$keywords%";
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(`create_time`) >' => $begin_time], ['date(`create_time`) <' => $end_time]];
        }
        $query = $this->User->find()->select(['User.id','User.truename','Savant.reco_nums','User.savant_status','Savant.xmjy','Savant.zyys','Savant.summary'])
                ->contain(['Savant']);
        if (!empty($where)) {
            $query->where($where);
        }
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
            $where['and'] = [['date(`ctime`) >' => $begin_time], ['date(`ctime`) <' => $end_time]];
        }
        $Table = $this->Savant;
        $column = ['user_id', '推荐次数', '封面', '项目经验', '资源优势', '简洁'];
        $query = $Table->find();
        $query->hydrate(false);
        $query->select(['user_id', 'reco_nums', 'cover', 'xmjy', 'zyys', 'summary']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = 'Savant_' . date('Y-m-d') . '.csv';
        \Wpadmin\Utils\Export::exportCsv($column, $res, $filename);
    }
    
    /**
     * 审核通过
     * @param int $id 专家id
     */
    public function pass($id){
        $user = $this->User->get($id);
        $user->level = 2;
        $user->savant_status = 3;
        $res = $userTable->save($user);
        if($res){
            $this->loadComponent('Business');
            $this->Business->usermsg($savant->user_id, '专家申请新消息', '您的专家申请审核通过啦！', 5, $savant->id);
            return $this->Util->ajaxReturn(true, '审核通过');
        } else {
            return $this->Util->ajaReturn(false, '系统错误');
        }
    }
    
    /**
     * 审核不通过
     * @param int $id 专家id
     */
    public function unpass($id){
        $data = $this->request->data;
        $savant = $this->Savant->get($id);
        $userTable = \Cake\ORM\TableRegistry::get('user');
        $user = $userTable->get($savant->user_id);
        $user->level = 1;
        $user->savant_status = 0;
        $user->reason = $data['reason'];
        $res = $userTable->save($user);
        if($res){
            $this->loadComponent('Business');
            $this->Business->usermsg($savant->user_id, '专家申请新消息', '您的专家申请审核不通过！原因为：' . $data['reason'], 5, $savant->id);
            return $this->Util->ajaxReturn(true, '审核不通过');
        } else {
            return $this->Util->ajaReturn(false, '系统错误');
        }
    }
    
    /**
     * 
     */
    public function getRandomSavants(){
        $tags = $this->request->query('tags');
        //拥有该标签的所有专家
        $UserTable = \Cake\ORM\TableRegistry::get('User');
        $UserTable->displayField('id');
        $savants = $UserTable->find('list')
                        ->distinct(['User.id'])
                        ->select(['id'])
                        ->matching('Industries', function($q)use($tags) {
                            return $q->where(['Industries.id in' =>$tags ]);
                        })->where(['User.level'=>2])->order('rand()')->limit(4)
                        ->toArray();
        $savants = array_values($savants);               
        $res = ['ids'=>$savants];
        $this->response->type('json');
        $this->response->body(json_encode($res));
        $this->response->send();
        $this->response->stop();
    }
}
