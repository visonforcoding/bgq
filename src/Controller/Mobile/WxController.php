<?php

namespace App\Controller\Mobile;

use App\Controller\Mobile\AppController;
use App\Utils\Weixin\WeixinSdk;
use EasyWeChat\Foundation\Application as WXSDK;

/**
 * User Controller
 *
 * @property \App\Model\Table\UserTable $User
 * @property \App\Controller\Component\HanvonComponent $Hanvon
 */
class WxController extends AppController {

    public function initialize() {
        parent::initialize();
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
     */
    public function getUserJump() {
        $wxconfig = \Cake\Core\Configure::read('weixin');
        $redirect_url = 'http://' . $_SERVER['SERVER_NAME'] . '/mobile/wx/getUserCode';
        $wx_code_url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='
                . $wxconfig['appID'] . '&redirect_uri=' . urlencode($redirect_url) . '&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
        $this->redirect($wx_code_url);
    }

    /*     * *
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
                return $this->redirect(['controller' => 'index', 'action' => 'index']);
            } else {
                $this->request->session()->write('reg.wx_openid', $open_id);
                $access_token = json_decode($response->body())->access_token;
                $wx_user_url = 'https://api.weixin.qq.com/sns/userinfo?access_token=' . $access_token . '&openid=' . $open_id . '&lang=zh_CN';
                $res = $httpClient->get($wx_user_url);
                if ($res->isOk()) {
                    $userinfo = json_decode($res->body()); //微信用户信息
                    $headimgurl = $userinfo->headimgurl;
                    \Cake\Log\Log::debug($headimgurl);
                    $this->request->session()->write('avatar',$headimgurl);
                }
                return $this->redirect(['controller' => 'user', 'action' => 'wxBindPhone']);
            }
        }
    }

}
