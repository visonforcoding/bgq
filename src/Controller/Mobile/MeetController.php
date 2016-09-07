<?php

namespace App\Controller\Mobile;

use App\Controller\Mobile\AppController;

/**
 * Meet Controller  会员约见栏目
 *
 * @property \App\Model\Table\UserTable $User Description
 * @property \App\Controller\Component\BusinessComponent $Business 通用业务处理组件
 */
class MeetController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadModel('User');
    }

    protected $limit = '10'; // 分页条数
    
    /**
     * Index method  会员约见首页
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        // 轮播图
        $bannerTable = \Cake\ORM\TableRegistry::get('banner');
        $banners = $bannerTable
                ->find()
                ->where("`enabled` = '1' and `type` = '3'")
                ->orderDesc('create_time')
                ->limit(3)
                ->toArray();
        $this->set(compact('banners'));
        
        // 广告
        $biggieAdTable = \Cake\ORM\TableRegistry::get('BiggieAd');
        $biggieAds = $biggieAdTable->find()->contain(['Savants'=>function($q){
                return $q->contain(['Users'=>function($w){
                    return $w->where(['enabled'=>1, 'is_del'=>0]);
                }]);
            }])->all();
        $this->set('biggieAd', $biggieAds);
        
        $user_id = '';
        $is_savant = false;
        if($this->user){
            $user_id = $this->user->id;
            $UserTable = \Cake\ORM\TableRegistry::get('user');
            $user = $UserTable->get($user_id);
            if($user->level == 2){
                $is_savant = true;
            }
        }
        // 默认用户
        $users = $this
                ->User
                ->find()
                ->contain(['Subjects'=>function($exp){
                    return $exp->where(['is_del'=>0])->orderDesc('create_time')->limit(1);
                }, 'Followers'=>function($q)use($user_id){
                    return $q->where(['user_id'=>$user_id]);
                }])
                ->where(['enabled'=>'1', 'level'=>'2'])
                ->order(['is_top'=>'desc', 'subject_update_time'=>'desc'])
                ->limit($this->limit)
                ->formatResults(function($items) {
                    return $items->map(function($item) {
                        $item['avatar'] = getSmallAvatar($item['avatar']);
                        return $item;
                    });
                })
                ->toArray();
        $this->set('meetjson', json_encode($users));
        $this->set([
            'pageTitle'=>'约见',
            'user_id'=>$user_id,
            'is_savant'=>$is_savant,
        ]);
    }
    
    /**
     * 约见首页点击类别获取结果
     */
    public function getIndex(){
        $data = $this->request->data();
        $industry_id = $data['industry_id'];
        $users = $this
                ->User
                ->find()
                ->contain(['Subjects'])
                ->matching('Industries', function($q)use($industry_id) {
                    return $q->where(['Industries.id' => $industry_id]);
                })
                ->where(['enabled'=>'1', 'level'=>'2'])
//                ->limit($this->limit)
                ->toArray();
        if($users) {
            return $this->Util->ajaxReturn(['status'=>true, 'data'=>$users]);
        } else {
            return $this->Util->ajaxReturn(false, '暂无结果');
        }
    }

    /**
     * 约见推荐
     */
    public function meetReco() {
        $dakas = $this->User->find()
                ->hydrate(false)
                ->select(['id', 'truename', 'company', 'position', 'meet_nums', 'avatar'])
                ->where("`level`= '2' and `enabled` = '1'")
                ->orderDesc('meet_nums')
                ->toArray();
        $this->set([
            'dakas' => json_encode($dakas)
        ]);
    }

    /**
     * 会员类别查看  eg:互联网、大消费
     * @param type $id 行业标签id
     */
    public function meetCat($id = null) {
        //拥有该标签的所有会员
        $savants = $this->User->find()
                        ->matching('Industries', function($q)use($id) {
                            return $q->where(['Industries.id' => $id])->orWhere(['pid' => $id]);
                        })->toArray();
        //该标签类下的所有子类
        $sub_industries = $this->User->Industries->findByPid($id)->toArray();
        $this->set([
            'savants' => $savants,
            'sub_industries' => $sub_industries
        ]);
    }

    /**
     * 会员详情页
     */
    public function view($id = null) {
        $self = false;
        $isReco = '';
        if($this->user){
            if($id == $this->user->id){
                $self = true;
            }
        
            $user_id = $this->user->id;
            if(!$self){
                $isReco = $this->User->get($id, ['contain' => ['RecoUsers'=>function($q)use($user_id){
                    return $q->where(['user_id'=>$user_id]);
                }]]);
                $isReco = $isReco->reco_users;
                $biggie = $this->User->get($id);
                $biggie->savant_read_nums += 1;
                $this->User->save($biggie);
            }
        }
        $biggie = $this->User->get($id, [
            'contain' => [
                'Savant', 'Industries', 'Subjects'=>function($q){
                    return $q->where(['is_del'=>0]);
                },'RecoUsers'=>function($q){
                    return $q->limit(8);
                },'RecoUsers.Users'
            ]
        ]);
        $this->set([
            'biggie' => $biggie,
            'isReco'=>$isReco,
            'self'=>$self,
            'pageTitle'=>$biggie->truename.'的会员主页'
        ]);
    }

    /**
     * 主题详情页 ->预约操作
     * @param int $id
     */
    public function subjectDetail($id = null) {
        $this->handCheckLogin();
        $SubjectTable = \Cake\ORM\TableRegistry::get('MeetSubject');
        $subject = $SubjectTable->find()
                ->contain(['User'=>function($q){
                    return $q->select(['id','truename','company','position']);
                }])
                ->where(['MeetSubject.id' => $id])
                ->first();
        $this->set([
            'pageTitle'=>'话题详情'
        ]);
        $user_id = '';
        if($this->user){
            $user_id = $this->user->id;
        }
        $this->set(compact('subject', 'user_id'));
    }

    /**
     * 话题 添加 与 编辑 与删除
     */
    public function subject($id = null) {
        $this->handCheckLogin();
        $SubjectTable = \Cake\ORM\TableRegistry::get('meet_subject');
        $UserTable = \Cake\ORM\TableRegistry::get('user');
        if ($this->request->is('post')) {
            if(empty($id)){
                $subject = $SubjectTable->newEntity();
                $subject = $SubjectTable->patchEntity($subject, $this->request->data());
                $subject->user_id = $this->user->id;
            }else{
                $subject = $SubjectTable->get($id);
//                $subject->type = $this->request->data('type');
                $subject = $SubjectTable->patchEntity($subject, $this->request->data());
            }
            $now = \Cake\I18n\Time::now();
            $user = $UserTable->get($this->user->id);
            $user->subject_update_time = $now;
            $res = $SubjectTable->connection()->transactional(function()use($SubjectTable, $subject, $user, $UserTable){
                return $SubjectTable->save($subject) && $UserTable->save($user);
            });
            if ($res) {
                return $this->Util->ajaxReturn(true, '保存成功');
            } else {
                return $this->Util->ajaxReturn(false, errorMsg($subject, '保存失败'));
            }
        }
        if($id){
            $subject = $SubjectTable->get($id);
            $this->set('subject',$subject);
        }
        $this->set([
            'pageTitle'=>'话题编辑'
        ]);
    }
    
    
    /**
     * 话题的删除
     */
    public function delSubject($id){
        $this->handCheckLogin();
        $user_id = $this->user->id;
        $SubjectTable = \Cake\ORM\TableRegistry::get('meet_subject');
        if ($this->request->is('post')) {
            $subject = $SubjectTable->find()->where(['user_id'=>$user_id,'id'=>$id])->first();
            if($subject){
                if($SubjectTable->delete($subject)){
                    return $this->Util->ajaxReturn(true,'删除成功');
                }
            }
        }
        return $this->Util->ajaxReturn(false,'删除失败');
    }




    /**
     * 会员简介编辑
     */
    public function editSummary(){
        $user_id =  $this->user->id;
        $SavantTable = \Cake\ORM\TableRegistry::get('Savant');
        if($this->request->is('post')){
            $this->handCheckLogin();
            $savant = $SavantTable->findByUser_id($user_id)->first();
            if($savant){
                $savant->summary = $this->request->data('summary');
                if($SavantTable->save($savant)){
                    return $this->Util->ajaxReturn(true,'保存成功');
                }
            }
            return $this->Util->ajaxReturn(false, '保存失败');
        }
        $savant = $SavantTable->findByUser_id($user_id)->first();
        $this->set([
            'pageTitle'=>'简介修改',
            'summary' => $savant->summary,
            'id' => $this->user->id
        ]);
    }
    
    /**
     * 话题列表
     */
    public function mySubjects(){
        $this->handCheckLogin();
        $user_id = $this->user->id;
        $SubjectTable = \Cake\ORM\TableRegistry::get('MeetSubject');
        $userTable = \Cake\ORM\TableRegistry::get('user');
        $user = $userTable->get($user_id);
        $subjects = $SubjectTable->find()->where(['user_id'=>$user_id, 'is_del'=>0])->orderDesc('create_time')->toArray();
        $this->set([
            'pageTitle'=>'我的话题',
            'subjects'=>$subjects,
            'user' => $user
        ]);
    }
    
    /**
     * 话题列表
     */
    public function subjectList($id=null){
        $user_id = $id;
        $SubjectTable = \Cake\ORM\TableRegistry::get('MeetSubject');
        $userTable = \Cake\ORM\TableRegistry::get('user');
        $user = $userTable->get($user_id);
        $subjects = $SubjectTable->find()
                ->where(['MeetSubject.user_id'=>$user_id, 'MeetSubject.is_del'=>0])
                ->order(['MeetSubject.create_time'=>'desc'])
                ->toArray();
//        debug($subjects);die;
        $this->set([
            'pageTitle'=>'话题列表',
            'subjects'=>$subjects,
            'user' => $user
        ]);
    }




    /***
     * 话题预约页
     */
    public function book($id = null){
        $self = false;
        if($this->user){
            if($this->user->id==$id){
                $self = true;
            }
        }
        $SubjectTable = \Cake\ORM\TableRegistry::get('MeetSubject');
        $subject = $SubjectTable->find()
                ->contain(['User'=>function($q){
                    return $q->select(['id','truename','company','position']);
                }])
                ->where(['MeetSubject.id' => $id])
                ->first();
        if($this->request->is('ajax')){
            $this->handCheckLogin();
            $UserTable = \Cake\ORM\TableRegistry::get('user');
            $user = $UserTable->get($this->user->id, [
                'contain' => ['Careers', 'Educations', 'Industries']
            ]);
            $is_complete = $user->company && $user->gender && $user->position && $user->email && 
                    $user->industries && $user->city && $user->goodat && $user->gsyw && $user->educations 
                    && $user->careers && $user->card_path;
            if(!$is_complete){
                return $this->Util->ajaxReturn(false, '请先去完善个人资料');
            }
            $data['subject_id'] = $id;
            $data['summary'] = $this->request->data('summary');
            $data['user_id']  = $this->user->id;
            $data['savant_id']  = $subject->user->id;
            $data['status']  = 0;  //默认状态
            if($this->user->id==$subject->user->id){
                return $this->Util->ajaxReturn(false,'不可约见自己');
            }
            $SubjectBookTable = \Cake\ORM\TableRegistry::get('SubjectBook');
            $subjectBook = $SubjectBookTable->find()->where(['subject_id'=>$id, 'user_id'=>$this->user->id,'status <'=>2])->first();
            if($subjectBook){
                //该话题约见过了
                return $this->Util->ajaxReturn(false,'该话题您已约见过正在进行中');
            }
            $BookTable = \Cake\ORM\TableRegistry::get('SubjectBook');
            $book = $BookTable->newEntity($data);
            if($BookTable->save($book)){
                $this->loadComponent('Business');
                $user_id = $subject->user->id;
                $this->Business->usermsg($user_id,'话题预约','您有新的话题预约请求', 4, $book->id, '/home/my-book/#4');
                return $this->Util->ajaxReturn(true,'预定成功');
            }else{
                $error = errorMsg($book,'预定失败');
                return $this->Util->ajaxReturn(false,$error);
            }
            
        }
        $this->set([
            'pageTitle'=>'话题预约',
            'self'=>$self
        ]);
        $this->set(compact('subject'));
    }
    
    
    /**
     * 推荐的查看更多
     */
    public function viewMoreReco($id=null){
        $RecomTable = \Cake\ORM\TableRegistry::get('SavantReco');
        $recoms = $RecomTable->find()->contain(['Users'=>function($q){
            return $q->where(['enabled'=>1])->select(['id', 'avatar', 'truename', 'company', 'position']);
        }])->where(['savant_id'=>$id])
                ->orderDesc('SavantReco.create_time')
                ->toArray();
        $this->set([
            'pageTitle'=>'查看更多',
            'recoms'=>$recoms
        ]);
    }


    /**
     * 预定成功页
     */
    public function bookSuccess($id){
        $this->set([
            'pageTitle'=> '预约成功',
            'id'=>$id
        ]);
    }
    
    /**
     * 搜索页
     */
    public function search(){
        $this->set('search');
        $this->set('pageTitle', '会员搜索');
    }

    /**
     * ajax获取搜索结果
     */
    public function getSearchRes(){
        $data = $this->request->data();
        $keyword = $data['keyword'];
        $users = $this
                ->User
                ->find()
                ->contain(['Subjects'=>function($q){
                    return $q->where(['Subjects.is_del'=>0]);
                }])
                ->distinct(['User.id'])
                ->matching('Subjects', function($q)use($keyword){
                    return $q;
                })
                ->Where(['enabled'=>'1', 'level'=>'2','truename like'=>"%$keyword%"])
                ->orWhere(['Subjects.title like'=>"%$keyword%", 'enabled'=>'1'])
                ->limit($this->limit)
                ->formatResults(function($items) {
                    return $items->map(function($item) {
                        $item['avatar'] = getSmallAvatar($item['avatar']);
                        return $item;
                    });
                })
                ->toArray();
        if($users) {
            return $this->Util->ajaxReturn(['status' => true, 'msg' => '', 'data' => $users]);
        } else {
            return $this->Util->ajaxReturn(false, '暂无搜索结果');
        }
    }
    
    /**
     * 滑动搜索结果加载更多
     * @param int $page
     */
    public function getMoreSearch($page){
        $data = $this->request->data();
        $keyword = $data['keyword'];
        $users = $this
                ->User
                ->find()
                ->contain(['Subjects'=>function($q){
                    return $q;
                }])
                ->distinct(['User.id'])
                ->matching('Subjects', function($q)use($keyword){
                    return $q->where(['Subjects.is_del'=>0]);
                })
                ->Where(['enabled'=>'1', 'level'=>'2','truename like'=>"%$keyword%"])
                ->orWhere(['Subjects.title like'=>"%$keyword%", 'enabled'=>'1'])
                ->page($page, $this->limit)
                ->formatResults(function($items) {
                    return $items->map(function($item) {
                        $item['avatar'] = getSmallAvatar($item['avatar']);
                        return $item;
                    });
                })
                ->toArray();
        if($users) {
            return $this->Util->ajaxReturn(['status' => true, 'msg' => '', 'data' => $users]);
        } else {
            return $this->Util->ajaxReturn(false, '暂无搜索结果');
        }
    }
    
    /**
     * 个人主页
     * @param type $id 用户id
     */
    public function homepage($id){
        $isMe = '';
        $type = '0';// 关注类型初始化
        $isGive = '';
        if ($this->user) {
            if ($this->user->id == $id) {
                $isMe = true;
            }else{
                $isAttention = $this->User->UserFans->find()->where(['user_id' => $this->user->id, 'following_id' => $id])->first();
                if($isAttention){
                    $type = $isAttention->type;
                }
                $isGiveCard = $this->User->CardBoxes->find()->where(['ownerid'=>$id, 'uid'=>$this->user->id])->first();
                if($isGiveCard){
                    $isGive = $isGiveCard;
                }
            }
        }
        $user = $this->User->get($id, [
            'contain' => ['Industries', 'Careers', 'Educations'],
        ]);
        
        $this->set('type', $type);
        $this->set('isMe', $isMe);
        $this->set('isGive', $isGive);
        $this->set('user', $user);
    }
    
    /**
     * 约见收藏
     * @param int $id 大咖用户id
     */
    public function collect($id){
        $this->handCheckLogin();
        $this->loadComponent('Business');
        $res = $this->Business->collectIt($this->user->id, $id, 2);
        if($res !== false)
        {
            $res['status'] = true;
            return $this->Util->ajaxReturn($res);
        }
        else
        {
            return $this->Util->ajaxReturn(false, '系统错误');
        }
    }
    
  
    /**
     * 递名片动作
     * @param int $id 大咖id
     */
    public function giveCard($id){
        $noLogin = $this->handCheckLogin();
        if($noLogin)
        {
            return $noLogin;
        }
        $cardBoxTable = \Cake\ORM\TableRegistry::get('CardBox');
        if($this->user->id == $id)
        {
            return $this->Util->ajaxReturn(false, '不可给自己递名片');
        }
        $data['ownerid'] = $id;
        $data['uid'] = $this->user->id;
        $isGive = $cardBoxTable->find()->where($data)->first();
        if($isGive)
        {
            return $this->Util->ajaxReturn(false, '已递名片');
        }
        else
        {
            // 查询是否给我递过名片
            $isGiveMe = $cardBoxTable->find()->where(['ownerid'=>$this->user->id, 'uid'=>$id])->first();
            if($isGiveMe)
            {
                $data['resend'] = 1;
            }
            else
            {
                $data['resend'] = 2;
            }
            $cardcase = $cardBoxTable->newEntity();
            $cardcase = $cardBoxTable->patchEntity($cardcase, $data);
            $res = $cardBoxTable->save($cardcase);
            if($res)
            {
                return $this->Util->ajaxReturn(true, '递名片成功');
            }
            else
            {
                return $this->Util->ajaxReturn(false, '系统错误');
            }
        }
    }
    
    /**
     * 行业九宫格列表
     */
    public function industries(){
        $this->set('pageTitle', '行业');
    }
    
    /**
     * 约见中间栏搜索
     * @param int $id 行业id
     */
    public function searchByAgency($id = ''){
        switch ($id){
            case '1':
                $title = '产业投资';
                break;
            case '2':
                $title = '并购融资';
                break;
            case '3':
                $title = '并购顾问';
                break;
            case '4':
                $title = '并购买家';
                break;
        }
        $this->set([
            'id' => $id,
            'pageTitle' => $title
        ]);
    }
    
    public function getAgency($id=''){
        if(!in_array($id, ['1','2','3','4'])){
            return $this->Util->ajaxReturn(false, '非法操作');
        }
        $AgencyTable = \Cake\ORM\TableRegistry::get('agency');
        if($id == 4){
            $agencies = $AgencyTable->find()->where(['id in'=>['22', '23', '24', '25']])->toArray();
        } else {
            $agencies = $AgencyTable->find()->where(['pid'=>$id])->toArray();
        }
        if($agencies){
            return $this->Util->ajaxReturn(['status'=>true, 'data'=>$agencies]);
        } else {
            return $this->Util->ajaxReturn(false, '系统错误');
        }
    }
    
    /**
     * ajax获取行业搜索会员结果
     */
    public function getAgenciesBiggie(){
        $data = $this->request->data();
        $agency_id = $data['agency_id'];
        $keyword = $data['keyword'];
        $where['enabled'] = '1';
        $where['level'] = '2';
        $where['is_del'] = '0';
        $biggie = $this
                    ->User
                    ->find();
        // 选择标签再匹配
        if($this->request->data('pid')){
            $where['Agencies.pid'] = $this->request->data('pid');
        }
        if($agency_id) {
            $where['agency_id'] = $agency_id;
        }
        if($keyword) {
            $where['truename like'] = "%$keyword%";
        }
        $biggie = $biggie
                ->contain(['Subjects'=>function($q){
                    return $q->where(['is_del'=>0])->orderDesc('Subjects.create_time');
                }, 'Agencies'])
//                ->limit($this->limit)
                ->order(['subject_update_time'=>'desc'])
                ->where($where)
                ->formatResults(function($items) {
                    return $items->map(function($item) {
                        $item['avatar'] = getSmallAvatar($item['avatar']);
                        return $item;
                    });
                 })
                ->toArray();
        if($biggie !== false){
            if ($biggie) {
                return $this->Util->ajaxReturn(['status' => true, 'data' => $biggie]);
            } else {
                return $this->Util->ajaxReturn(false, '暂无搜索结果');
            }
        } else {
            return $this->Util->ajaxReturn(false, '系统错误');
        }
    }
    
    /**
     * 推荐他
     */
    public function recom($id){
        $this->handCheckLogin();
        if($this->request->is('post')){
            $user_id = $this->user->id;
            if($user_id==$id){
                return $this->Util->ajaxReturn(false,'不可推荐自己');
            }
            $RecomTable = \Cake\ORM\TableRegistry::get('SavantReco');
            $recom = $RecomTable->newEntity([
                'user_id' => $user_id,
                'savant_id'=>$id,
            ]);
            if($RecomTable->save($recom)){
                $SavantTable = \Cake\ORM\TableRegistry::get('Savant');
                $savant = $SavantTable->findByUser_id($id)->first();
                $savant->reco_nums += 1;
                $SavantTable->save($savant);
                return $this->Util->ajaxReturn(['status'=>true,'msg'=>'推荐成功',
                    'avatar'=>  empty($this->user->avatar)?'/mobile/images/touxiang.jpg':$this->user->avatar
                        ]);
            }else{
                return $this->Util->ajaxReturn(false,  errorMsg($recom,'推荐失败'));
            }
        }
    }

    /**
     * 会员下拉加载更多
     * @param int $page 页数
     */
    public function getMoreBiggie($page){
        $user_id = '';
        if($this->user){
            $user_id = $this->user->id;
        }
        $biggies = $this
                ->User
                ->find()
                ->contain(['Subjects'=>function($q){
                    return $q->where(['Subjects.is_del'=>0])->orderDesc('Subjects.create_time')->limit(1);
                }, 'Followers'=>function($q)use($user_id){
                    return $q->where(['user_id'=>$user_id]);
                }])
                ->where(['enabled'=>'1', 'level'=>'2'])
                ->order(['is_top'=>'desc', 'subject_update_time'=>'desc'])
                ->page($page, $this->limit)
                ->formatResults(function($items) {
                    return $items->map(function($item) {
                        $item['avatar'] = getSmallAvatar($item['avatar']);
                        return $item;
                    });
                })
                ->toArray();
        if($biggies) {
            return $this->Util->ajaxReturn(['status'=>true, 'data'=>$biggies]);
        } else {
            return $this->Util->ajaxReturn(false);
        }
    }
    

}
