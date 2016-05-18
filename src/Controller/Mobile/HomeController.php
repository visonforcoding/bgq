<?php

namespace App\Controller\Mobile;

use App\Controller\Mobile\AppController;

/**
 * Home Controller  个人中心
 *
 * @property \App\Model\Table\HomeTable $Home
 * @property \App\Model\Table\UserTable $User
 * @property \App\Controller\Component\BusinessComponent $Business
 * @property \App\Controller\Component\WxComponent $Wx
 */
class HomeController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadModel('User');
    }

    /**
     * Index method  个人中心页
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $this->loadComponent('Wx');
        debug($this->Wx->getJsapiTicket());exit();
        $user_id = $this->user->id;
        $user = $this->User->get($user_id);
        $this->set(compact('user'));
    }

    /**
     * 个人主页
     */
    public function myHomePage($id=null) {
        $user_id = isset($id)?$id:$this->user->id;
        $user = $this->User->get($user_id,['contain'=>['Industries'=>function($q){
            return $q->hydrate(false)->select(['id','name']);
        }]]);
        $industries = $user->industries;
        $industry_arr = [];
        foreach($industries as $industry){
            $industry_arr[] = $industry['name'];
        }
        $this->set(compact('user','industry_arr'));
    }

    /**
     * 我的活动 报名
     */
    public function myActivityApply() {
        
    }

    /**
     * 我的活动 发布
     */
    public function myActivitySubmit() {
        $ActivityTable = \Cake\ORM\TableRegistry::get('activity');
        $activities = $ActivityTable->findByUserId($this->user->id)->toArray();
        $this->set([
            'activities' => $activities
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
                $this->Util->ajaxReturn(true, '保存成功');
            } else {
                $this->Util->ajaxReturn(false, '保存失败');
            }
        }
        $this->set(compact('user'));
    }

    /**
     * 专家认证
     */
    public function savantAuth() {
        $user_id = $this->user->id;
        $user = $this->User->get($user_id);
        $UserTable = \Cake\ORM\TableRegistry::get('user');
        if ($this->request->is('post')) {
            $SavantTable = \Cake\ORM\TableRegistry::get('savant');
            $savant = $SavantTable->newEntity();
            $savant->user_id = $user_id;
            $savant = $SavantTable->patchEntity($savant, $this->request->data());
            $user->savant_status = 2;
            $errorFlag = [];
            $this->User->connection()->transactional(function()use($SavantTable, $savant, $user, $UserTable, $errorFlag) {
                //开启事务
                $errorFlag[] = $SavantTable->save($savant);
                $errorFlag[] = $UserTable->save($user);
            });
            if (!in_array(false, $errorFlag)) {
                $this->loadComponent('Business');
                $this->Business->adminmsg(1, $user_id, '您有一条专家认证申请需处理');
                $this->Util->ajaxReturn(true, '保存成功');
            } else {
                $this->Util->ajaxReturn(false, '保存失败');
            }
        }
        $this->set(compact('user'));
    }
    
    /**
     * 我的关注
     */
    public function myFollowing(){
        $user_id = $this->user->id;
        $FansTable = \Cake\ORM\TableRegistry::get('user_fans');
        $followings = $FansTable->find()->contain(['Followings'=>function($q){
            return $q->select(['id','truename','company','position','avatar','fans'])
                      ->where('enabled = 1');
        }])->hydrate(false)
                ->where(['user_id'=>$user_id])
                ->toArray();
        $this->set(compact('followings'));
    }
    
    
    /**
     * 我的粉丝
     */
    public function myFans(){
        $user_id = $this->user->id;
        $FansTable = \Cake\ORM\TableRegistry::get('user_fans');
        $fans = $FansTable->find()->contain(['Users'=>function($q){
            return $q->select(['id','truename','company','position','avatar','fans'])
                      ->where('enabled = 1');
        }])->hydrate(false)
                ->where(['following_id'=>$user_id])
                ->toArray();
        $this->set(compact('fans'));
    }
    
    /**
     * 我的关注消息
     */
    public function myMessageFans(){
        //查找type 为1 的消息
        $user_id = $this->user->id;
        
        $UsermsgTable = \Cake\ORM\TableRegistry::get('usermsg');
        $unReadCount = $UsermsgTable->find()->where(['user_id'=>$user_id,'status'=>0])->count();
        
        $fans = $UsermsgTable->find()
                 ->hydrate(false)
                 ->select(['u.truename','u.avatar','u.id','create_time',
                     'u.company','u.position','u.fans','uf.type'])
                 ->join([
                     'u'=>[
                         'table'=>'user',
                         'type'=>'inner',
                         'conditions' => 'u.id = usermsg.user_id',
                     ],
                     'uf'=>[
                         'table'=>'user_fans',
                         'type'=>'inner',
                         'conditions' => 'uf.id = usermsg.table_id',
                     ]
                 ])
                ->where("usermsg.`user_id` = '$user_id'")
                ->orderDesc('usermsg.create_time')->toArray();
        //看了之后 就更改状态了为已读
        $UsermsgTable->updateAll(['status'=>1],['user_id'=>$user_id,'status'=>0]);
        $this->set(compact('unReadCount','fans'));
    }
    
    /**
     * 小秘书
     */
    public function myXiaomi(){
        if($this->request->is('post')){
            $user_id = $this->user->id;
            $NeedTable = \Cake\ORM\TableRegistry::get('need');
            $content = $this->request->data('content');
            $need = $NeedTable->newEntity(['user_id'=>$user_id,'msg'=>$content]);
            if($NeedTable->save($need)){
                $this->Util->ajaxReturn(true,'提交成功');
            }else{
//                $error = getMessage($need->errors());
                $this->Util->ajaxReturn(false, '提交失败');
            }
        }
    }
    
    public function myHistoryNeed(){
        $NeedTable = \Cake\ORM\TableRegistry::get('need');
        $user_id = $this->user->id;
        $needs = $NeedTable->find()->where(['user_id'=>$user_id])->orderDesc('create_time')->toArray();
        $this->set(compact('needs'));
    }
}
