<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * Wxpay component  用于微信支付
 */
class WxpayComponent extends Component {

    const WEIXIN_PAY_API_URL = 'https://api.mch.weixin.qq.com';

    protected $app_id;
    protected $app_secret;

    /**
     * 商户id
     * @var type 
     */
    protected $mchid;
    protected $key;
    protected $sslcert_path = '../cert/apiclient_cert.pem';
    protected $sslkey_path = '../cert/apiclient_key.pem';

    public function initialize(array $config) {
        parent::initialize($config);
        $wxconfig = \Cake\Core\Configure::read('weixin');
        $this->app_id = $wxconfig['appID'];
        $this->app_secret = $wxconfig['appsecret'];
        $this->mchid = $wxconfig['mchid'];
        $this->sslcert_path = $wxconfig['sslcert_path'];
        $this->sslkey_path = $wxconfig['sslkey_path'];
        $this->key = $wxconfig['key'];
    }

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /**
     * 
     * @param type $body   商品信息
     * @param type $openid  发起支付的用户openid
     * @param type $out_trade_no  商户上的订单号
     * @param type $fee   支付金额
     * @param type $notify_url  异步回调地址
     * @return type
     */
    public function unifiedorder($body, $openid, $out_trade_no, $fee, $notify_url = null) {
        $apiurl = self::WEIXIN_PAY_API_URL . '/pay/unifiedorder';
        $xmlText = '<xml>
                    <appid>%s</appid>
                    <body>%s</body>
                    <mch_id>%s</mch_id>
                    <nonce_str>%s</nonce_str>
                    <notify_url>%s</notify_url>
                    <openid>%s</openid>
                    <out_trade_no>%s</out_trade_no>
                    <spbill_create_ip>%s</spbill_create_ip>
                    <total_fee>%d</total_fee>
                    <trade_type>JSAPI</trade_type>
                    <sign>%s</sign>
                    </xml>';
        $ip = $this->request->clientIp();
        $nonce_str = createRandomCode(16);
        $params = [
            'appid' => $this->app_id,
            'body' => $body,
            'mch_id' => $this->mchid,
            'nonce_str' => $nonce_str,
            'notify_url' => $notify_url,
            'openid' => $openid,
            'out_trade_no' => $out_trade_no,
            'spbill_create_ip' => $ip,
            'total_fee' => $fee,
            'trade_type' => 'JSAPI',
        ];
        $sign = $this->setSign($params);
        $xmlString = sprintf($xmlText, $this->app_id, $body, $this->mchid, $nonce_str, $notify_url, $openid, $out_trade_no, $ip, $fee, $sign);
        $httpClient = new \Cake\Network\Http\Client(['ssl_verify_peer' => false]);
        $res = $httpClient->post($apiurl, $xmlString);
        if (!$res->isOk()) {
            \Cake\Log\Log::error($res);
            return false;
        }
        $body = (array)simplexml_load_string($res->body(), 'SimpleXMLElement', LIBXML_NOCDATA);
        if ($body['return_code'] == 'SUCCESS' && $body['result_code'] == 'SUCCESS') {
            return $body;
        } else {
            \Cake\Log\Log::error($body);
            return false;
        }
    }

    /**
     *  生成签名
     * @param type $params
     * @return type
     */
    public function setSign($params) {
        ksort($params);
        $stringA = urldecode(http_build_query($params)); //不要转义的
        $stringB = $stringA . '&key=' . $this->key;
        $sign = strtoupper(md5($stringB));
        return $sign;
    }

    /**
     * 生成支付参数 供页面JSapi 调用发起支付 (!!并且该页面URL 需是在微信公众号的微信支付那里配置了支付域)
     */
    public function setPayParameter($prepay_id) {
        $timestamp = time();
        $nonceStr = createRandomCode(16);
        $params = [
            'appId' => $this->app_id,
            'timeStamp' => $timestamp,
            'nonceStr' => $nonceStr,
            'package' => 'prepay_id=' . $prepay_id,
            'signType' => 'MD5'
        ];
        $sign = $this->setSign($params);
        $params['paySign'] = $sign;
        return $params;
    }
    
    
    /**
     * 直接获取 支付参数
     * @param type $body
     * @param type $openid
     * @param type $out_trade_no
     * @param type $fee
     * @param type $notify_url
     * @return boolean
     */
    public function getPayParameter($body, $openid, $out_trade_no, $fee, $notify_url = null){
        $res = $this->unifiedorder($body, $openid, $out_trade_no, $fee, $notify_url);
        if($res){
            $prepay_id = $res['prepay_id'];
            $pay_param = $this->setPayParameter($prepay_id);
            return $pay_param;
        }else{
            return false;
        }
    }

}
