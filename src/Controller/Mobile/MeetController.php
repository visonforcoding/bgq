<?php

namespace App\Controller\Mobile;

use App\Controller\Mobile\AppController;

/**
 * Meet Controller  专家约见栏目
 *
 * @property \App\Model\Table\UserTable $User Description
 * @property \App\Controller\Component\BusinessComponent $Business 通用业务处理组件
 */
class MeetController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadModel('User');
    }

    protected $limit = '5'; // 分页条数
    
    /**
     * Index method  专家约见首页
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
        $biggieAds = $biggieAdTable->find()->contain(['Savants'])->all();
        $this->set('biggieAd', $biggieAds);
        
        // 默认用户
        $users = $this
                ->User
                ->find()
                ->contain(['Subjects'])
                ->where(['enabled'=>'1', 'level'=>'2'])
                ->limit($this->limit)
                ->toArray();
        $this->set('meetjson', json_encode($users));
        $this->set('pageTitle', '约见');
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
        if($users)
        {
            return $this->Util->ajaxReturn(['status'=>true, 'data'=>$users]);
        }
        else
        {
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
     * 专家类别查看  eg:互联网、大消费
     * @param type $id 行业标签id
     */
    public function meetCat($id = null) {
        //拥有该标签的所有专家
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
     * 专家详情页
     */
    public function view($id = null) {
        $self = false;
        if($this->user){
            if($id == $this->user->id){
                $self = true;
            }
        }
        $isCollect = '';
        // 是否已收藏
        if ($this->user) {
            $isCollect = $this->User->Collect->find()
                    ->where(['user_id' => $this->user->id, 'relate_id' => $id])
                    ->first();
            if ($isCollect) {
                $isCollect = !$isCollect['is_delete'];
            } else {
                $isCollect = 0;
            }
        }
        $biggie = $this->User->get($id, ['contain' => ['Savant', 'Subjects','RecoUsers','RecoUsers.Users']]);
        $this->set('isCollect', $isCollect);
        $this->set([
            'biggie' => $biggie,
            'pageTitle'=>$biggie->truename.'的专家主页'
        ]);
    }

    /**
     * 主题详情页 ->预约操作
     * @param int $id
     */
    public function subjectDetail($id = null) {
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
        $this->set(compact('subject'));
    }

    /**
     * 话题 添加
     */
    public function subject($id = null) {
        if ($this->request->is('post')) {
            $SubjectTable = \Cake\ORM\TableRegistry::get('meet_subject');
            $subject = $SubjectTable->newEntity();
            $subject = $SubjectTable->patchEntity($subject, $this->request->data());
            $subject->user_id = $this->user->id;
            if ($SubjectTable->save($subject)) {
                return $this->Util->ajaxReturn(true, '添加成功');
            } else {
                return $this->Util->ajaxReturn(false, '添加失败');
            }
        }
    }
    
    
    /***
     * 话题预约页
     */
    public function book($id = null){
        $SubjectTable = \Cake\ORM\TableRegistry::get('MeetSubject');
        $subject = $SubjectTable->find()
                ->contain(['User'=>function($q){
                    return $q->select(['id','truename','company','position']);
                }])
                ->where(['MeetSubject.id' => $id])
                ->first();
        if($this->request->is('ajax')){
            $this->handCheckLogin();
            $data['subject_id'] = $id;
            $data['summary'] = $this->request->data('summary');
            $data['user_id']  = $this->user->id;
            $data['savant_id']  = $subject->user->id;
            $BookTable = \Cake\ORM\TableRegistry::get('SubjectBook');
            $book = $BookTable->newEntity($data);
            if($BookTable->save($book)){
                $this->loadComponent('Business');
                $user_id = $subject->user->id;
                $this->Business->usermsg($user_id,'话题预约','您有新的话题预约请求',4,$book->id);
                return $this->Util->ajaxReturn(true,'预定成功');
            }else{
                $error = errorMsg($book,'预定失败');
                return $this->Util->ajaxReturn(false,$error);
            }
            
        }
        $this->set([
            'pageTitle'=>'话题预约'
        ]);
        $this->set(compact('subject'));
    }
    
    /**
     * 预定成功页
     */
    public function bookSuccess(){
        $this->set([
            'pageTitle'=> '预约成功'
        ]);
    }
    
    /**
     * 搜索页
     */
    public function search(){
        $this->set('search');
        $this->set('pageTitle', '搜索');
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
                ->contain(['Subjects'])
                ->distinct(['User.id'])
                ->matching('Subjects', function($q)use($keyword){
                    return $q;
                })
                ->Where(['enabled'=>'1', 'level'=>'2','truename like'=>"%$keyword%"])
                ->orWhere(['Subjects.title like'=>"%$keyword%"])
//                ->limit(10)
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
                ->contain(['Subjects'])
                ->distinct(['User.id'])
                ->matching('Subjects', function($q)use($keyword){
                    return $q;
                })
                ->Where(['enabled'=>'1', 'level'=>'2','truename like'=>"%$keyword%"])
                ->orWhere(['Subjects.title like'=>"%$keyword%"])
                ->limit(10)
                ->toArray();
        if($User) {
            return $this->Util->ajaxReturn(['status' => true, 'msg' => '', 'data' => $User]);
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
     * 关注动作
     * @param int $id 大咖id
     */
    public function attention($id){
        $this->handCheckLogin();
        if($id == $this->user->id)
        {
            return $this->Util->ajaxReturn(false, '不可关注自己');
        }
        $data['user_id'] = $this->user->id;
        $data['following_id'] = $id;
        $isAttention = $this->User->UserFans->find()->where($data)->first();
        $isFans = $this->User->UserFans->find()->where(['user_id'=>$id, 'following_id'=>$this->user->id])->first();
        if($isAttention)
        {
            $type = $isAttention->type;
        }
        else
        {
            if($isFans)
            {
                $fanses = $this->User->UserFans->newEntity();
                $fans = $this->User->UserFans->patchEntity($fanses, $data);
                $fans->type = 2;
                $attention = $this->User->UserFans->save($fans);
                
                $isFans = $this->User->UserFans->get($isFans->id);
                $isFans->type = 2;
                $attentioned = $this->User->UserFans->save($isFans);
                if($attention && $attentioned)
                {
                    return $this->Util->ajaxReturn(['status' => true, 'msg' => '关注成功', 'type' => '2']);
                }
                else
                {
                    return $this->Util->ajaxReturn(false, '系统错误');
                }
            }
            else
            {
                $fanses = $this->User->UserFans->newEntity();
                $fans = $this->User->UserFans->patchEntity($fanses, $data);
                $fans->type = 1;
                $res = $this->User->UserFans->save($fans);
                if($res)
                {
                    return $this->Util->ajaxReturn(['status' => true, 'msg' => '关注成功', 'type' => '1']);
                }
                else
                {
                    return $this->Util->ajaxReturn(false, '系统错误');
                }
            }
            
        }
        if($type == 1){
            // 已关注，取消关注
            $data['type'] = '0';
            $fans = $this->User->UserFans->get($isAttention->id);
            $res = $this->User->UserFans->delete($fans);
            if($res)
            {
                
                return $this->Util->ajaxReturn(['status' => true, 'msg' => '取消关注成功', 'type' => 0]);
            }
            else
            {
                return $this->Util->ajaxReturn(false, '系统错误');
            }
        }
        elseif($type == 2)
        {
            // 互相关注，取消关注
            $fans = $this->User->UserFans->get($isAttention->id);
            $res = $this->User->UserFans->delete($fans);
            if($res)
            {
                $isFans = $this->User->UserFans->get($isFans->id);
                $isFans->type = 1;
                $this->User->UserFans->save($isFans);
                return $this->Util->ajaxReturn(['status' => true, 'msg' => '取消关注成功', 'type' => 0]);
            }
            else
            {
                return $this->Util->ajaxReturn(false, '系统错误');
            }
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
     * 行业搜索专家页面
     * @param int $id 行业id
     */
    public function moreIndustries($id = ''){
        if($id)
        {
            $biggie = $this
                    ->User
                    ->find()
                    ->matching('Industries', function($q)use($id){
                        return $q->where(['Industries.id'=>$id]);
                    })
                    ->contain(['Subjects'])
                    ->where(['enabled'=>'1', 'level'=>'2'])
                    ->toArray();
            $this->set('biggiejson', json_encode($biggie));
        }
        else
        {
            $biggie = $this
                    ->User
                    ->find()
                    ->contain(['Subjects'])
                    ->where(['enabled'=>'1', 'level'=>'2'])
                    ->toArray();
            $this->set('biggiejson', json_encode($biggie));
        }
        $industriesTable = \Cake\ORM\TableRegistry::get('industry');
        $industries = $industriesTable->find()->where(['pid !='=>0])->toArray();
        $this->set([
            'pageTitle'=>'行业搜索',
            'industries'=>$industries,
            'id' => $id,
        ]);
    }
    
    /**
     * ajax获取行业搜索专家结果
     */
    public function getIndustriesBiggie(){
        $data = $this->request->data();
        $industry_id = $data['industry_id'];
        $sort = $data['sort'];
        $biggie = $this
                    ->User
                    ->find();
        // 选择标签再匹配
        if($industry_id)
        {
            $biggie = $biggie->matching('Industries', function($q)use($industry_id){
                            return $q->where(['Industries.id'=>$industry_id]);
                        });
        }
        if($sort) {
            if($sort !== 'reco_nums'){
                $biggie = $biggie->orderDesc($sort);
            } else {
                $biggie = $biggie->matching('Savants')->orderDesc('Savants.reco_nums');
            }
        }
        $biggie = $biggie
                ->contain(['Subjects'])
                ->where(['enabled'=>'1', 'level'=>'2'])
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
     * 专家下拉加载更多
     * @param int $page 页数
     */
    public function getMoreBiggie($page){
        $biggies = $this
                ->User
                ->find()
                ->contain(['Subjects'])
                ->where(['enabled'=>'1', 'level'=>'2'])
                ->page($page, $this->limit)
                ->toArray();
        if($biggies)
        {
            return $this->Util->ajaxReturn(['status'=>true, 'data'=>$biggies]);
        }
        else
        {
            return $this->Util->ajaxReturn(false);
        }
    }
    

}
