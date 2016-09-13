<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * User Controller  高级会员
 *
 * @property \App\Model\Table\UserTable $User
 */
class SeniorController extends AppController {

    protected $User;

    public function initialize() {
        $this->loadModel('User');
        parent::initialize();
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->set('user', $this->User);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->autoLayout(false);
        $user = $this->User->get($id, [
            'contain' => ['Industries']
        ]);
        $genderConf = \Cake\Core\Configure::read('gender');
        $levelConf = \Cake\Core\Configure::read('userLevel');
        $savantStatusConf = \Cake\Core\Configure::read('savantStatus');
        $user->gender = $genderConf[$user->gender];
        $user->level = $levelConf[$user->level];
        $user->savant_status = $savantStatusConf[$user->savant_status];
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $user = $this->User->newEntity();
        if ($this->request->is('post')) {
            $user->user_token = md5(uniqid());
            $user->avatar = '/mobile/images/touxiang.jpg';
            $user = $this->User->patchEntity($user, $this->request->data);
            if ($this->User->save($user)) {
                $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $errors = $user->errors();
                $this->Util->ajaxReturn(['stauts' => false, 'msg' => errorMsg($user, '添加失败'), 'errors' => $errors]);
            }
        }
        $industries = $this->User->Industries->find('list', ['limit' => 200]);
        $this->set(compact('user', 'industries'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $user = $this->User->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['post', 'put'])) {
            $user = $this->User->patchEntity($user, $this->request->data);
            if ($this->User->save($user)) {
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $errors = $user->errors();
                $this->Util->ajaxReturn(false, getMessage($errors));
            }
        }
        $isSuperAdmin = true;
        if ($this->_user->username != 'admin') {
            $where['admin_id'] = $this->_user->id;
            $isSuperAdmin = false;
        }
        $industries = $this->User->Industries->find('list', ['limit' => 200]);
        $this->set(compact('user', 'industries','isSuperAdmin'));
    }

    
    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod('post');
        $id = $this->request->data('id');
        if ($this->request->is('post')) {
            $user = $this->User->get($id);
            $user->enabled = 0;
            $user->softDelete();
            if ($this->User->save($user)) {
                $this->Util->ajaxReturn(true, '删除成功');
            } else {
                $errors = $user->errors();
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
        $where = ['grade' => 2,'is_del'=>0];
        if ($this->_user->username != 'admin') {
            $where['admin_id'] = $this->_user->id;
        }
        if (!empty($keywords)) {
            $where['or'] = [['truename like' => "%$keywords%"], ['email like' => "%$keywords%"], ['phone like' => "%$keywords%"]];
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(`create_time`) >' => $begin_time], ['date(`create_time`) <' => $end_time]];
        }
        if ($this->request->query('type') == '1') {
            $where['status'] = 1;
        }
        $query = $this->User->find();
        $query->contain(['Customer']);
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
        $where = ['grade' => 2];
        if ($this->_user->username != 'admin') {
            $where['admin_id'] = $this->_user->id;
        }
        if (!empty($keywords)) {
            $where['truename like'] = "%$keywords%";
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(`ctime`) >' => $begin_time], ['date(`ctime`) <' => $end_time]];
        }
        $Table = $this->User;
        $column = ['手机号', '姓名', '会员','等级', '公司', '职位', '邮箱', '性别', '常驻城市', '会员认证','账号状态', '注册时间'];
        $query = $Table->find();
        $query->hydrate(false);
        $query->select(['phone', 'truename', 'level','grade', 'company', 'position', 'email', 'gender', 'city','savant_status','enabled', 'create_time']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $query->formatResults(function($items) {
            return $items->map(function($item) {
                        //时间语义化转换
                        $item['gender'] = $item['gender'] == '1' ? '男' : '女';
                        $item['enabled'] = $item['enabled'] == '1' ? '正常' : '禁用';
                        switch ($item['grade']) {
                            case '1':
                                $item['grade'] = '普通';
                                break;
                            case '2':
                                $item['grade'] = '高级';
                                break;
                            case '3':
                                $item['grade'] = 'vip';
                                break;
                            default:
                                $item['grade'] = '普通';
                                break;
                        }
                        switch ($item['level']) {
                            case '1':
                                $item['level'] = '普通';
                                break;
                            case '2':
                                $item['level'] = '会员';
                                break;
                            default:
                                $item['level'] = '普通';
                                break;
                        }
                        switch ($item['savant_status']) {
                            case '1':
                                $item['savant_status'] = '未认证';
                                break;
                            case '2':
                                $item['savant_status'] = '待审核';
                                break;
                            case '3':
                                $item['savant_status'] = '审核通过';
                                break;
                            case '0':
                                $item['savant_status'] = '审核不通过';
                                break;
                            default:
                                $item['savant_status'] = '普通';
                                break;
                        }
                        return $item;
                    });
        });
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = '高级会员_' . date('Y-m-d') . '.xlsx';
        $this->loadComponent('Export');
        $this->Export->phpexcelExport($filename, $column, $res);
    }

    /**
     * 实名认证管理
     */
    public function realname() {
        
    }

    /**
     * 处理jgqrid 的 celledit
     */
    public function handChange() {
        if ($this->request->is('post')) {
            $entity = $this->User->get($this->request->data('id'));
            $data = $this->request->data();
            unset($data['id']);
            unset($data['oper']);
            $entity = $this->User->patchEntity($entity, $data);
            if (isset($data['savant_status'])) {
                if ($data['savant_status'] == '3') {
                    $entity->level = 2;
                }
            }
            if ($this->User->save($entity)) {
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $this->Util->ajaxReturn(false, '保存失败');
            }
        }
    }

    /**
     *  禁用和启用用户
     * @param type $id
     */
    public function ableUser() {
        if ($this->request->is('post')) {
            $entity = $this->User->get($this->request->data('id'));
            $entity->enabled = $entity->enabled == 1 ? 0 : 1;
            if ($this->User->save($entity)) {
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $this->Util->ajaxReturn(false, '保存失败');
            }
        }
    }

}
