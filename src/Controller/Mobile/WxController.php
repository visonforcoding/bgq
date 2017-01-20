<?php

namespace App\Controller\Mobile;

use App\Controller\Mobile\AppController;

/**
 * User Controller
 *
 * @property \App\Model\Table\UserTable $User
 * @property \App\Controller\Component\WxComponent $Wx
 * @property \App\Controller\Component\BussinessComponent $Bussiness
 * @property \App\Controller\Component\SmsComponent $Sms
 * @property \App\Controller\Component\WxpayComponent $Wxpay
 * @property \App\Controller\Component\AlipayComponent $Alipay
 */
class WxController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadComponent('Wx');
        $this->loadModel('User');
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function test() {
        $open_id = '123';
        $user = $this->User->findByWx_openid($open_id)->first();
        debug($user);
        die();
        $WeixinSdk = new WeixinSdk();
        $token = 'cwptest';
        $WeixinSdk->checkSignature($token);
    }

    /**
     * 授权登录/获取信息页  跳转页
     * 1.微信公众号 绑定JS安全域名
     * 2.网页授权回调域名（必须配置为全域名)  接口权限->网页授权获取用户基本信息->修改
     */
    public function getUserJump() {
        $wxconfig = \Cake\Core\Configure::read('weixin');
        $redirect_url = 'http://' . $_SERVER['SERVER_NAME'] . '/mobile/wx/getUserCode';
        $wx_code_url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='
                . $wxconfig['appID'] . '&redirect_uri=' . urlencode($redirect_url) . '&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
        $this->redirect($wx_code_url);
    }

    /*     *
     * 获取code->获取openid user 信息 业务处理
     */

    public function getUserCode() {
        $code = $this->request->query('code');
        $wxconfig = \Cake\Core\Configure::read('weixin');
        $httpClient = new \Cake\Network\Http\Client(['ssl_verify_peer' => false]);
        $wx_accesstoken_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $wxconfig['appID'] . '&secret=' . $wxconfig['appsecret'] .
                '&code=' . $code . '&grant_type=authorization_code';
        //\Cake\Log\Log::debug($wx_accesstoken_url);
        $response = $httpClient->get($wx_accesstoken_url);
        if ($response->isOk()) {
            if (isset(json_decode($response->body())->openid)) {
                $open_id = json_decode($response->body())->openid;
            } else {
                //发生了错误
                $this->redirect('/user/login');
            }
            //首次登录需有一个绑定平台操作
            $user = $this->User->findByWx_openid($open_id)->first();
            if ($user) {
                //存在则直接 表示登录 进入首页
                $this->request->session()->write('User.mobile', $user);
                return $this->redirect('/');
            } else {
                $this->request->session()->write('reg.wx_openid', $open_id);
                $access_token = json_decode($response->body())->access_token;
                $wx_user_url = 'https://api.weixin.qq.com/sns/userinfo?access_token=' . $access_token . '&openid=' . $open_id . '&lang=zh_CN';
                $res = $httpClient->get($wx_user_url);
                if ($res->isOk()) {
                    $userinfo = json_decode($res->body()); //微信用户信息
                    $headimgurl = $userinfo->headimgurl;
                    $this->request->session()->write('reg.avatar', $headimgurl);
                }
                return $this->redirect(['controller' => 'user', 'action' => 'wxBindPhone']);
            }
        }
    }

    /**
     * 注册成功后的账号绑定微信
     */
    public function bindWx() {
        if (!$this->user) {
            return $this->redirect('/user/login');
        }
        $wxconfig = \Cake\Core\Configure::read('weixin');
        $code = $this->request->query('code');
        if (empty($code)) {
            $redirect_url = 'http://' . $_SERVER['SERVER_NAME'] . '/mobile/wx/bindWx';
            $wx_code_url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='
                    . $wxconfig['appID'] . '&redirect_uri=' . urlencode($redirect_url) . '&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
            return $this->redirect($wx_code_url);
        } else {
            $httpClient = new \Cake\Network\Http\Client(['ssl_verify_peer' => false]);
            $wx_accesstoken_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $wxconfig['appID'] . '&secret=' . $wxconfig['appsecret'] .
                    '&code=' . $code . '&grant_type=authorization_code';
            //取得openid
            $response = $httpClient->get($wx_accesstoken_url);
            if (!$response->isOk() || !isset(json_decode($response->body())->openid)) {
                //绑定失败
                return $this->redirect('/home/index');
            }
            $open_id = json_decode($response->body())->openid;
            $access_token = json_decode($response->body())->access_token;
            $wx_user_url = 'https://api.weixin.qq.com/sns/userinfo?access_token=' . $access_token . '&openid=' . $open_id . '&lang=zh_CN';
            $res = $httpClient->get($wx_user_url);
            $user_id = $this->user->id;
            $UserTable = \Cake\ORM\TableRegistry::get('User');
            if ($res->isOk()) {
                $user = $UserTable->get($user_id);
                $userinfo = json_decode($res->body()); //微信用户信息
                \Cake\Log\Log::debug('注册调试', 'devlog');
                \Cake\Log\Log::debug($userinfo, 'devlog');
                $headimgurl = $userinfo->headimgurl;
                //存储微信头像
                //$avatar = $this->Util->saveUrlImage($headimgurl,'user/avatar');
                $user->avatar = $headimgurl;
                $user->union_id = $userinfo->unionid;
                $user->wx_openid = $open_id;
                $UserTable->save($user);
                return $this->redirect('/home/index');
            }
        }

        //\Cake\Log\Log::debug($wx_accesstoken_url);
    }

    /**
     * 静默登录
     */
    public function getUserCodeBase() {
        $res = $this->Wx->getUser();
        //微信静默登录
        \Cake\Log\Log::debug('静默登录', 'devlog');
        \Cake\Log\Log::debug($res, 'devlog');
        $this->request->session()->write('Login.wxbase', true);
        $user = false;
//        if (isset($res->unionid)) {
//            $union_id = $res->unionid;
//            $user = $this->User->findByUnion_idAndEnabled($union_id,1)->first();
//        }elseif (isset($res->openid)) {
        $open_id = $res->openid;
        $user = $this->User->findByWx_openidAndEnabled($open_id, 1)->first();
//        }
        if ($user) {
            //通过微信 获取到 在平台上有绑定的用户  就默认登录
            if (empty($user->union_id) && isset($res->unionid)) {
                $user->union_id = $res->unionid;
                $this->User->save($user);
            }
            $this->request->session()->write('User.mobile', $user);
        }
        //无论怎样 必须要跳会首页
        return $this->redirect('/');
    }

    /**
     * 预约支付页  此页面URL 需在微信公众号的微信支付那里配置 支付域
     * @param int $id  订单id
     */
    public function meetPay($id = null) {
        $this->handCheckLogin();
        $UserTable = \Cake\ORM\TableRegistry::get('User');
        $OrderTable = \Cake\ORM\TableRegistry::get('Order');
        $theorder = $OrderTable->get($id);
        $type = $theorder->type;
        if ($type == 1) {
            $order = $OrderTable->get($id, [
                'contain' => ['SubjectBook', 'SubjectBook.Subjects']
            ]);
            $body = '预约话题《' . $order->subject_book->subject->title . '》支付';
            $title = '并购帮-预约话题';
            $order_detail = $order->subject_book->subject;
            $order_detail->price = $order->price;
            $order_detail->type = $type;
        } elseif($type == 2) {
            $order = $OrderTable->get($id, [
                'contain' => ['Activityapplys', 'Activityapplys.Activities']
            ]);
            $body = '活动报名《' . $order->activityapply->activity->title . '》支付';
            if($order->activityapply->is_triple){
                $price = $order->activityapply->activity->triple_fee;
            } else {
                $price = $order->activityapply->activity->apply_fee;
            }
            if($order->title != $body || $order->price != $price){
                $order->title = $body;
                $order->price = $price;
                $order->order_no = time() . $order->activityapply->activity->user_id . $id . createRandomCode(4, 1);
                $order = $OrderTable->save($order);
            }
            $title = '并购帮-活动报名';
            $order_detail = $order->activityapply->activity;
            $order_detail->price = $order->price;
            $order_detail->type = $type;
        } elseif($type == 3){
            $order = $OrderTable->get($id);
            $title = '充值余额';
            $body = '充值余额';
        }
        
        $out_trade_no = $order->order_no;
//        $openid = $this->user->wx_openid;
//        \Cake\Log\Log::error('数据库openid为:'.$openid,'devlog');
        $user = $UserTable->get($this->user->id);
        $openid = $user->wx_openid;
        if(!$openid&&!$this->request->session()->check('Pay.getopenid')&&$this->request->is('weixin')){
            \Cake\Log\Log::error('数据库openid为空重新获取openid','devlog');
            $this->request->session()->write('Pay.getopenid',true);
            $this->Wx->getUserJump(true, true);
        }
        
        $code=$this->request->query('code');
        if($code){
            $res = $this->Wx->getUser($code);
            $openid = $res->openid;
            $user->wx_openid = $openid;
            $user->union_id = $res->unionid;
            $UserTable->save($user);
        }

        $fee = $order->price;  //支付金额(分)
        $this->loadComponent('Wxpay');
        $isApp = false;
        $aliPayParameters = '';
        $jsApiParameters = '';
        if ($this->request->is('lemon')) {
            $isApp = true;
            $openid = $user->app_wx_openid;
            $this->loadComponent('Alipay');
            $aliPayParameters = $this->Alipay->setPayParameter($out_trade_no, $title, $fee, $body);
        }

        $jsApiParameters = $this->Wxpay->getPayParameter($body, $openid, $out_trade_no, $fee, null, $isApp);
        $this->set(array(
            'jsApiParameters' => $jsApiParameters,
            'isWx' => $this->request->is('weixin') ? true : false,
            'aliPayParameters' => $aliPayParameters,
        ));
        
        if($this->request->is('get')){
            $this->set('relate_id', $this->request->query('relate_id'));
            $this->set('type', $this->request->query('type'));
        }
        $this->set([
            'pageTitle' => '订单支付',
        ]);
        $this->set(compact('order_detail', 'order'));
        if($order->type == 3){
            $this->render('pay');
        }
    }

    /**
     * ajax 获取微信支付参数
     * @param type $id
     * @return type
     */
    public function paywx($id = null) {
        //用户第一次在平台 用微信支付
        $code = $this->request->data('code');
        $res = $this->Wx->getUser($code, true);
        if (!$res) {
            //获取到openid 有问题
            return $this->Util->ajaxReturn(['status' => false, 'msg' => '与微信服务器交互出现问题']);
        }
        $union_id = $res->unionid;
        $openid = $res->openid;
        $user_id = $this->user->id;
        $UserTable = \Cake\ORM\TableRegistry::get('User');
        $user = $UserTable->get($user_id);
        $user->union_id = $union_id;
        $user->app_wx_openid = $openid;
        $UserTable->save($user); //记录open_id 等微信信息
        $this->request->session()->write('User.mobile', $user);//并更新session
        $OrderTable = \Cake\ORM\TableRegistry::get('Order');
        $order = $OrderTable->get($id);
        if ($order->type == 1) {
             $order = $OrderTable->get($id, [
                'contain' => ['SubjectBook', 'SubjectBook.Subjects']
            ]);
            $body = '预约话题《' . $order->subject_book->subject->title . '》支付';
        } elseif($order->type == 2) {
            $order = $OrderTable->get($id, [
                'contain' => ['Activityapplys', 'Activityapplys.Activities']
            ]);
            $body = '活动报名《' . $order->activityapply->activity->title . '》支付';
        } elseif($order->type == 3){
            $order = $OrderTable->get($id);
            $body = '充值余额';
        }
        $out_trade_no = $order->order_no;
        $fee = $order->price;  //支付金额(分)
        $this->loadComponent('Wxpay');
        $isApp = false;
        $jsApiParameters = '';
        if ($this->request->is('lemon')) {
            $isApp = true;
        }
        if ($openid) {
            $jsApiParameters = $this->Wxpay->getPayParameter($body, $openid, $out_trade_no, $fee, null, $isApp);
        }
        return $this->Util->ajaxReturn([
            'jsApiParameters' => $jsApiParameters
        ]);
    }

    /**
     * 微信的异步回调通知
     */
    public function wxNotify() {
        $this->loadComponent('Wxpay');
        $res = $this->Wxpay->notify();
        exit();
    }

    /**
     * 支付宝异步回调通知
     */
    public function aliNotify() {
        \Cake\Log\Log::debug('进入支付宝支付回调', 'devlog');
        $this->loadComponent('Alipay');
        if (!$this->Alipay->notifyVerify()) {
            \Cake\Log\Log::error('验证失败', 'devlog');
            echo 'fail';
        } else {
            $this->Alipay->notify();
        }
        exit();
    }

    /**
     * app 微信登录接口
     * @return type
     */
    public function appLogin() {
        if ($this->request->isPost()) {
            $code = $this->request->data('code');
            $res = $this->Wx->getUser($code, true);
            \Cake\Log\Log::debug($res, 'devlog');
            if (!$res) {
                //获取到openid 有问题
                return $this->Util->ajaxReturn(['status' => false, 'msg' => '与微信服务器交互出现问题']);
            }
            $union_id = $res->unionid;
            $open_id = $res->openid;
            //$user = $this->User->findByUnion_id($union_id)->first();
            $user = $this->User->find()->where(['union_id'=>$union_id,'enabled'=>1,'is_del'=>0])->first();
            if ($user) {
                //直接登陆
                if (empty($user->app_wx_opeinid)) {
                    $user->app_wx_openid = $open_id;
                    $this->User->save($user);
                }
                $this->request->session()->write('Login.login_token', $user->user_token);
                $this->request->session()->write('User.mobile', $user);
                return $this->Util->ajaxReturn(['status' => true, 'msg' => '登陆成功', 'redirect_url' => '/home/index', 'token_uin' => $user->user_token]);
            } else {
                //未注册过
                $headimgurl = $res->headimgurl;
                $this->request->session()->write('reg.wx_unionid', $union_id);
                $this->request->session()->write('reg.wx_openid', $open_id);
                $this->request->session()->write('reg.avatar', $headimgurl);
                return $this->Util->ajaxReturn(['status' => true, 'msg' => '登陆成功，前往完善信息', 'redirect_url' => '/user/wx-bind-phone']);
            }
        }
    }
    
    public function apply($apply_id=NULL){
        if(!$apply_id) {
            return $this->Util->ajaxReturn(false, '非法操作');
        }
        $user_id = $this->user->id;
        $ActivityapplyTable = \Cake\ORM\TableRegistry::get('Activityapply');
        $apply = $ActivityapplyTable->get($apply_id, [
            'contain' => [
                'Activities', 'Companions'
            ]
        ]);
        $multi_nums = count($apply->companions);
        $UserTable = \Cake\ORM\TableRegistry::get('User');
        $user = $UserTable->get($user_id);
        $platform = $UserTable->get('-1');
        if($apply->is_pass == 1){
            return $this->Util->ajaxReturn(false, '您已经购买了');
        }
        $count = $ActivityapplyTable->find()->count();
        if($multi_nums){
            foreach($apply->companions as $k=>$v){
                $apply->companions[$k]['is_pass'] = 1;
                $apply->companions[$k]['verify_code'] = dec2s4($count + $k + 1000000000);
            }
        }
        $apply->is_pass = 1;
        $apply->verify_code = dec2s4($count + 999999999);
        $pre_amount = $platform->money;
        $user->money -= $apply->apply_fee;    //余额-
        $platform->money += $apply->apply_fee;
        $apply->activity->apply_nums += ($multi_nums+1);    // 报名次数+1
        $apply->dirty('activity',true);
        $apply->dirty('companions',true);
        $FlowTable = \Cake\ORM\TableRegistry::get('Flow');
        $flow = $FlowTable->newEntity([
            'user_id' => -1,
            'buyer_id'=>$user_id,
            'type' => 2, // 培训
            'relate_id' => $apply->id,   //关联的订单id
            'type_msg' => '活动报名收入',
            'income' => 1,
            'amount' => $apply->apply_fee,
            'price'=>$apply->apply_fee,
            'pre_amount' => $pre_amount,
            'paytype'=>3,
            'after_amount' => $user->money,
            'status' => 1,
            'remark' => '报名活动《'.$apply->activity->title.'》'
        ]);
        $tran = $FlowTable->connection()->transactional(function()use($UserTable, $user, $platform, $FlowTable, $flow, $ActivityapplyTable, $apply){
            return $UserTable->save($user) &&
                    $UserTable->save($platform) &&
                    $FlowTable->save($flow) &&
                    $ActivityapplyTable->save($apply);
        });
        if($tran){
//                $this->loadComponent('Business');
//                $this->Business->usermsg('-1', $user->id, '您成功购买了此培训', '', 11, $course->id, '/course/detail/'.$course->id);
            $where = [
                'or' => [
                    'triple_pid' => $apply_id,
                    'Activityapply.id' => $apply_id,
                ]
            ];
            $apply = $ActivityapplyTable->find()->contain(['Activities'])->where($where)->toArray();
            $this->loadComponent('Sms');
            foreach($apply as $k=>$v){
                $this->Sms->sendByQf106($v->phone, '您已成功报名活动：'.$v->activity->title.'。您的签到码为：' . strtoupper($v->verify_code));
            }
            return $this->Util->ajaxReturn(true, '购买成功');
        } else {
            return $this->Util->ajaxReturn(false, '购买失败');
        }
    }

    /**
     * 支付成功
     */
    public function paySuccess() {
        $this->set([
            'pageTitle' => '支付结果页'
        ]);
    }

    /**
     * 微信的上传图片接口
     * @param type $id
     * @return type
     */
    public function wxUploadPic($id) {
        $path = $this->Wx->wxUpload($id);
        return $this->Util->ajaxReturn(['status' => true, 'msg' => '上传成功', 'path' => $path]);
    }

    /**
     * 记录js的调试
     * @return type
     */
    public function jsLog() {
        $content = $this->request->query('content');
        \Cake\Log\Log::error('js错误', 'jslog');
        $res = \Cake\Log\Log::error($content, 'jslog');
        if ($res) {
            return $this->Util->ajaxReturn(true, 'ok');
        } else {
            return $this->Util->ajaxReturn(false, 'error');
        }
    }

    /**
     * 下载
     * @param type $controller 控制器
     * @param type $id 关联id
     */
    public function shareDownload($controller = null, $id = null) {
        if ($controller && $id) {
            if ($controller == 'news') {
                $url = '/news/view/' . $id;
            } elseif ($controller == 'activity') {
                $url = '/activity/details/' . $id;
            } elseif ($controller == 'user') {
                $url = '/meet/view/' . $id;
            } elseif ($controller == 'beauty'){
                $url = '/beauty/homepage/' . $id;
            } elseif ($controller == 'course'){
                $url = '/course/detail/' . $id;
            }
        } else {
            $url = '/meet/index';
        }
        $this->set([
            'pageTitle' => '下载并购帮',
            'url' => $url,
        ]);
    }
    
    /**
     * 直接购买
     */
    public function buy(){
        $this->handCheckLogin();
        if($this->request->is('post')){
            $data = $this->request->data;
            if($data['relate_id'] && $data['type'] == 1){
                // 处理培训
                $res = $this->buyCourse($data['relate_id']);
            } elseif($data['relate_id'] && $data['type'] == 2){
                // 处理活动报名
                $res = $this->apply($data['relate_id']);
            }
            return $res;
        }
    }
    
    /**
     * 处理购买培训
     */
    public function buyCourse($course_id=NULL){
        if(!$course_id){
            return $this->Util->ajaxReturn(false, '非法操作');
        }
        $user_id = $this->user->id;
        $CourseTable = \Cake\ORM\TableRegistry::get('Course');
        $course = $CourseTable->get($course_id);
        $UserTable = \Cake\ORM\TableRegistry::get('User');
        $user = $UserTable->get($user_id);
        $platform = $UserTable->get('-1');
        $CourseApplyTable = \Cake\ORM\TableRegistry::get('CourseApply');
        $apply = $CourseApplyTable->find()->where(['course_id'=>$course_id, 'user_id'=>$user_id, 'is_pay'=>1])->first();
        if($apply){
            return $this->Util->ajaxReturn(false, '您已经购买了');
        }
        $courseApply = $CourseApplyTable->newEntity([
            'course_id' => $course_id,
            'user_id' => $user_id,
            'is_pay' => 1
        ]);
        $courseApply = $CourseApplyTable->save($courseApply);
        if(!$courseApply){
            return $this->Util->ajaxReturn(false, '系统错误');
        }
        $courseApply->is_pay = 1;
        $pre_amount = $platform->money;
        $user->money -= $course->fee;    //余额-
        $platform->money += $course->fee;
        $course->pay_nums += 1;    // 报名次数+1
        $FlowTable = \Cake\ORM\TableRegistry::get('Flow');
        $flow = $FlowTable->newEntity([
            'user_id' => -1,
            'buyer_id'=>$user_id,
            'type' => 3, // 培训
            'relate_id' => $courseApply->id,   //关联的订单id
            'type_msg' => '培训收入',
            'income' => 1,
            'amount' => $course->fee,
            'price'=>$course->fee,
            'pre_amount' => $pre_amount,
            'paytype'=>3,
            'after_amount' => $user->money,
            'status' => 1,
            'remark' => '购买培训《'.$course->title.'》'
        ]);
        $tran = $FlowTable->connection()->transactional(function()use($UserTable, $user, $platform, $FlowTable, $flow, $CourseTable, $course){
            return $UserTable->save($user) && $UserTable->save($platform) && $FlowTable->save($flow) && $CourseTable->save($course);
        });
        if($tran){
//                $this->loadComponent('Business');
//                $this->Business->usermsg('-1', $user->id, '您成功购买了此培训', '', 11, $course->id, '/course/detail/'.$course->id);
            return $this->Util->ajaxReturn(true, '购买成功', $course_id);
        } else {
            return $this->Util->ajaxReturn(false, '购买失败');
        }
    }
    
    public function buySuccess($id=NULL){
        $CourseTable = \Cake\ORM\TableRegistry::get('Course');
        $course = $CourseTable->find()
                ->where(['Course.is_del'=>0, 'Course.is_recom'=>1, 'Course.id !='=>$id])
                ->limit(4)
                ->order('rand()')
                ->toArray();
        $this->set([
            'pageTitle' => '购买成功',
            'course' => $course,
            'course_id' => $id
        ]);
    }
    
    /**
     * 充值
     * @param type $id 关联id
     * @param type $type 类型，区分充值直接购买成功的页面，1：培训；2：活动
     */
    public function charge($id=NULL, $type=NULL){
        $RechargeGiftTable = \Cake\ORM\TableRegistry::get('RechargeGift');
        $gift = $RechargeGiftTable->find()->order(['recharge_money'=>'asc'])->all()->toArray();
        $this->set([
            'pageTitle'=>'充值',
            'gift' => $gift,
            'id' => $id,
            'type' => $type
        ]);
    }
    
    public function chargeSuccess($id=NULL){
        $OrderTable = \Cake\ORM\TableRegistry::get('Order');
        $order = $OrderTable->get($id);
        $this->set([
            'pageTitle' => '充值成功',
            'charge_money' => $order->price + $order->gift
        ]);
    }
    
    public function chargeOrder($money=NULL){
        $this->handCheckLogin();
        if($this->request->is('post')){
            $gift = 0;
            $RechargeGiftTable = \Cake\ORM\TableRegistry::get('RechargeGift');
            $rechargeGift = $RechargeGiftTable->find()->orderAsc('recharge_money')->all()->toArray();
            for($i=0;$i<count($rechargeGift);$i++){
                if($money >= $rechargeGift[$i]->recharge_money){
                    $gift = $rechargeGift[$i]->gift;
                }
            }
            $OrderTable = \Cake\ORM\TableRegistry::get('Order');
            $order = $OrderTable->newEntity([
                'type' => 3, // 类型为充值
                'relate_id' => 0, //充值
                'user_id' => $this->user->id,
                'seller_id' => $this->user->id,     //活动报名的收入 固定给-1 的用户
                'order_no' => time() . $this->user->id . createRandomCode(4, 1),
                'fee' => 0, // 实际支付的默认值
                'price' => $money,
                'remark' => '充值余额',
                'gift' => $gift
            ]);
            $order = $OrderTable->save($order);
            if($order){
                return $this->Util->ajaxReturn(true, '', $order->id);
            } else {
                return $this->Util->ajaxReturn(false, '系统错误');
            }
        }
    }

}
