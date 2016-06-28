<?php

namespace App\Controller\Mobile;

use App\Controller\Mobile\AppController;
use Cake\I18n\Time;

/**
 * Home Controller  个人中心
 *
 * @property \App\Model\Table\HomeTable $Home
 * @property \App\Model\Table\UserTable $User
 * @property \App\Controller\Component\BusinessComponent $Business
 * @property \App\Controller\Component\WxComponent $Wx
 * @property \App\Controller\Component\WxpayComponent $Wxpay
 * @property \App\Controller\Component\SmsComponent $Sms
 */
class HomeController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadModel('User');
    }

    protected $limit = '5'; // 分页条数

    /**
     * Index method  个人中心页
     *
     * @return \Cake\Network\Response|null
     */

    public function index() {
        $this->loadComponent('Wx');
        $wxConfig = $this->Wx->wxconfig(['onMenuShareTimeline', 'onMenuShareAppMessage', 'scanQRCode']);
        $user_id = $this->user->id;
        $user = $this->User->get($user_id);
        $this->set(compact('user'));
        $this->set(array(
            'user'=>$user,
            'wxConfig'=>$wxConfig,
            'pageTitle' => '个人中心',
        ));
    }

    /**
     * 个人主页
     */
    public function homepage($id = null) {
        $user_id = isset($id) ? $id : $this->user->id;
        $user = $this->User->get($user_id, ['contain' => ['Industries' => function($q) {
                    return $q->hydrate(false)->select(['id', 'name']);
                }]]);
        $industries = $user->industries;
        $industry_arr = [];
        foreach ($industries as $industry) {
            $industry_arr[] = $industry['name'];
        }
        $this->set([
            'pageTitle' => '个人主页'
        ]);
        $this->set(compact('user', 'industry_arr'));
    }

    /**
     * ajax获取我的活动 报名
     */
    public function myActivityApply() {
        $applyTable = \Cake\ORM\TableRegistry::get('activityapply');
        $myActivity = $applyTable->find()->contain(['Activities'])->where(['activityapply.user_id'=>$this->user->id])->toArray();
        if($myActivity !== false)
        {
            return $this->Util->ajaxReturn(['status'=>true, 'data'=>$myActivity]);
        }
        else
        {
            return $this->Util->ajaxReturn(false, '系统错误');
        }
    }
    
    /**
     * ajax获取我的发布活动
     */
    public function getMyActivity(){
        $ActivityTable = \Cake\ORM\TableRegistry::get('activity');
        $activities = $ActivityTable->findByUserId($this->user->id)->toArray();
        if ($activities !== false) {
            return $this->Util->ajaxReturn(['status' => true, 'data' => $activities]);
        } else {
            return $this->Util->ajaxReturn(false, '系统错误');
        }
    }

    /**
     * 我的活动 发布
     */
    public function myActivitySubmit() {
        $ActivityTable = \Cake\ORM\TableRegistry::get('activity');
        $activities = $ActivityTable->findByUserId($this->user->id)->toArray();
        $this->set([
            'activities' => $activities,
            'pageTitle' => '我的活动'
        ]);
    }

    /**
     * 实名认证
     */
    public function realnameAuth() {
        $user_id = $this->user->id;
        $user = $this->User->get($user_id);
        if ($this->request->is('post')) {
            $user = $this->User->patchEntity($user, $this->request->data());
            $user->status = 1; //实名状态改为未审核
            if ($this->User->save($user)) {
                $this->loadComponent('Business');
                $this->Business->adminmsg(1, $user_id, '您有一条实名认证申请需处理');
                return $this->Util->ajaxReturn(true, '保存成功');
            } else {
                return $this->Util->ajaxReturn(false, '保存失败');
            }
        }
        $this->set([
            'pageTitle' => '实名认证'
        ]);
        $this->set(compact('user'));
    }

    /**
     * 专家认证
     */
    public function savantAuth() {
        $user_id = $this->user->id;
        $user = $this->User->get($user_id,['contain'=>['Savants']]);
        $UserTable = \Cake\ORM\TableRegistry::get('user');
        if ($this->request->is('post')) {
            $SavantTable = \Cake\ORM\TableRegistry::get('savant');
            $savant = $SavantTable->newEntity();
            $savant->user_id = $user_id;
            $savant = $SavantTable->patchEntity($savant, $this->request->data());
            $user->savant_status = 2;
            $ckRes = $this->User->connection()->transactional(function()use($SavantTable, $savant, $user, $UserTable) {
                //开启事务
                return $SavantTable->save($savant)&&$UserTable->save($user);
            });
            if ($ckRes) {
                $this->loadComponent('Business');
                $this->Business->adminmsg(1, $user_id, '您有一条专家认证申请需处理');
                return $this->Util->ajaxReturn(true, '保存成功');
            } else {
                return $this->Util->ajaxReturn(false,  errorMsg($savant,'保存失败'));
            }
        }
        $this->set([
            'pageTitle' => '专家认证'
        ]);
        $this->set(compact('user'));
    }

    /**
     * 我的关注
     */
    public function myFollowing() {
        $user_id = $this->user->id;
        $FansTable = \Cake\ORM\TableRegistry::get('user_fans');
        $followings = $FansTable->find()->contain(['Followings' => function($q) {
                        return $q->select(['id', 'truename', 'company', 'position', 'avatar', 'fans'])
                                ->where('enabled = 1');
                    }])->hydrate(false)
                        ->where(['user_id' => $user_id])
                        ->toArray();
        $this->set([
            'followings' => $followings,
            'pageTitle'=>'我的关注'
        ]);
    }

    /**
     * 我的粉丝
     */
    public function myFans() {
        $user_id = $this->user->id;
        $FansTable = \Cake\ORM\TableRegistry::get('user_fans');
        $fans = $FansTable->find()->contain(['Users' => function($q) {
                        return $q->select(['id', 'truename', 'company', 'position', 'avatar', 'fans'])
                                ->where('enabled = 1');
        }])->hydrate(false)
            ->where(['following_id' => $user_id])
            ->toArray();
        $this->set([
            'fans' => $fans,
            'pageTitle'=>'我的粉丝'
        ]);
    }

    /**
     * 我的关注消息
     */
    public function myMessageFans() {
        //查找type 为1 的消息
        $user_id = $this->user->id;
        $UsermsgTable = \Cake\ORM\TableRegistry::get('usermsg');
        $unReadFollowCount = $UsermsgTable->find()->where(['user_id' => $user_id, 'status' => 0,'type'=>1])->count(); //未读关注消息
        $unReadSysCount = $UsermsgTable->find()->where(['user_id' => $user_id, 'status' => 0,'type !='=>1])->count(); //未读系统消息
        $fans = $UsermsgTable->find()
                        ->hydrate(false)
                        ->select(['u.truename', 'u.avatar', 'u.id', 'create_time',
                            'u.company', 'u.position', 'u.fans', 'uf.type'])
                        ->join([
                            'u' => [
                                'table' => 'user',
                                'type' => 'inner',
                                'conditions' => 'u.id = usermsg.user_id',
                            ],
                            'uf' => [
                                'table' => 'user_fans',
                                'type' => 'inner',
                                'conditions' => 'uf.id = usermsg.table_id',
                            ]
                        ])
                        ->where("usermsg.`user_id` = '$user_id'")
                        ->orderDesc('usermsg.create_time')->toArray();
        //看了之后 就更改状态了为已读
        $UsermsgTable->updateAll(['status' => 1], ['user_id' => $user_id, 'status' => 0]);
        $this->set([
            'pageTitle' => '关注消息',
            'fans'=>$fans,
            'unReadSysCount'=>$unReadSysCount,
            'unReadFollowCount'=>$unReadFollowCount
        ]);
    }

    /**
     * 我的系统消息
     */
    public function myMessageSys() {
        $user_id = $this->user->id;
        $UsermsgTable = \Cake\ORM\TableRegistry::get('usermsg');
        $unReadFollowCount = $UsermsgTable->find()->where(['user_id' => $user_id, 'status' => 0,'type'=>1])->count(); //未读关注消息
        $unReadSysCount = $UsermsgTable->find()->where(['user_id' => $user_id, 'status' => 0,'type !='=>1])->count(); //未读系统消息
        $msgs = $UsermsgTable->find()->where(['user_id' => $user_id, 'type !=' => 1])->orderDesc('create_time')->toArray();
        $this->set([
            'pageTitle' => '系统消息',
            'unReadFollowCount'=>$unReadFollowCount,
            'unReadSysCount'=>$unReadSysCount
        ]);
        $this->set(compact('msgs', 'unReadCount'));
    }

    /**
     * 小秘书
     */
    public function myXiaomi() {
        if ($this->request->is('post')) {
            $user_id = $this->user->id;
            $NeedTable = \Cake\ORM\TableRegistry::get('need');
            $content = $this->request->data('content');
            $need = $NeedTable->newEntity(['user_id' => $user_id, 'msg' => $content]);
            if ($NeedTable->save($need)) {
                return $this->Util->ajaxReturn(true, '提交成功');
            } else {
                
                return $this->Util->ajaxReturn(false, '提交失败');
            }
        }
        $this->set([
            'pageTitle' => '小秘书'
        ]);
    }

    /**
     * 小秘书历史记录
     */
    public function myHistoryNeed() {
        $NeedTable = \Cake\ORM\TableRegistry::get('need');
        $user_id = $this->user->id;
        $needs = $NeedTable->find()->where(['user_id' => $user_id])->orderDesc('create_time')->toArray();
        $this->set([
            'pageTitle' => '小秘书历史记录'
        ]);
        $this->set(compact('needs'));
    }

    /**
     * 活动收藏记录
     */
    public function myCollectActivity() {
        $this->set('pageTitle', '活动收藏');
    }

    /**
     * 资讯收藏
     */
    public function myCollectNews() {
        $user_id = $this->user->id;
        $CollectTable = \Cake\ORM\TableRegistry::get('Collect');
        $collects = $CollectTable->find()->hydrate(false)
                ->contain(['News'])
                ->where(['is_delete' => 0, 'Collect .user_id' => $user_id])
                ->orderDesc('Collect.create_time')
                ->formatResults(function($items) {
                    return $items->map(function($item) {
                                //时间语义化转换
                                $item['create_str'] = $item['create_time']->timeAgoInWords(
                                        [ 'accuracy' => [
                                                'year' => 'year',
                                                'month' => 'month',
                                                'hour' => 'hour'
                                            ], 'end' => '+10 year']
                                );
                                return $item;
                            });
                })
                ->toArray();
        $this->set(compact('collects'));
        $this->set('pageTitle', '资讯收藏');
    }

    /**
    * 我的约见 （我是顾客）
    */
    public function myBook() {
        $BookTable = \Cake\ORM\TableRegistry::get('SubjectBook');
        $type = $this->request->query('type');
//        $where['SubjectBook.status'] = in_array($type, ['0', '1', '3']) ? $type : 0;
        $where['SubjectBook.status !='] = 2;
        $where['SubjectBook.user_id'] = $this->user->id;
        $books = $BookTable->find()->contain(['Subjects', 'Subjects.User' => function($q) {
                        return $q->select(['truename', 'avatar', 'id', 'company', 'position']);
                    }])->where($where)->orderDesc('SubjectBook.update_time')->toArray();
                    
        $savant_books = $BookTable->find()->contain(['Subjects', 'Users' => function($q) {
                        return $q->select(['truename', 'avatar', 'id', 'company', 'position']);
                    }])->where([
                       'SubjectBook.status !='=>2, 
                       'SubjectBook.savant_id ='=>$this->user->id, 
                    ])->orderDesc('SubjectBook.update_time')->toArray();            
        $this->set([
            'pageTitle'=>'我的约见',
            'books'=>$books,
            'savant_books'=>$savant_books   //我是专家
        ]);
        $this->set(compact('books', 'type'));
    }

    /**
     * 我的约见 我是顾客的详情
     */
    public function myBookDetail($id = null) {
        $BookTable = \Cake\ORM\TableRegistry::get('SubjectBook');
        $book = $BookTable->get($id, [
            'contain' => ['Users' => function($q) {
                    return $q->select(['truename', 'id', 'avatar', 'company', 'position']);
                }, 'Subjects', 'Lmorder']
                ]);
                $subject = $book->subject;
                $this->set(compact('subject', 'book'));
        $this->set('pageTitle', '我是顾客');
    }

    /**
     * 我的约见 (我是专家)
     */
    public function myBookSavant() {
        $BookTable = \Cake\ORM\TableRegistry::get('SubjectBook');
        $type = $this->request->query('type');
        $where['SubjectBook.status'] = in_array($type, ['0', '1', '3']) ? $type : 0;
        $where['SubjectBook.savant_id'] = $this->user->id;
        $books = $BookTable->find()->contain(['Subjects', 'Users' => function($q) {
                        return $q->select(['truename', 'avatar', 'id', 'company', 'position']);
                    }])->where($where)->orderDesc('SubjectBook.update_time')->toArray();
                $this->set(compact('books', 'type'));
        $this->set('pageTitle', '我是专家');
    }

    /**
     * 我的约见 我是专家详情
     * @param type $id
     */
    public function myBookSavantDetail($id = null) {
        $BookTable = \Cake\ORM\TableRegistry::get('SubjectBook');
        $book = $BookTable->get($id, [
            'contain' => ['Users' => function($q) {
                    return $q->select(['truename', 'id', 'avatar', 'company', 'position', 'phone', 'email']);
                }, 'Subjects', 'Users.Industries']
                ]);
                $subject = $book->subject;
        $this->set([
            'pageTitle'=>'预约详情'
        ]);
        $this->set(compact('subject', 'book'));
    }

    /**
    * 同意约见 约见状态更改->生成一条订单(目前对前台用户暂时没作用)
    */
    public function bookOk() {
        if ($this->request->is('post')) {
            $id = $this->request->data('id'); //book id
            $BookTable = \Cake\ORM\TableRegistry::get('SubjectBook');
            $book = $BookTable->get($id, [
                'contain' => [
                    'Subjects',
                    'Users'
                ]
        ]);
        $book->status = 1; //更改
        $OrderTable = \Cake\ORM\TableRegistry::get('order');
        $order = $OrderTable->newEntity([
            'type' => 1,
            'relate_id' => $id, //预定表的id
            'user_id' => $book->user_id,
            'seller_id' => $book->savant_id,
            'order_no' => time() . $book->user_id . $id . createRandomCode(2, 2),
            'price' => $book->subject->price,
            'remark' => '预约话题' . $book->subject->title
        ]);
        $transRes = $BookTable->connection()->transactional(function()use($book, $BookTable, $order, $OrderTable) {
            return $BookTable->save($book) && $OrderTable->save($order);
        });
        if ($transRes) {
            //短信和消息通知
            $this->loadComponent('Sms');
            $msg = "您预约的话题：《" . $book->subject->title . "》已确认通过，请及时登录平台支付预约款。";
            $this->Sms->sendByQf106($book->user->phone, $msg);
            $this->loadComponent('Business');
            $this->Business->usermsg($book->user_id, '预约通知', $msg, 4, $id);
            return $this->Util->ajaxReturn(true, '处理成功!');
        } else {
            return $this->Util->ajaxReturn(false, '服务器出错!');
            }
        }
    }

    /*                                                             * *
     * 我的钱包
     */

    public function myPurse() {
        $user_id = $this->user->id;
        $userInfo = $this->User->get($user_id);
        $FlowTable = \Cake\ORM\TableRegistry::get('Flow');
        $flows = $FlowTable->find()->where(['user_id' => $user_id, 'status' => '1'])->orderDesc('create_time')->toArray();
        $this->set(array(
            'userInfo' => $userInfo,
            'flows' => $flows,
            'pageTitle'=>'我的钱包'
        ));
    }

    /**
     * 提现
     */
    public function withdraw() {
        $user_id = $this->user->id;
        $userInfo = $this->User->get($user_id);
        if ($this->request->isAjax()) {
            $amount = $this->request->data('amount');
            $bank = $this->request->data('bank');
            $cardno = $this->request->data('cardno');
            if ($amount > $userInfo->money) {
                return $this->Util->ajaxReturn(false, '提现金额不能大于钱包余额');
            }
            $WithdrawTable = \Cake\ORM\TableRegistry::get('Withdraw');
            $withdraw = $WithdrawTable->newEntity([
                'user_id' => $user_id,
                'amount' => $amount,
                'cardno' => $cardno,
                'truename' => $userInfo->truename,
                'bank' => $bank,
            ]);
            if ($WithdrawTable->save($withdraw)) {
                return $this->Util->ajaxReturn(true, '提现申请成功');
            } else {
                \Cake\Log\Log::error($withdraw->errors());
                return $this->Util->ajaxReturn(false, '提现申请失败');
            }
        }
        $this->set([
            'pageTitle'=>'提现'
        ]);
        $this->set(compact('userInfo'));
    }

    /**
     * 隐私设置
     */
    public function mySecret() {
        $this->set('pageTitle', '隐私策略');
    }

    /**
     * 设置
     */
    public function myInstall() {
        $this->set([
            'pageTitle' => '设置'
        ]);
    }

    /**
     * 修改个人信息
     */
    public function editUserinfo() {
        $user_id = $this->user->id;
        $user = $this->User->get($user_id);
        if ($this->request->is('post')) {
            $user = $this->User->patchEntity($user, $this->request->data());
            if ($this->User->save($user)) {
                return $this->Util->ajaxReturn(true, '保存成功');
            } else {
                return $this->Util->ajaxReturn(false, '保存失败');
            }
        }
        $this->set([
            'user' => $user,
            'pageTitle' => '个人信息'
        ]);
    }

    /**
     * 擅长业务
     */
    public function myBusiness() {
        $user = $this->User->get($this->user->id);
        if($this->request->is('post')){
            $user = $this->User->patchEntity($user,  $this->request->data());
            if($this->User->save($user)){
                return $this->Util->ajaxReturn(true,'修改成功');
            }else{
                return $this->Util->ajaxReturn(false,'保存失败');
            }
        }
        $this->set([
            'pageTitle' => '擅长业务',
            'user'=>$user
        ]);
    }
    
    
    /**
     * 公司业务
     * @return type
     */
    public function editCompanyBusiness(){
        $user = $this->User->get($this->user->id);
        if($this->request->is('post')){
            $user = $this->User->patchEntity($user,  $this->request->data());
            if($this->User->save($user)){
                return $this->Util->ajaxReturn(true,'修改成功');
            }else{
                return $this->Util->ajaxReturn(false,'保存失败');
            }
        }
        $this->set([
            'pageTitle' => '公司业务',
            'user'=>$user
        ]);
    }
    
    
    /**
     * 编辑教育经历
     */
    public function editEducation(){
        $EducationTable = \Cake\ORM\TableRegistry::get('Education');
        $educations = $EducationTable->find()->where(['user_id'=>  $this->user->id])->toArray();
        if($this->request->is('post')){
            $data = $this->request->data();
            $data['user_id'] = $this->user->id;
            $education = $EducationTable->newEntity($data);
            if($EducationTable->save($education)){
                return $this->Util->ajaxReturn(true,'保存成功!');
            }else{
                return $this->Util->ajaxReturn(false,  errorMsg($education,'保存失败'));
            }
        }
        $educationType = \Cake\Core\Configure::read('educationType');
        $this->set([
            'pageTitle' =>'编辑教育经历',
            'educations'=>$educations,
            'educationType'=>$educationType
        ]);
    }
    
    
    /**
     * 编辑工作经历
     */
    public function editWork(){
        $CareerTable = \Cake\ORM\TableRegistry::get('Career');
        $careers = $CareerTable->find()->where(['user_id'=>  $this->user->id])->toArray();
        if($this->request->is('post')){
            $data = $this->request->data();
            $data['user_id'] = $this->user->id;
            $career = $CareerTable->newEntity($data);
            if($CareerTable->save($career)){
                return $this->Util->ajaxReturn(true,'保存成功!');
            }else{
                return $this->Util->ajaxReturn(false,  errorMsg($career,'保存失败'));
            }
        }
        $this->set([
           'pageTitle'=>'编辑工作经历 ' ,
            'careers'=>$careers
        ]);
    }
    
    
    
    /**
     * 删除教育
     * @param type $id
     * @return type
     */
    public function delEducation($id){
        $EducationTable = \Cake\ORM\TableRegistry::get('Education');
        $education = $EducationTable->find()->where(['user_id'=>  $this->user->id,'id'=>$id])->first();
        if($education){
            if($EducationTable->delete($education)){
                return $this->Util->ajaxReturn(true, '删除成功');
            }else{
                return $this->Util->ajaxReturn(false, '删除失败');
            }
        }else{
            return $this->Util->ajaxReturn(false, '记录不存在');
        }
        
    }


    /**
     * 删除工作经历
     * @param type $id
     * @return type
     */
    public function delCareer($id){
        $CareerTable = \Cake\ORM\TableRegistry::get('Career');
        $career = $CareerTable->find()->where(['user_id'=>  $this->user->id,'id'=>$id])->first();
        if($career){
            if($CareerTable->delete($career)){
                return $this->Util->ajaxReturn(true, '删除成功');
            }else{
                return $this->Util->ajaxReturn(false, '删除失败');
            }
        }else{
            return $this->Util->ajaxReturn(false, '记录不存在');
        }
    }
    




    /**
     * 编辑名片
     */
    public function editCard(){
        
    }
    
    public function editMark(){
        
    }

    /**
     * 名片夹
     */
    public function cardcase() {
        $this->handCheckLogin();
        $card = $this
                ->User
                ->CardBoxes
                ->find()
                ->contain(['OtherCard'])
                ->where(['ownerid' => $this->user->id, 'resend' => '2'])
                ->orderDesc('CardBoxes.`create_time`')
                ->limit($this->limit)
                ->toArray();
        $this->set('cardjson', json_encode($card));
        $this->set('pageTitle' ,'名片夹');
    }

    /**
     * 名片夹是否回赠
     * @param int $resend
     */
    public function getCrad($resend) {
        $card = $this
                ->User
                ->CardBoxes
                ->find()
                ->contain(['OtherCard'])
                ->where(['ownerid' => $this->user->id, 'resend' => $resend])
                ->orderDesc('CardBoxes.`create_time`')
                ->limit($this->limit)
                ->toArray();
        if ($card !== false) {
            return $this->Util->ajaxReturn(['status' => true, 'data' => $card]);
        } else {
            return $this->Util->ajaxReturn(false, '系统错误');
        }
    }

    /**
     * 回赠动作
     * @param int $id
     */
    public function sendBack($id) {
        $sendMe = $this
                ->User
                ->CardBoxes
                ->find()
                ->where(['ownerid' => $this->user->id, 'uid' => $id])
                ->first();
        $sendMe = $this->User->CardBoxes->get($sendMe->id);
        $sendMe->resend = 1;
        $res = $this->User->CardBoxes->save($sendMe);
        if ($res) {
            return $this->Util->ajaxReturn(true, '回赠成功');
        } else {
            return $this->Util->ajaxReturn(false, '回赠失败');
        }
    }

}
                                                        