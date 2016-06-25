<?php

namespace App\Controller\Mobile;

use App\Controller\Mobile\AppController;
use Cake\Mailer\Email;

/**
 * User Controller
 *
 * @property \App\Model\Table\UserTable $User
 * @property \App\Controller\Component\HanvonComponent $Hanvon
 * @property \App\Controller\Component\SmsComponent $Sms
 * @property \App\Controller\Component\BusinessComponent $Business
 */
class UserController extends AppController {
    
    
    /**
     * Index method  个人主页
     *
     * @return \Cake\Network\Response|null
     */
    public function homePage($id=null) {
        $self = false;
        if($this->user){
            if($id ==$this->user->id){
                $self = true;
            }
        }
        if(empty($id)){
            //自己看自己的
            $this->handCheckLogin();
            $id = $this->user->id;
            $self = true;
        }
        $user = $this->User->get($id,['contain'=>['Industries'=>function($q){
            return $q->hydrate(false)->select(['id','name']);
        }]]);
        $industries = $user->industries;
        $industry_arr = [];
        foreach($industries as $industry){
            $industry_arr[] = $industry['name'];
        }
        $isFans = false;
        if($this->user){
            $user_id = $this->user->id;
            $FansTable = \Cake\ORM\TableRegistry::get('UserFans');
            $isFans = $FansTable->find()->where("`user_id` = '$user_id' and `following_id` = '$id'")->count();
        }
        $isGive = '';
        if ($this->user) {
            if ($this->user->id == $id) {
                $isMe = true;
            }
            else
            {
                $isAttention = $this->User->UserFans->find()->where(['user_id' => $this->user->id, 'following_id' => $id])->first();
                if($isAttention)
                {
                    $type = $isAttention->type;
                }
                $isGiveCard = $this->User->CardBoxes->find()->where(['ownerid'=>$id, 'uid'=>$this->user->id])->first();
                if($isGiveCard)
                {
                    $isGive = $isGiveCard;
                }
            }
        }
        $this->set([
            'pageTitle'=>'个人主页',
            'self'=>$self,
            'isFans'=>$isFans,
            'isGive' => $isGive
        ]);
        $this->set(compact('user','industry_arr'));
    }

    /**
     * 注册 选择行业标签 最后一步
     * 
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function registerBusiness() {
        $reg_phone = $this->request->session()->read('reg.phone');
        if (!$reg_phone) {
            $this->redirect('/user/register');
        }
        if ($this->request->isPost()) {
            $user = $this->User->findByPhone($reg_phone)->first();
            if ($user) {
                $data = $this->request->data();
                $data['enabled'] = 1;
                $data['user_token'] = md5(uniqid());
                $user = $this->User->patchEntity($user, $data);
                if ($this->User->save($user)) {
                    //注册成功就算登录
                    $this->request->session()->write('User.mobile', $user);
                    return $this->Util->ajaxReturn(['status' => true, 'url' => '/home/index']);
                } else {
                    return $this->Util->ajaxReturn(['status' => false, 'msg' => '服务器出错']);
                }
            }
            return;
        }
        $IndustryTable = \Cake\ORM\TableRegistry::get('industry');
        $industries = $IndustryTable->find('threaded', [
                    'keyField' => 'id',
                    'parentField' => 'pid'
                ])->where("`id` != '3'")->hydrate(false)->toArray();
        $this->set(array(
            'industries' => $industries,
            'pageTitle'=>'选择行业标签'
        ));
    }

    /**
     * 注册行业机构  注册第二步
     * 
     */
    public function registerOrg() {
        $reg_phone = $this->request->session()->read('reg.phone');
        if (!$reg_phone) {
            $this->redirect('/user/register');
        }
        if ($this->request->isPost()) {
            $user = $this->User->findByPhone($reg_phone)->first();
            if ($user) {
                $user->agency_id = $this->request->data('agency');
                if ($this->User->save($user)) {
                    $this->request->session()->write('reg.step', 'two');
                    return $this->Util->ajaxReturn(['status' => true, 'url' => '/user/register-business']);
                } else {
                    return $this->Util->ajaxReturn(['status' => false, 'msg' => '服务器出错']);
                }
            }
        }
        $AgencyTable = \Cake\ORM\TableRegistry::get('agency');
        $agencies = $AgencyTable->find('threaded', [
                    'keyField' => 'id',
                    'parentField' => 'pid'
                ])->hydrate(false)->toArray();
        $this->set(array(
            'agencies' => $agencies,
            'pageTitle'=>'注册行业机构'
        ));
    }

    /**
     * 注册 验证手机号 第0步
     */
    public function registerVphone() {
        if ($this->request->isPost()) {
            $phone = $this->request->data('phone');
            $user = $this->User->findByPhoneAndEnabled($phone, 1)->first();
            $vcode = $this->request->session()->read('UserLoginVcode');
            if ($vcode['code'] != $this->request->data('vcode')) {
                return $this->Util->ajaxReturn(false, '验证码验证错误');
            }
            if ($user) {
                return $this->Util->ajaxReturn(['status' => false, 'msg' => '该手机号已注册过您可前往登录']);
            }
            if (time() - $vcode['time'] < 60 * 10) {
                //10分钟验证码超时
                $this->request->session()->write('reg.phone', $phone);
                return $this->Util->ajaxReturn(['status' => true]);
            } else {
                return $this->Util->ajaxReturn(false, '验证码已过期，请重新获取');
            }
        }
    }

    /**
     * 注册首页 第一步
     */
    public function register() {
        if (!$this->request->session()->read('reg.phone')) {
            $this->redirect('/user/register-vphone');
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->User->newEntity();
            $data = $this->request->data();
            $data['enabled'] = 0;
            $data['phone'] = $this->request->session()->read('reg.phone');
            if ($this->request->session()->read('reg.wx_bind') && $this->request->session()->check('reg.wx_openid')) {
                //第一次微信登录的完善信息
                $data['union_id'] = $this->request->session()->read('reg.wx_unionid');
                if ($this->request->is('lemon')) {
                    $data['app_wx_openid'] = $this->request->session()->read('reg.wx_openid');
                } else {
                    $data['wx_openid'] = $this->request->session()->read('reg.wx_openid');
                }
                $data['avatar'] = $this->request->session()->read('reg.avatar');
            }
            $user = $this->User->patchEntity($user, $data);
            if ($this->User->save($user)) {
                //session 记录 注册手机号 和 注册步骤
                $this->request->session()->write([
                    'reg.step' => 'one',
                ]);
                return $this->Util->ajaxReturn(['status' => true, 'url' => '/user/register-org']);
            } else {
                \Cake\Log\Log::error($user->errors());
               return $this->Util->ajaxReturn(['status' => false, 'msg' => getMessage($user->errors())]);
            }
        }
        $this->set([
            'pageTitle'=>'注册'
        ]);
    }

    /**
     * 处理识别名片
     */
    public function recogMp() {
        $this->loadComponent('Hanvon');
        $path = $this->request->data('path');
        $file = ROOT . '/webroot' . $path;
        $res = $this->Hanvon->handMpByJuhe($file);
        $response = [];
        if ($res) {
            $response['status'] = true;
            $response['result'] = $res;
        } else {
            $response['status'] = false;
        }
        return $this->Util->ajaxReturn($response);
    }

    /**
     * 用户登录
     */
    public function login() {
//        $redirect_url = empty($this->request->query('redirect_url')) ?
//                (empty($this->request->referer()) ? '/' : $this->request->referer()) : $this->request->query('redirect_url');
        $redirect_url = empty($this->request->query('redirect_url')) ? '/':  $this->request->query('redirect_url');
        $this->response->cookie([
            'name' => 'login_url',
            'value' => $redirect_url,
            'path' => '/',
            'expire' => time() + 600
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $phone = $this->request->data('phone');
            $user = $this->User->findByPhoneAndEnabled($phone, 1)->first();
            if ($user) {
                // $vcode = $this->request->session()->read('UserLoginVcode');
                //  if ($vcode['code'] == $this->request->data('vcode')) {
                //  if (time() - $vcode['time'] < 60 * 10) {
                //10分钟验证码超时
                $this->request->session()->write('User.mobile', $user);
                $user_token = false;
                if($this->request->is('lemon')){
                    $this->request->session()->write('Login.login_token',$user->user_token);
                    $user_token = $user->user_token;
                }
                return $this->Util->ajaxReturn(['status' => true, 'redirect_url' => $redirect_url,'token_uin'=>$user_token]);
                //    } else {
                //        $this->Util->ajaxReturn(false, '验证码已过期，请重新获取');
                //     }
                //  } else {
                //      $this->Util->ajaxReturn(false, '验证码验证错误');
                // }
            } else {
                return $this->Util->ajaxReturn(['status' => false, 'msg' => '该手机号未注册或不可用']);
            }
        }
        $this->set(array(
            'pageTitle' => '登录'
        ));
    }

    /**
     * 检查手机号是否存在
     */
    public function ckUserPhoneExist() {
        if ($this->request->is(['patch', 'post', 'put'])) {
            $phone = $this->request->data('phone');
            $user = $this->User->findByPhoneAndEnabled($phone, 1)->first();
            if ($user) {
                return $this->Util->ajaxReturn(['status' => true]);
            } else {
                return $this->Util->ajaxReturn(['status' => false, 'msg' => '该手机号未注册或不可用']);
            }
        }
    }

    /**
     * 发送动态验证码
     */
    public function sendVcode() {
        $this->loadComponent('Sms');
        $mobile = $this->request->data('phone');
        $code = createRandomCode(4, 2); //创建随机验证码
        $content = '您的动态验证码为' . $code;
        $codeTable = \Cake\ORM\TableRegistry::get('smsmsg');
        $vcode = $codeTable->find()->where("`phone` = '$mobile'")->orderDesc('create_time')->first();
        if (empty($vcode) || (time() - strtotime($vcode['time'])) > 30) {
            //30s 的间隔时间
            $ckSms = $this->Sms->sendByQf106($mobile, $content, $code);
            if ($ckSms) {
                $this->request->session()->write('UserLoginVcode', ['code' => $code, 'time' => time()]);
                return $this->Util->ajaxReturn(true, '发送成功');
            }
        } else {
            return $this->Util->ajaxReturn(false, '30秒后再发送');
        }
    }

    /**
     * 微信绑定页(第一次进行微信登录需有的操作)
     */
    public function wxBindPhone() {
        $open_id = $this->request->session()->read('reg.wx_openid');
        $union_id = $this->request->session()->read('reg.wx_unionid');
        if (!$open_id) {
            //throw new Exception('非法操作');
            //交互待处理
        }
        if ($this->request->isPost()) {
            $phone = $this->request->data('phone');
            $user = $this->User->findByPhoneAndEnabled($phone, 1)->first();
            $vcode = $this->request->session()->read('UserLoginVcode');
            if ($vcode['code'] != $this->request->data('vcode')) {
                return $this->Util->ajaxReturn(false, '验证码验证错误');
            }
            if (time() - $vcode['time'] < 60 * 10) {
                //10分钟验证码超时
                if ($user) {
                    //注册过 绑定 并登录
                    $user->union_id = $union_id;
                    if ($this->request->is('lemon')) {
                        $user->app_wx_openid = $this->request->session()->read('reg.wx_openid');
                    } else {
                        $user->wx_openid = $this->request->session()->read('reg.wx_openid');
                    }
                    if ($this->User->save($user)) {
                        $this->request->session()->write('User.mobile', $user);
                        return $this->Util->ajaxReturn(['status' => true]);
                    } else {
                        return $this->Util->ajaxReturn(false, '服务器出错');
                    }
                } else {
                    //注册完善信息
                    $this->request->session()->write([
                        'reg.phone' => $phone,
                        'reg.wx_bind' => true,
                    ]);
                    return $this->Util->ajaxReturn(['status' => false, 'msg' => '您还未有平台账户需前往完善信息', 'url' => '/user/register?type=wx_bind']);
                }
            } else {
                return $this->Util->ajaxReturn(false, '验证码已过期，请重新获取');
            }
        }
        $this->set([
            'pageTitle' => '验证手机号',
        ]);
    }

    /**
     * 关注动作
     * @return type
     */
    public function follow() {
        $this->handCheckLogin();
        if ($this->request->is('post')) {
            $following_id = $this->request->data('id');
            $user_id = $this->user->id;
            $FansTable = \Cake\ORM\TableRegistry::get('user_fans');
            //判断是否关注过
            $fans = $FansTable->find()->where("`user_id` = '$user_id' and `following_id` = '$following_id'")->first();
            if ($fans) {
                return $this->Util->ajaxReturn(false, '您已经关注过');
            }
            //查看是否被该用户关注过
            $follower = $FansTable->find()->where("`user_id` = '$following_id' and `following_id` = '$user_id'")->first();
            $newfans = $FansTable->newEntity();
            $newfans->user_id = $user_id;
            $newfans->following_id = $following_id;
            if ($follower) {
                //有被关注
                $errorFlag = [];
                $follower->type = 2;  //关系标注为互为关注
                $newfans->type = 2;
                $FansTable->connection()->transactional(function()use($FansTable, $follower, $newfans, $errorFlag) {
                    //开启事务
                    $errorFlag[] = $FansTable->save($newfans);
                    $errorFlag[] = $FansTable->save($follower);
                });
                if (in_array(false, $errorFlag)) {
                    return $this->Util->ajaxReturn(false, '关注失败');
                }
            } else {
                $newfans->type = 1;
                if (!$FansTable->save($newfans)) {
                    return $this->Util->ajaxReturn(true, '关注失败');
                }
            }
            //发送一条关注消息给被关注者
            $this->loadComponent('Business');
            $this->Business->usermsg($following_id, '您有新的关注者', '', 1, $newfans->id);
            //更新被关注者粉丝数  列表方便显示
            $follower_user = $this->User->get($following_id);
            $fansCount = $FansTable->find()->where("`following_id` = '$following_id'")->count();
            $follower_user->fans = $fansCount;
            $this->User->save($follower_user);
            return $this->Util->ajaxReturn(true, '关注成功');
        }
    }

    /**
     * 登出
     */
    public function loginOut() {
        $this->viewBuilder()->autoLayout(false);
        $this->request->session()->delete('User.mobile');
        $this->request->session()->destroy();
        $this->Flash->success('您已退出登录！');
        return $this->redirect('/user/login?loginout=1');
    }
    
    /**
     * 递名片动作
     * @param int $id 大咖id
     */
    public function giveCard($id){
        $this->handCheckLogin();
        $cardBoxTable = \Cake\ORM\TableRegistry::get('CardBox');
//        $a = $cardBoxTable->find()->all();
//        debug($a);die;
        if($this->user->id == $id)
        {
            return $this->Util->ajaxReturn(false, '不可给自己递名片');
        }
        $data['ownerid'] = $id;
        $data['uid'] = $this->user->id;
        $isGive = $cardBoxTable->find()->where($data)->first();
        debug($isGive);die;
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

}
