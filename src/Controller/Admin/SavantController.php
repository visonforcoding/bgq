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
        if ($this->request->query('do')) {
            $this->set('do', 'check');
        }
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
        $savant = $this->User->get($id, [
            'contain' => ['Savant']
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
            $user_id = $this->request->data('user_id');
            $user = $this->User->get($user_id);
            $user->level = 2;
            $user->savant_status  = 3;
            $SavantTable = \Cake\ORM\TableRegistry::get('Savant');
            $savant = $SavantTable->newEntity($this->request->data());
            $UserTable = $this->User;
            $trans = $this->User->connection()->transactional(function()use($UserTable,$user,$SavantTable,$savant){
                return $SavantTable->save($savant)&&$UserTable->save($user);
            });
            if ($trans) {
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
        $user = $this->User->get($id, [
            'contain' => ['Educations', 'Careers', 'Savant','Subjects'=>[
                'conditions'=>['is_del'=>0]
            ]]
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
        $this->set(compact('user'));
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
        $sort = $this->request->data('sidx');
        if(preg_match('/\./', $sort)){
            $sort = ucfirst($sort);
        }else{
            $sort = 'User.' . $this->request->data('sidx');
        }
        $order = $this->request->data('sord');
        $keywords = $this->request->data('keywords');
        $savant_status = $this->request->data('savant_status');
        $begin_time = $this->request->data('begin_time');
        $end_time = $this->request->data('end_time');
        $where = ['enabled'=>1];
        if ($savant_status > -1) {
            $where['and']['User.savant_status'] = $savant_status;
        }
        if ($this->request->query('do') == 'check' && $savant_status === NULL) {
            $where['and']['User.savant_status'] = 2;
        }
        $where['and']['User.savant_status !='] = 1;
        if (!empty($keywords)) {
            $where['or'] = [['truename like' => "%$keywords%"], ['company like' => "%$keywords%"], ['phone like' => "%$keywords%"]];
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(`create_time`) >' => $begin_time], ['date(`create_time`) <' => $end_time]];
        }
        $query = $this->User->find()->select(['User.id', 'User.phone','User.card_path' ,'User.grade', 'User.truename', 'User.company', 'User.position', 'User.is_top',
                    'User.meet_nums', 'User.truename', 'Savant.reco_nums', 'User.savant_status', 'Savant.xmjy', 'Savant.zyys', 'Savant.summary'])
                ->contain(['Savant']);
        if (!empty($where)) {
            $query->where($where);
        }
        $nums = $query->count();
        if (!empty($sort) && !empty($order)) {
            $query->order(['is_top' => 'desc', $sort => $order]);
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
        $savant_status = $this->request->query('savant_status');
        if ($savant_status > 1) {
            $where = ['User.savant_status' => $savant_status];
        }
        if ($this->request->query('do') == 'check' && $savant_status === NULL) {
            $where = ['User.savant_status' => 2];
        }
        if (!empty($keywords)) {
            $where['username like'] = "%$keywords%";
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(`ctime`) >' => $begin_time], ['date(`ctime`) <' => $end_time]];
        }
        $Table = $this->Savant;
        $column = ['姓名', '公司', '职位', '手机号','性别', '约见次数', '推荐次数', '审核情况','注册时间'];
        $query = $Table->find();
        $query->contain(['Users']);
        $query->hydrate(false);
        $query->select(['user_truename' => 'Users.truename', 'user_company' => 'Users.company', 'user_position' => 'Users.position',
            'user_phone' => 'Users.phone','gender'=>'Users.gender', 'meet_nums' => 'Users.meet_nums', 'reco_nums' => 'reco_nums',
            'savant_status'=>'Users.savant_status','create_time' => 'Users.create_time']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order(['is_top' => 'desc', $sort => $order]);
        }
        $query->formatResults(function($items) {
            return $items->map(function($item) {
                        //时间语义化转换
                        $item['gender'] = $item['gender'] == '1' ? '男' : '女';
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
        $filename = '会员数据_' . date('Y-m-d') . '.xls';
        $this->loadComponent('Export');
        $this->Export->phpexcelExport($filename, $column, $res);
    }

    /**
     * 审核通过
     * @param int $id 专家id
     */
    public function pass($id) {
        $user = $this->User->get($id);
        $user->level = 2;
        $user->savant_status = 3;
        $res = $this->User->save($user);
        if ($res) {
            //记录
            $SavantApplyTable = \Cake\ORM\TableRegistry::get('SavantApply');
            $apply = $SavantApplyTable->find()->where(['user_id' => $id])->orderDesc('id')->first();
            if($apply){
                $apply->check_man = $this->_user->truename;
                $apply->action = 1;
                $SavantApplyTable->save($apply);
            }
            $SavantTable = \Cake\ORM\TableRegistry::get('Savant');
            $savant = $SavantTable->find()->where(['user_id'=>$id])->first();
            $savant->check_time = date('Y-m-d H:i:s');
            $SavantTable->save($savant);
            $this->loadComponent('Business');
            $this->Business->usermsg('-1', $user->user_id, '会员申请新消息', '您的会员申请审核通过啦！', 5, $user->id);
            return $this->Util->ajaxReturn(true, '审核通过');
        } else {
            return $this->Util->ajaReturn(false, '系统错误');
        }
    }

    /**
     * 置顶
     * @param type $id
     */
    public function top($id) {
        $user = $this->User->get($id);
        $user->is_top = $user->is_top == 1 ? 0 : 1;
        $res = $this->User->save($user);
        if ($res) {
            return $this->Util->ajaxReturn(true, '操作成功');
        } else {
            return $this->Util->ajaReturn(false, '操作失败');
        }
    }

    /**
     * 审核不通过 0未审核 1审核通过 -1审核不通过
     * @param int $id 专家id
     */
    public function unpass($id) {
        $data = $this->request->data;
        $user = $this->User->get($id);
        $user->level = 1;
        $user->savant_status = 0;
        $res = $this->User->save($user);
        if ($res) {
            //记录
            $SavantApplyTable = \Cake\ORM\TableRegistry::get('SavantApply');
            $apply = $SavantApplyTable->find()->where(['user_id' => $id])->orderDesc('id')->first();
            $reason = $data['reason'];
            $apply->check_man = $this->_user->truename;
            $apply->reason = $reason;
            $apply->action = -1;
            $SavantApplyTable->save($apply);
            //消息
            $this->loadComponent('Business');
            $this->Business->usermsg('-1', $id, '会员申请新消息', '您的会员申请审核不通过！原因为：' . $data['reason'], 5, $id);
            return $this->Util->ajaxReturn(true, '审核不通过');
        } else {
            return $this->Util->ajaReturn(false, '系统错误');
        }
    }

    /**
     * 
     */
    public function getRandomSavants() {
        $tags = $this->request->query('tags');
        //拥有该标签的所有专家
        $UserTable = \Cake\ORM\TableRegistry::get('User');
        $UserTable->displayField('id');
        $savants = $UserTable->find('list')
                ->distinct(['User.id'])
                ->select(['id'])
                ->matching('Industries', function($q)use($tags) {
                    return $q->where(['Industries.id in' => $tags]);
                })->where(['User.level' => 2])->order('rand()')->limit(4)
                ->toArray();
        $savants = array_values($savants);
        $res = ['ids' => $savants];
        $this->response->type('json');
        $this->response->body(json_encode($res));
        $this->response->send();
        $this->response->stop();
    }

    /**
     * 申请记录
     */
    public function showApply($id) {
        $this->viewBuilder()->autoLayout(false);
        $SavantApplyTable = \Cake\ORM\TableRegistry::get('SavantApply');
        $savantStatusConf = \Cake\Core\Configure::read('savantStatus');
        $applys = $SavantApplyTable->find()->contain(['Users'])->where(['user_id' => $id])
                ->formatResults(function($items)use($savantStatusConf) {
                    return $items->map(function($item)use($savantStatusConf) {
                                switch ($item->action) {
                                    case 1:
                                        $item['savant_str'] = '通过';
                                        break;
                                    case -1:
                                        $item['savant_str'] = '不通过';
                                        break;
                                    case 0:
                                        $item['savant_str'] = '未审核';
                                        break;
                                    default:
                                        break;
                                }
                                return $item;
                            });
                })
                ->toArray();
        $this->set([
            'applys' => $applys,
        ]);
    }

    /**
     * 话题管理
     */
    public function showSubject($id = null) {
        if ($id) {
            $this->set('user_id', $id);
        }
    }

    public function saveSavant($id = null) {
        $SavantTable = \Cake\ORM\TableRegistry::get('Savant');
        $savant = $SavantTable->find()->where(['user_id' => $id])->first();
        $savant = $SavantTable->patchEntity($savant, $this->request->data());
        if ($SavantTable->save($savant)) {
            $this->Util->ajaxReturn(true, '修改成功');
        } else {
            $this->Util->ajaxReturn(false, '修改失败');
        }
    }
    
    /**
     * 修改话题
     */
    public function saveSubject($id){
        $SubjectTable = \Cake\ORM\TableRegistry::get('MeetSubject');
        $subject = $SubjectTable->get($id);
        $subject = $SubjectTable->patchEntity($subject, $this->request->data());
        if ($SubjectTable->save($subject)) {
            $this->Util->ajaxReturn(true, '修改成功');
        } else {
            $this->Util->ajaxReturn(false, '修改失败');
        }
    }
    /**
     * 修改话题
     */
    public function delSubject(){
        $id = $this->request->query('id');
        $SubjectTable = \Cake\ORM\TableRegistry::get('MeetSubject');
        $subject = $SubjectTable->get($id);
        $subject->is_del = 1;
        if ($SubjectTable->save($subject)) {
            $this->Util->ajaxReturn(true, '删除成功');
        } else {
            $this->Util->ajaxReturn(false, '删除失败');
        }
    }
    /**
     * 修改话题
     */
    public function addSubject($id=null){
        $SubjectTable = \Cake\ORM\TableRegistry::get('MeetSubject');
        $subject = $SubjectTable->newEntity();
        $subject = $SubjectTable->patchEntity($subject, $this->request->data());
        $subject->user_id = $id;
        if ($SubjectTable->save($subject)) {
            $this->Util->ajaxReturn(true, '添加成功');
        } else {
            $this->Util->ajaxReturn(false, '添加失败');
        }
    }
    
    /**
     * 到处审核记录
     */
    public function exportExcelCheck(){
        $SavantApplyTable = \Cake\ORM\TableRegistry::get('SavantApply');
        $savantStatusConf = \Cake\Core\Configure::read('savantStatus');
        $applys = $SavantApplyTable->find()
                ->contain(['Users' => function($q){
                    return $q->where(['enabled'=>1]);
                }])
                ->formatResults(function($items)use($savantStatusConf) {
                    return $items->map(function($item)use($savantStatusConf) {
                                switch ($item->action) {
                                    case 1:
                                        $item['savant_str'] = '通过';
                                        break;
                                    case -1:
                                        $item['savant_str'] = '不通过';
                                        break;
                                    case 0:
                                        $item['savant_str'] = '未审核';
                                        break;
                                    default:
                                        break;
                                }
                                return $item;
                            });
                })
                ->toArray();
        $res = [];
        foreach ($applys as $k=>$v){
            $res[$k]['username'] = $v->user->truename;
            $res[$k]['company'] = $v->user->company;
            $res[$k]['position'] = $v->user->position;
            $res[$k]['phone'] = $v->user->phone;
            $res[$k]['create_time'] = $v->create_time->format('Y-m-d H:i:s');
            $res[$k]['xmjy'] = $v->xmjy;
            $res[$k]['zyys'] = $v->zyys;
            $res[$k]['action'] = $v->action == 1 ? '通过' : '不通过';
            $res[$k]['check_man'] = $v->check_man;
            $res[$k]['reason'] = $v->reason;
        }
        $this->autoRender = false;
        $filename = '会员审核记录_' . date('Y-m-d') . '.xls';
        $this->loadComponent('Export');
        $column = ['姓名', '公司', '职位', '手机号', '申请时间', '项目经验', '资源优势','处理情况', '审核员', '审核意见'];
        $this->Export->phpexcelExport($filename, $column, $res);
    }

}
