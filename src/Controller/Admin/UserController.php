<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * User Controller
 *
 * @property \App\Model\Table\UserTable $User
 * @property \App\Controller\Component\ExportComponent $Export 导出组件
 */
class UserController extends AppController {

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
            'contain' => ['Industries','Agencies','Educations','Careers','Focus','Followers.Users'=>function($q){
                return $q->select(['truename','avatar','id']);
            },'Focus.Followings'=>function($q){
                return $q->select(['truename','avatar','id']);
            }]
        ]);
        //查询资讯评论数
        $NewscomTable = \Cake\ORM\TableRegistry::get('Newscom');
        $newscom_count = $NewscomTable->find()->where(['user_id'=>$id])->count();
        
        //查询活动评论数
        $ActivitycomTable = \Cake\ORM\TableRegistry::get('Activitycom');
        $activitycom_count = $ActivitycomTable->find()->where(['user_id'=>$id])->count();
        
        $genderConf = \Cake\Core\Configure::read('gender');
        $levelConf = \Cake\Core\Configure::read('userLevel');
        $savantStatusConf = \Cake\Core\Configure::read('savantStatus');
        $user->gender = $genderConf[$user->gender];
        $user->level = $levelConf[$user->level];
        $user->savant_status = $savantStatusConf[$user->savant_status];
        $this->set([
            'newscom_count'=>$newscom_count,
            'activitycom_count'=>$activitycom_count
        ]);
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
            $data = $this->request->data();
            $data['device'] = 'backend';
            $ckReg = $this->User->find()->where(['phone'=>$data['phone']])->first();
            if($ckReg){
                $this->Util->ajaxReturn(false,'该手机号已经注册过');
            }
            $user->user_token = md5(uniqid());
            $user->avatar = '/mobile/images/touxiang.jpg';
            //隐私设置
            $data['grbq'] = serialize($this->request->data('grbq'));
            $data['secret'] =  [
                'phone_set'=>2,
                'email_set'=>2,
                'career_set'=>1,
                'education_set'=>1
            ];
            $user = $this->User->patchEntity($user,$data);
            if ($this->User->save($user)) {
                 //redis 删除该记录
                $redis = new \Redis();
                $redis_conf = \Cake\Core\Configure::read('redis_server');
                $redis->connect($redis_conf['host'],$redis_conf['port']);
                $redis->sAdd('phones',$user->phone);
                $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $errors = $user->errors();
                $this->Util->ajaxReturn(['stauts' => false, 'msg' => errorMsg($user, '添加失败'), 'errors' => $errors]);
            }
        }
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
            'contain' => ['Educations','Careers','Industries']
        ]);
        if ($this->request->is(['post', 'put'])) {
            $data = $this->request->data();
            $data['grbq'] = serialize($this->request->data('grbq'));
            $user = $this->User->patchEntity($user, $data);
            if ($this->User->save($user)) {
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $errors = $user->errors();
                $this->Util->ajaxReturn(false, getMessage($errors));
            }
        }
        $selIndustryIds = [];
        foreach ($user->industries as $k => $v) {
            $selIndustryIds[] = $v['id'];
        }
        $this->set(compact('user','selIndustryIds'));
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
                //redis 删除该记录
                $redis = new \Redis();
                $redis_conf = \Cake\Core\Configure::read('redis_server');
                $redis->connect($redis_conf['host'],$redis_conf['port']);
                $redis->sRemove('phones',$user->phone);
                //剔除登录态
                $SessionTable = \Cake\ORM\TableRegistry::get('Sessions');
                $SessionTable->deleteAll(['data like'=>"%$user->phone%"]);
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
        $agency_id = $this->request->data('agency_id');
        $industry_id = $this->request->data('industry_id');
        $where = ['is_del'=>0];
        if (!empty($keywords)) {
            $where['or'] = [
                ['truename like' => "%$keywords%"],
                ['position like' => "%$keywords%"],
                ['phone like' => "%$keywords%"],
                ['company like' => "%$keywords%"],
            ];
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(`create_time`) >' => $begin_time], ['date(`create_time`) <' => $end_time]];
        }
        $grade = $this->request->data('grade');
        if(!empty($grade)){
            $where['grade'] = $grade;
        }
        if(!empty($agency_id) && $agency_id !== '请选择'){
            $where['agency_id'] = $agency_id;
        }
        
        $account_status = $this->request->data('account_status');
        if($account_status=='1'||$account_status=='2'){
            $where['enabled'] = $account_status -1;
        }
        if($account_status == '3'){
            $where['is_del'] = 1;
        }
        if ($this->request->query('type') == '1') {
            $where['status'] = 1;
        }
        $query = $this->User->find();
        $query->hydrate(false);
        if($industry_id !== 'all' && !empty($industry_id)){
            $query->matching('UserIndustries', function($q)use($industry_id){
                return $q->where(['industry_id' => $industry_id]);
            });
        }
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
        $sort = 'User.' . $this->request->query('sidx');
        $order = $this->request->query('sort');
        $keywords = $this->request->query('keywords');
        $begin_time = $this->request->query('begin_time');
        $end_time = $this->request->query('end_time');
        $agency_id = $this->request->query('agency_id');
        $industry_id = $this->request->query('industry_id');
        $where = ['is_del'=>0];
        if (!empty($keywords)) {
            $where['or'] = [
                ['truename like' => "%$keywords%"],
                ['position like' => "%$keywords%"],
                ['phone like' => "%$keywords%"],
                ['company like' => "%$keywords%"],
            ];
        }
        if(!empty($agency_id) && $agency_id !== '请选择'){
            $where['agency_id'] = $agency_id;
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(`create_time`) >' => $begin_time], ['date(`create_time`) <' => $end_time]];
        }
        $Table = $this->User;
        $column = ['手机号', '姓名', '会员','等级', '公司', '职位', '邮箱', '性别', '常驻城市', '会员认证','账号状态', '注册时间'];
        $query = $Table->find();
        $query->hydrate(false);
        if($industry_id !== 'all' && !empty($industry_id)){
            $query->matching('UserIndustries', function($q)use($industry_id){
                return $q->where(['industry_id' => $industry_id]);
            });
        }
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
        $filename = '会员_' . date('Y-m-d') . '.xlsx';
        $this->loadComponent('Export');
        $this->Export->phpexcelExport($filename, $column, $res);
    }
    
    /**
     * 
     */
    public function exportCardExcel(){
        $UserTable = \Cake\ORM\TableRegistry::get('User');
        $user = $UserTable->find()
                ->where(['enabled'=>1])
                ->contain(['GetCards'=>function($q){
                    return $q->select(['uid', 'ownerid']);
                }, 'GiveCards'=>function($q){
                    return $q->select(['uid', 'ownerid']);
                }])
                ->select(['User.phone','User.truename', 'User.position', 'User.company', 'User.id', 'User.fans'])
                ->hydrate(false)
                ->toArray();
        foreach ($user as $k=>$v){
            $user[$k]['get_nums'] = count($v['get_cards']);
            $user[$k]['give_nums'] = count($v['give_cards']);
            unset($user[$k]['get_cards']);
            unset($user[$k]['give_cards']);
            unset($user[$k]['id']);
        }
        $column = ['手机号', '姓名', '职位', '公司', '粉丝数', '收到名片', '发出名片'];
        $filename = '会员_' . date('Y-m-d') . '.xlsx';
        $this->loadComponent('Export');
        $this->Export->phpexcelExport($filename, $column, $user);
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
    public function ableUser(){
          if ($this->request->is('post')) {
            $entity = $this->User->get($this->request->data('id'));
            $entity->enabled = $entity->enabled==1?0:1;
            if ($this->User->save($entity)) {
                $redis = new \Redis();
                $redis_conf = \Cake\Core\Configure::read('redis_server');
                $redis->connect($redis_conf['host'],$redis_conf['port']);
                if($entity->enabled == 0){
                     //redis 删除该记录
                    $redis->sRemove('phones',$entity->phone);
                    //剔除登录态
                    $SessionTable = \Cake\ORM\TableRegistry::get('Sessions');
                    $SessionTable->deleteAll(['data like'=>"%$entity->phone%"]);
                }else{
                    $redis->sAdd('phones',$entity->phone);
                }
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $this->Util->ajaxReturn(false, '保存失败');
            }
        }
    }
    
    public function education(){
        if ($this->request->is('post')) {
            $EducationTable = \Cake\ORM\TableRegistry::get('Education');
            $education = $EducationTable->get($this->request->data('id'));
            $data = $this->request->data();
            unset($data['id']);
            $education = $EducationTable->patchEntity($education, $data);
            if ($EducationTable->save($education)) {
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $this->Util->ajaxReturn(false, '保存失败');
            }
        }
    }
    
    
    /**
     * 获取消息
     */
    public function getUserProfile(){
        $id = $this->request->query('id');
        $user = $this->User->find()
                ->select(['id','truename','company','avatar','position'])
                ->where(['id'=>$id])
                ->first();
        $this->Util->ajaxReturn(['user'=>$user]);
    }
    
    /**
     * 添加教育经历
     */
    public function addEducation($id=null){
        $EducationTable = \Cake\ORM\TableRegistry::get('Education');
        $data = $this->request->data();
        $data['user_id'] = $id;
        $education = $EducationTable->newEntity($data);
        if($EducationTable->save($education)){
            $this->Util->ajaxReturn(true,'添加成功');
        }else{
            $this->Util->ajaxReturn(false,  errorMsg($education, '添加失败'));
        }
    }
    /**
     * 添加教育经历
     */
    public function delEducation(){
        $id = $this->request->query('id');
        $EducationTable = \Cake\ORM\TableRegistry::get('Education');
        $education = $EducationTable->get($id);
        if($EducationTable->delete($education)){
            $this->Util->ajaxReturn(true,'删除成功');
        }else{
            $this->Util->ajaxReturn(false,'删除失败');
        }
    }
    /**
     * 添加教育经历
     */
    public function saveEducation($id=null){
        $EducationTable = \Cake\ORM\TableRegistry::get('Education');
        $education = $EducationTable->get($id);
        $data = $this->request->data();
        $education = $EducationTable->patchEntity($education,$data);
        if($EducationTable->save($education)){
            $this->Util->ajaxReturn(true,'修改成功');
        }else{
            $this->Util->ajaxReturn(false,  errorMsg($education, '修改失败'));
        }
    }
    
    /**
     * 添加教育经历
     */
    public function addCareer($id=null){
        $EducationTable = \Cake\ORM\TableRegistry::get('Career');
        $data = $this->request->data();
        $data['user_id'] = $id;
        $education = $EducationTable->newEntity($data);
        if($EducationTable->save($education)){
            $this->Util->ajaxReturn(true,'添加成功');
        }else{
            $this->Util->ajaxReturn(false,  errorMsg($education, '添加失败'));
        }
    }
    
    
        /**
     * 添加教育经历
     */
    public function saveCareer($id=null){
        $EducationTable = \Cake\ORM\TableRegistry::get('Career');
        $education = $EducationTable->get($id);
        $data = $this->request->data();
        $education = $EducationTable->patchEntity($education,$data);
        if($EducationTable->save($education)){
            $this->Util->ajaxReturn(true,'修改成功');
        }else{
            $this->Util->ajaxReturn(false,  errorMsg($education, '修改失败'));
        }
    }
    
    /**
     * 添加教育经历
     */
    public function delCareer(){
        $id = $this->request->query('id');
        $EducationTable = \Cake\ORM\TableRegistry::get('Career');
        $education = $EducationTable->get($id);
        if($EducationTable->delete($education)){
            $this->Util->ajaxReturn(true,'删除成功');
        }else{
            $this->Util->ajaxReturn(false,'删除失败');
        }
    }
}
