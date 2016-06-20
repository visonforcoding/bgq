<?php

namespace App\Controller\Mobile;

use App\Controller\Mobile\AppController;
use App\Utils\Weixin\WeixinSdk;
use EasyWeChat\Foundation\Application as WXSDK;

/**
 * User Controller
 *
 * @property \App\Model\Table\UserTable $User
 * @property \App\Controller\Component\WxComponent $Wx
 * @property \App\Controller\Component\WxpayComponent $Wxpay
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
     * 静默登录
     */
    public function getUserCodeBase() {
        $res = $this->Wx->getUser();
        $this->request->session()->write('Login.wxbase', true);
        if (isset($res->openid)) {
            $open_id = $res->openid;
            $user = $this->User->findByWx_openid($open_id)->first();
            if ($user) {
                //通过微信 获取到 在平台上有绑定的用户  就默认登录
                $this->request->session()->write('User.mobile', $user);
            }
        }
        //无论怎样 必须要跳会首页
        return $this->redirect('/');
    }

    /**
     * 预约支付页  此页面URL 需在微信公众号的微信支付那里配置 支付域
     * @param int $id  订单id
     */
    public function meetPay($id = null) {
        $OrderTable = \Cake\ORM\TableRegistry::get('Order');
        $order = $OrderTable->get($id, [
            'contain' => ['SubjectBook', 'SubjectBook.Subjects']
        ]);
        $body = '预约话题《' . $order->subject_book->subject->title . '》支付';
        $openid = $this->user->wx_openid;
        $out_trade_no = $order->order_no;
        //$fee = intval(($order->price)*100);  //支付金额(分)
        $fee = 1;  //测试时 1分
        $this->loadComponent('Wxpay');
        $jsApiParameters = $this->Wxpay->getPayParameter($body, $openid, $out_trade_no, $fee);
        $this->set(array(
            'jsApiParameters' => $jsApiParameters,
        ));
        $book = $order->subject_book;
        $this->set(compact('book'));
    }

    /**
     * 微信的异步回调通知
     */
    public function wxNotify() {
        $this->loadComponent('Wxpay');
        $this->Wxpay->notify();
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
            \Cake\Log\Log::debug($res);
            if (!$res) {
                //获取到openid 有问题
                return $this->Util->ajaxReturn(['status' => false, 'msg' => '与微信服务器交互出现问题']);
            }
            $union_id = $res->unionid;
            $open_id = $res->openid;
            $user = $this->User->findByUnion_id($union_id)->first();
            if ($user) {
                //直接登陆
                if (empty($user->app_wx_opeinid)) {
                    $user->app_wx_openid = $open_id;
                    $this->User->save($user);
                }
                $this->request->session()->write('Login.login_token',$user->user_token);
                $this->request->session()->write('User.mobile', $user);
                return $this->Util->ajaxReturn(['status' => true, 'msg' => '登陆成功', 'redirect_url' => '/']);
            } else {
                //未注册过
                $headimgurl = $res->headimgurl;
                $this->request->session()->write('reg.wx_openid', $open_id);
                $this->request->session()->write('reg.avatar', $headimgurl);
                return $this->Util->ajaxReturn(['status' => true, 'msg' => '登陆成功，前往完善信息', 'redirect_url' => '/user/wx-bind-phone']);
            }
        }
    }

}
