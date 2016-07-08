<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * 支付宝
 * Alipay component
 */
class AlipayComponent extends Component {

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /**
     * 合作者id
     * @var type 
     */
    protected $partner;

    /**
     *  异步通知url
     * @var type 
     */
    protected $notify_url;

    /**
     * 卖家支付宝帐号
     * @var type 
     */
    protected $seller_id;
    
    /**
     * 私钥
     * @var type 
     */
    protected $private_key;

    public function initialize(array $config) {
        parent::initialize($config);
        $conf = \Cake\Core\Configure::read('alipay');
        $this->partner = $conf['partner'];
        $this->seller_id = $conf['seller_id'];
        $this->private_key = file_get_contents($conf['private_key']);
        $this->sslkey_path = $conf['sslkey_path'];
        $this->key = $conf['key'];
        $this->notify_url = $this->request->scheme() . '://' . $_SERVER['SERVER_NAME'] . $conf['notify_url'];
    }

    /**
     * 生成签名
     * @param type $order_no
     * @param type $order_title
     * @param type $order_fee
     * @param type $order_body
     * @return type
     */
    public function setSign($order_no,$order_title,$order_fee,$order_body) {
        $params = [
            'service' => 'mobile.securitypay.pay',
            'partner' => $this->partner,
            '_input_charset' => 'utf-8',
            'notify_url' => $this->notify_url,
            'out_trade_no' => "$order_no",
            'subject' => $order_title,
            'payment_type' => '1',
            'seller_id' => $this->seller_id,
            'total_fee' => $order_fee,
            'body' => $order_body,
        ];
        ksort($params);
        $stringA = urldecode(http_build_query($params)); //不要转义的
        //$stringB = $stringA . '&key=' . $this->key;
        //$sign = strtoupper(md5($stringB));
        $res = openssl_get_privatekey($this->private_key);
        openssl_sign($stringA, $sign, $res);
        openssl_free_key($res);
	//base64编码
        $sign = base64_encode($sign);
        return $sign;
    }
    
    /**
     * 生成支付参数
     * @param type $order_no
     * @param type $order_title
     * @param type $order_fee
     * @param type $order_body
     * @return string
     */
   public function setPayParameter($order_no,$order_title,$order_fee,$order_body){
       $params = [
            'service' => 'mobile.securitypay.pay',
            'partner' => $this->partner,
            '_input_charset' => 'utf-8',
            'notify_url' => $this->notify_url,
            'out_trade_no' => "$order_no",
            'subject' => $order_title,
            'payment_type' => '1',
            'seller_id' => $this->seller_id,
            'total_fee' => $order_fee,
            'body' => $order_body,
        ];
        ksort($params);
        $stringA = $this->buildLinkString($params); //不要转义的
        //$stringB = $stringA . '&key=' . $this->key;
        //$sign = strtoupper(md5($stringB));
        $res = openssl_get_privatekey($this->private_key);
        openssl_sign($stringA, $sign, $res);
        openssl_free_key($res);
	//base64编码
        $sign = urlencode(base64_encode($sign));
        $stringB = $stringA.'&sign="'.$sign.'"&sign_type="RSA"';
       return $stringB;
   }
   
   /**
    * 
    * @param type $params
    */
   public function buildLinkString($params){
       $string = '';
      foreach($params as $key=>$value){
          $string.= $key.'="'.$value.'"';
      }
      return $string;
   }

}
