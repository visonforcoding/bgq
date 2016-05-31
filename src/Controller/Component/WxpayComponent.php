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
     * 统一下单
     * @param type $attach
     * @param type $body
     * @param type $notify_url
     * @param type $openid
     * @param type $out_trade_no
     * @param type $fee
     */
    public function unifiedorder($attach,$body,$notify_url,$openid,$out_trade_no,$fee) {
        $httpClient = new \Cake\Network\Http\Client(['ssl_verify_peer' => false]);
        $xmlText = '<xml>
                    <appid>%s</appid>
                    <attach>%s</attach>
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
            'appid'=>  $this->app_id,
            'attach'=>  $attach,
            'body'=>  $body,
            'mch_id'=>  $this->mchid,
            'nonce_str'=>  $nonce_str,
            'notify_url'=>  $notify_url,
            'openid'=>  $openid,
            'out_trade_no'=>  $out_trade_no,
            'spbill_create_ip'=>  $ip,
            'total_fee'=>  $fee,
            'trade_type'=>  'JSAPI',
        ];
        $sign = $this->setSign($params);
        $xmlString = sprintf($xmlText,  $this->app_id,$attach,$body,  $this->mchid,$nonce_str,$notify_url,$openid,$out_trade_no,$ip,$fee,$sign);
        debug($xmlString);
    }
    
    public function setSign($params){
        debug($params);
        ksort($params);
        $stringA = urldecode(http_build_query($params)); //不要转义的
        debug($stringA);
        $stringB = $stringA.'&key='.$this->key;
        debug($stringB);
        $sign = strtoupper(md5($stringB));
        return $sign;
    }

}
