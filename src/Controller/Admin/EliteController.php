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
class EliteController extends AppController {

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
        $this->set('user', $this->User);
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
        $users = $this->User->newEntity();
        if ($this->request->is('post')) {
            $user_id = $this->request->data('user_id');
            $user = $this->User->get($user_id);
            $user->is_elite = 1;
            $UserTable = $this->User;
            $res = $UserTable->save($user);
            if ($res) {
                $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $errors = $user->errors();
                $this->Util->ajaxReturn(['status' => false, 'msg' => getMessage($errors), 'errors' => $errors]);
            }
        }
        $savant = $this->User->Savants->find('list', ['limit' => 200]);
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
            $user = $this->User->get($id);
            $user->is_elite = 0;
            $res = $this->User->save($user);
            if ($res) {
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
        $sort = $this->request->data('sidx');
        if(preg_match('/\./', $sort)){
            $sort = ucfirst($sort);
        }else{
            $sort = 'User.' . $this->request->data('sidx');
        }
        $order = $this->request->data('sord');
        $keywords = $this->request->data('keywords');
        $begin_time = $this->request->data('begin_time');
        $end_time = $this->request->data('end_time');
        $where['enabled'] = 1;
        $where['is_elite'] = 1;
        $where['User.savant_status'] = 3;
        if (!empty($keywords)) {
            $where['or'] = [['truename like' => "%$keywords%"], ['company like' => "%$keywords%"], ['phone like' => "%$keywords%"]];
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(`create_time`) >' => $begin_time], ['date(`create_time`) <' => $end_time]];
        }
        $query = $this->User->find()
                ->select(['User.id', 'User.phone','User.card_path' ,'User.grade', 'User.truename', 'User.company', 'User.position', 'User.is_elite_top',
                    'User.meet_nums', 'User.truename', 'Savant.reco_nums', 'User.savant_status', 'Savant.xmjy', 'Savant.zyys', 'Savant.summary'])
                ->contain(['Savant']);
        if (!empty($where)) {
            $query->where($where);
        }
        $nums = $query->count();
        if (!empty($sort) && !empty($order)) {
            $query->order(['is_elite_top' => 'desc', 'elite_top_time'=>'desc', $sort => $order]);
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
     * 置顶
     * @param type $id
     */
    public function top($id) {
        $user = $this->User->get($id);
        $user->is_elite_top = $user->is_elite_top == 1 ? 0 : 1;
        $user->elite_top_time = \Cake\I18n\Time::now();
        $res = $this->User->save($user);
        if ($res) {
            return $this->Util->ajaxReturn(true, '操作成功');
        } else {
            return $this->Util->ajaReturn(false, '操作失败');
        }
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

}
