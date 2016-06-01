<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * Wx component  wx组件 
 *  获取access_token,用户openId, jsapi 签名信息
 * @author caowenpeng <caowenpeng1990@126.com>
 */
class WxComponent extends Component {

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    const TOKEN_NAME = 'wx.access_token';
    const WEIXIN_API_URL = 'https://api.weixin.qq.com/cgi-bin/';
    const JSAPI_TICKET_NAME = 'wx.jsapi_ticket';

    protected $app_id;
    protected $app_secret;

    public function initialize(array $config) {
        parent::initialize($config);
        $wxconfig = \Cake\Core\Configure::read('weixin');
        $this->app_id = $wxconfig['appID'];
        $this->app_secret = $wxconfig['appsecret'];
    }

    /**
     *  验证服务器安全性  微信验证服务器是你的服务器 验证通过输出微信返回的字符串
     * @param type $token  公众号上填写的token值 
     * @return boolean
     */
    public function checkSignature($token) {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $token = $token;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
        if ($tmpStr == $signature) {
            echo $_GET['echostr'];
            exit();
        } else {
            return false;
        }
    }

    /**
     * 
     * 前往微信验证页 前去获取code
     * @param type $base  是否base 静默获取
     * @param string $redirect_url 跳转url
     */
    public function getUserJump($base=false,$redirect_url=null) {
        if(empty($redirect_url)){
            $redirect_url = 'http://' . $_SERVER['SERVER_NAME'] . '/mobile/wx/getUserCode';
        }else{
            $redirect_url = 'http://' . $_SERVER['SERVER_NAME'] .$redirect_url;
        }
        $scope = $base?'snsapi_base':'snsapi_userinfo';
        $wx_code_url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='
                . $this->app_id . '&redirect_uri=' . urlencode($redirect_url) . '&response_type=code&scope='.$scope.'&state=STATE#wechat_redirect';
        $this->_registry->getController()->redirect($wx_code_url);
    }

    /**
     * 通过返回的code 获取access_token 再异步获取openId 和 用户信息
     * @return boolean|stdClass 出错则返回false 成功则返回带有openId 的用户信息 json std对象
     */
    public function getUser() {
        $code = $this->request->query('code');
        $httpClient = new \Cake\Network\Http\Client(['ssl_verify_peer' => false]);
        $wx_accesstoken_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $this->app_id . '&secret=' . $this->app_secret .
                '&code=' . $code . '&grant_type=authorization_code';
        $response = $httpClient->get($wx_accesstoken_url);
        if ($response->isOk()) {
            $access_token = json_decode($response->body())->access_token;
            $open_id = json_decode($response->body())->openid;
            $wx_user_url = 'https://api.weixin.qq.com/sns/userinfo?access_token=' . $access_token . '&openid=' . $open_id . '&lang=zh_CN';
            $res = $httpClient->get($wx_user_url);
            if ($res->isOk()) {
                return json_decode($res->body());
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * 获取accessToken
     */
    public function getAccessToken() {
        $access_token = \Cake\Cache\Cache::read(self::TOKEN_NAME);
        $url = self::WEIXIN_API_URL . 'token?grant_type=client_credential&appid=' . $this->app_id . '&secret=' . $this->app_secret;
        if (is_array($access_token)) {
            $isExpires = $access_token['expires_in'] <= time() ? true : false;
        }
        if ($access_token === false || $isExpires) {
            $httpClient = new \Cake\Network\Http\Client(['ssl_verify_peer' => false]);
            $response = $httpClient->get($url);
            if ($response->isOk()) {
                $body = json_decode($response->body());
                if (!property_exists($body, 'access_token')) {
                    \Cake\Log\Log::error($response);
                    return false;
                }
                $token = $body->access_token;
                $expires = $body->expires_in;
                $expires = time() + $expires;
                \Cake\Cache\Cache::write(self::TOKEN_NAME, [
                    'access_token' => $token,
                    'expires_in' => $expires,
                    'ctime' => date('Y-m-d H:i:s')
                ]);
                return $token;
            } else {
                \Cake\Log\Log::error($response);
                return FALSE;
            }
        } else {
            return $access_token['access_token'];
        }
    } 

    /**
     * 获取jsapi_ticket
     */
    public function getJsapiTicket() {
        $jsapi_tickt = \Cake\Cache\Cache::read(self::JSAPI_TICKET_NAME);
        if (is_array($jsapi_tickt)) {
            $isExpires = $jsapi_tickt['expires_in'] <= time() ? true : false;
        }
        if ($jsapi_tickt !== false && !$isExpires) {
            //存在缓存并且没过期
            return $jsapi_tickt['jsapi_ticket'];
        }
        //否则 再次请求获取
        $access_token = $this->getAccessToken();
        if (!$access_token) {
            \Cake\Log\Log::error('获取access_token 出错');
            return false;
        }
        $httpClient = new \Cake\Network\Http\Client(['ssl_verify_peer' => false]);
        $url = self::WEIXIN_API_URL . 'ticket/getticket?access_token=' . $access_token . '&type=jsapi';
        $response = $httpClient->get($url);
        if (!$response->isOk()) {
            \Cake\Log\Log::error('请求获取jsapi_ticket出错');
            \Cake\Log\Log::error($response);
            return false;
        }
        $body = json_decode($response->body());
        if ($body->errmsg == 'ok') {
            $expires = $body->expires_in;
            $expires = time() + $expires;
            \Cake\Cache\Cache::write(self::JSAPI_TICKET_NAME, [
                'jsapi_ticket' => $body->ticket,
                'expires_in' => $expires,
                'ctime' => date('Y-m-d H:i:s')
            ]);
            return $body->ticket;
        } else {
            \Cake\Log\Log::error('获取jsapi_ticket返回信息有误');
            \Cake\Log\Log::error($body);
            return false;
        }
    }

    
    /**
     * 用于jsapi 调用的 签名等信息
     * @return type
     */
    public function setJsapiSignature() {
        $ticket = $this->getJsapiTicket();
        $noncestr = createRandomCode(16, 3);
        $timestamp = time();
        $url = $this->request->scheme().'://'.$_SERVER['SERVER_NAME'].$this->request->here(false);
        $param = [
            'noncestr' => $noncestr,
            'jsapi_ticket' => $ticket,
            'timestamp' => $timestamp,
            'url' => $url
        ];
        ksort($param);
        $signature = sha1(urldecode(http_build_query($param))); //不要转义的
        return [
            'signature' => $signature,
            'nonceStr' => $noncestr,
            'timestamp' => $timestamp,
            'appId'=>  $this->app_id,
        ];
    }
    
    /**
     * 微信配置信息
     * @param array $apiList @link http://mp.weixin.qq.com/wiki/11/74ad127cc054f6b80759c40f77ec03db.html 所有api参数名列表
     * @param boolean $debug
     * @return array
     */
    public function wxconfig(array $apiList, $debug=true){
        $wxsign = $this->setJsapiSignature();
        $wxsign['debug'] = $debug;
        $wxsign['jsApiList'] = $apiList;
        return $wxsign;
    }

}
