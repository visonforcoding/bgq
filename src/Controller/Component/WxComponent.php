<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * Wx component  wx组件
 */
class WxComponent extends Component {

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

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
     * 前往微信验证页 前去获取code
     */
    public function getUserJump() {
        $wxconfig = \Cake\Core\Configure::read('weixin');
        $redirect_url = 'http://' . $_SERVER['SERVER_NAME'] . '/mobile/wx/getUserCode';
        $wx_code_url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='
                . $wxconfig['appID'] . '&redirect_uri=' . urlencode($redirect_url) . '&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
        $this->redirect($wx_code_url);
    }
    
    
    /**
     * 通过返回的code 获取access_token 再异步获取openId 和 用户信息
     * @return boolean|stdClass 出错则返回false 成功则返回带有openId 的用户信息 json std对象
     */
    public function getUser(){
        $code = $this->request->query('code');
        $wxconfig = \Cake\Core\Configure::read('weixin');
        $httpClient = new \Cake\Network\Http\Client(['ssl_verify_peer'=>false]);
        $wx_accesstoken_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$wxconfig['appID'].'&secret='.$wxconfig['appsecret'].
                '&code='.$code.'&grant_type=authorization_code';
        $response = $httpClient->get($wx_accesstoken_url);
        if($response->isOk()){
           $access_token =  json_decode($response->body())->access_token;
           $open_id =  json_decode($response->body())->openid;
           $wx_user_url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$open_id.'&lang=zh_CN';
           $res = $httpClient->get($wx_user_url);
           if($res->isOk()){
              return json_decode($res->body());
           }else{
               return false;
           }
        }else{
            return false;
        }
    }

}
