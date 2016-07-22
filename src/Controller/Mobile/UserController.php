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
 * @property \App\Controller\Component\WxComponent $Wx
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
        }, 'Secret','Careers','Educations']]);
        $industries = $user->industries;
        $industry_arr = [];
        foreach($industries as $industry){
            $industry_arr[] = $industry['name'];
        }
        $isFans = false;
        $isGive = false;
        if($this->user){
            $user_id = $this->user->id;
            $FansTable = \Cake\ORM\TableRegistry::get('UserFans');
            $isFans = $FansTable->find()->where("`user_id` = '$user_id' and `following_id` = '$id'")->count();  //检测是否关注
            $isGive = $this->User->CardBoxes->find()->where(['ownerid'=>$id, 'uid'=>$this->user->id])->first();  //检测是否递过名片
        }
        $educationType = \Cake\Core\Configure::read('educationType');
        $this->set([
            'pageTitle'=>'个人主页',
            'self'=>$self,
            'isFans'=>$isFans,
            'isGive' => $isGive,
            'educationType' => $educationType
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
                $data['avatar'] =  '/mobile/images/touxiang.jpg';
                $user->register_status = 3;
                $user = $this->User->patchEntity($user, $data);
                if ($this->User->save($user)) {
                    //注册成功就算登录
                    $this->request->session()->write('User.mobile', $user);
                    $user_token = false;
                    if($this->request->is('lemon')){
                        $this->request->session()->write('Login.login_token',$user->user_token);
                        $user_token = $user->user_token;
                    }
                    return $this->Util->ajaxReturn(['status' => true, 'url' => '/home/index','token_uin'=>$user_token]);
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
                $user->register_status = 2;
                if ($this->User->save($user)) {
                    $this->request->session()->write('reg.step', 'two');
                    return $this->Util->ajaxReturn(['status' => true, 'url' => '/user/register-business']);
                } else {
                    return $this->Util->ajaxReturn(['status' => false, 'msg' => '服务器出错']);
                }
            }
        }
        //机构标签
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
        $this->set('pageTitle', '验证手机号');
    }

    /**
     * 注册首页 第一步
     */
    public function register() {
//        if (!$this->request->session()->read('reg.phone')) {
//            $this->redirect('/user/register-vphone');
//        }
        if ($this->request->is('ajax')) {
            $user = $this->User->newEntity();
            $data = $this->request->data();
            $data['enabled'] = 1;
            $data['phone'] = $this->request->session()->read('reg.phone');
            if ($this->request->session()->read('reg.wx_bind') && $this->request->session()->check('reg.wx_openid')) {
                //第一次微信登录的完善信息
                if($this->request->session()->check('reg.wx_unionid')){
                    $data['union_id'] = $this->request->session()->read('reg.wx_unionid');
                }
                if ($this->request->is('lemon')) {
                    $data['app_wx_openid'] = $this->request->session()->read('reg.wx_openid');
                } else {
                    $data['wx_openid'] = $this->request->session()->read('reg.wx_openid');
                }
                if($this->request->session()->check('reg.avatar')){
                    $data['avatar'] = $this->request->session()->read('reg.avatar');
                }
            }
            $user = $this->User->patchEntity($user, $data);
            if ($this->User->save($user)) {
                return $this->Util->ajaxReturn(['status' => true, 'url' => '/home/index']);
            } else {
               \Cake\Log\Log::error($user->errors());
               return $this->Util->ajaxReturn(['status' => false, 'msg' => getMessage($user->errors())]);
            }
        }
        //机构标签
        $AgencyTable = \Cake\ORM\TableRegistry::get('agency');
        $agencies = $AgencyTable->find('threaded', [
                    'keyField' => 'id',
                    'parentField' => 'pid'
                ])->hydrate(false)->toArray();
        //行业标签
        $IndustryTable = \Cake\ORM\TableRegistry::get('industry');
        $industries = $IndustryTable->find('threaded', [
                    'keyField' => 'id',
                    'parentField' => 'pid'
                ])->where("`id` != '3'")->hydrate(false)->toArray();
        
        $this->set([
            'industries'=>$industries,
            'agencys'=>$agencies,
            'pageTitle'=>'注册'
        ]);
        $this->render('register2');
    }

    /**
     * 处理识别名片
     */
    public function recogMp() {
        $this->loadComponent('Hanvon');
        $path = $this->request->data('path');
        $file = ROOT . '/webroot' . $path;
        $res = $this->Hanvon->handMpByHanvon($file);
        \Cake\Log\Log::debug('汉王调试','devlog');
        \Cake\Log\Log::debug($res,'devlog');
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
     * 处理识别名片
     */
    public function recogTest() {
        $this->loadComponent('Hanvon');
//        $path = $this->request->data('path');
        $path = '/upload/user/mp/2016-06-24/576d2f18c95d7.jpg';
        $file = ROOT . '/webroot' . $path;
        $res = $this->Hanvon->handMpByHanvon($file);
        \Cake\Log\Log::debug('汉王调试','devlog');
        \Cake\Log\Log::debug($res,'devlog');
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
        $redirect_url = empty($this->request->query('redirect_url')) ? '/news/index':  $this->request->query('redirect_url');
        if(in_array($redirect_url,['/home/my-install','/user/login'])){
            $redirect_url = '/home/index';
        }
        if($this->user){
            return $this->redirect($redirect_url);
        }
        $this->response->cookie([
            'name' => 'login_url',
            'value' => $redirect_url,
            'path' => '/',
            'expire' => time() + 600
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $phone = $this->request->data('phone');
            $user = $this->User->findByPhone($phone)->first();
            if ($user) {
                if($user->enabled==1){
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
                }elseif($user->register_status<3){
                    //中断注册的情况
                }
            
            } else{
                //不存在该手机号用户
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
     * 发送登录验证码
     */
    public function sendLoginCode() {
        
        $this->loadComponent('Sms');
        $mobile = $this->request->data('phone');
        $user = $this->User->findByPhoneAndEnabled($mobile, 1)->first();
        if (!$user) {
            return $this->Util->ajaxReturn(['status' => false,'msg'=>'该手机未注册,是否前往注册','phone'=>$mobile,'errCode'=>1]);
        }
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
            return $this->Util->ajaxReturn(['status' => false,'msg'=>'30秒后再发送','errCode'=>2]);
        }
    }
    /**
     * 发送动态验证码
     */
    public function sendVcode() {
        
        $this->loadComponent('Sms');
        $mobile = $this->request->data('phone');
//        $user = $this->User->findByPhoneAndEnabled($mobile, 1)->first();
//        if (!$user) {
//            return $this->Util->ajaxReturn(['status' => false,'msg'=>'该用户不存在']);
//        }
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
                        $user_token = false;
                        if($this->request->is('lemon')){
                            $this->request->session()->write('Login.login_token',$user->user_token);
                            $user_token = $user->user_token;
                        }
                        return $this->Util->ajaxReturn(['status' => true,'token_uin'=>$user_token]);
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
                //查看是否被该用户关注过
                $follower = $FansTable->find()->where("`user_id` = '$following_id' and `following_id` = '$user_id'")->first();
                if ($follower) {
                    //有被关注，改变互相关注状态
                    $follower->type = 1;  
                }
                $fans = $FansTable->find()->where("`user_id` = '$user_id' and `following_id` = '$following_id'")->first();
                $transRes = $FansTable->connection()
                        ->transactional(function()use($FansTable, $follower, $fans) {
                    //开启事务
                    return $FansTable->delete($fans)&&$FansTable->save($follower);
                });
                if(!$transRes) {
                    return $this->Util->ajaxReturn(false, '取消关注失败');
                } else {
                    return $this->Util->ajaxReturn(true, '取消关注成功');
                }
            } else {
                //查看是否被该用户关注过
                $follower = $FansTable->find()->where("`user_id` = '$following_id' and `following_id` = '$user_id'")->first();
                $newfans = $FansTable->newEntity();
                $newfans->user_id = $user_id;
                $newfans->following_id = $following_id;
                if ($follower) {
                    //有被关注
                    $follower->type = 2;  //关系标注为互为关注
                    $newfans->type = 2;
                    $transRes = $FansTable->connection()
                            ->transactional(function()use($FansTable, $follower, $newfans) {
                        //开启事务
                        return $FansTable->save($newfans)&&$FansTable->save($follower);
                    });
                    if (!$transRes) {
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
    }

    /**
     * 登出
     */
    public function loginOut() {
        $this->viewBuilder()->autoLayout(false);
        $this->request->session()->delete('User.mobile');
        $this->request->session()->destroy();
//        $this->Flash->success('您已退出登录！');
//        return $this->redirect('/user/login?loginout=1');
        return $this->Util->ajaxReturn(true, '您已退出登录！');
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
    
    public function getWxPic($id=''){
        $this->loadComponent('Wx');
        $token = $this->Wx->getAccessToken();
        $url = 'http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=' . $token . '&media_id=' . $id;
        $httpClient = new \Cake\Network\Http\Client();
        $response = $httpClient->get($url);
        if($response->isOk()){
            $res = $response->body();
        }
        $today = date('Y-m-d');
        $path = 'upload/user/avatar/'.$today;
        $file_name = $path.'/thumb_'.  uniqid().'.jpg';
        if(!is_dir($path)){
            mkdir($path,0777,true);
        }
        \Intervention\Image\ImageManagerStatic::make($res)
                ->resize(60,60)
                ->save(WWW_ROOT . $file_name);
        $file_name = '/' . $file_name;
        $user = $this->User->get($this->user->id);
        $user = $this->User->patchEntity($user, ['avatar'=>$file_name]);
        $res = $this->User->save($user);
        if($res){
            return $this->Util->ajaxReturn(['status'=>true, 'msg'=>'头像上传成功', 'path'=>$file_name]);
        } else {
            return $this->Util->ajaxReturn(false, '头像上传失败');
        }
    }

    public function getAppPic(){
        $data = $this->request->data;
        $user = $this->User->get($this->user->id);
        $user = $this->User->patchEntity($user, $data);
        $res = $this->User->save($user);
        if ($res) {
            return $this->Util->ajaxReturn(['status'=>true, 'msg'=>'头像上传成功', 'path'=>$data['avatar']]);
        } else {
            return $this->Util->ajaxReturn(false, '头像上传失败');
        }
    }
    
    
    /**
     * 静态页用于请求登陆
     */
    public function loginStatus(){
        if($this->user){
            echo 'yes';
        }else{
            echo 'no';
        }
        exit();
    }
    
    public function changePhone(){
        if($this->request->is('post')){
            $user_id = $this->user->id;
            $user = $this->User->get($user_id);
            $vcode = $this->request->session()->read('newPhoneVcode');
            if ($vcode['code'] != $this->request->data('vcode')) {
                return $this->Util->ajaxReturn(false, '验证码验证错误');
            }
            $oldPhone = $this->User->find()->where(['phone'=>$this->request->data('phone')])->first();
            if($oldPhone){
                return $this->Util->ajaxReturn(false, '该手机号已注册');
            }
            if (time() - $vcode['time'] < 60 * 10){
                $user->phone = $this->request->data('phone');
                $res = $this->User->save($user);
                if($res){
                    return $this->Util->ajaxReturn(true, '修改成功');
                } else {
                    return $this->Util->ajaxReturn(false, '修改失败');
                }
            } else {
                return $this->Util->ajaxReturn(false, '验证码已过期，请重新获取');
            }
        }
        $this->set('pageTitle', '修改手机号');
    }
    
    /**
     * 发送修改手机验证码
     */
    public function changePhoneVcode() {
        $this->loadComponent('Sms');
        $mobile = $this->request->data('phone');
        $oldPhone = $this->User->find()->where(['phone'=>$this->request->data('phone')])->first();
        if($oldPhone){
            return $this->Util->ajaxReturn(false, '该手机号已注册');
        }
        $code = createRandomCode(4, 2); //创建随机验证码
        $content = '您的动态验证码为' . $code;
        $codeTable = \Cake\ORM\TableRegistry::get('smsmsg');
        $vcode = $codeTable->find()->where("`phone` = '$mobile'")->orderDesc('create_time')->first();
        if (empty($vcode) || (time() - strtotime($vcode['time'])) > 30) {
            //30s 的间隔时间
            $ckSms = $this->Sms->sendByQf106($mobile, $content, $code);
            if ($ckSms) {
                $this->request->session()->write('newPhoneVcode', ['code' => $code, 'time' => time()]);
                return $this->Util->ajaxReturn(true, '发送成功');
            }
        } else {
            return $this->Util->ajaxReturn(false, '30秒后再发送');
        }
    }
}
