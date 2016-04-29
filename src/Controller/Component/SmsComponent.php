<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Core\Configure;
use Cake\Network\Http\Client;
use Cake\Utility\Xml;

/**
 * Sms component 短信组件
 */
class SmsComponent extends Component {

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /**
     * Qf106 平台短信接口
     * 只做简单发短信功能 具体业务和防止恶意刷短信 需结合在业务层处理
     * @param string $mobile 要发送到的手机号
     * @param string $content 发送的内容
     * @return bool true 成功 false 失败
     */
    public function sendByQf106($mobile, $content) {

        $smsConfig = Configure::read('sms');
        if (!$smsConfig) {
            throw new \Exception('未配置短信平台信息');
        }
        $http = new Client();
        $requestData = [
            'userid' => $smsConfig['userid'],
            'account' => $smsConfig['account'],
            'password' => $smsConfig['password'],
            'content' => $smsConfig['password'],
            'mobile' => $mobile,
            'content' => $content
        ];
        $url = 'http://www.qf106.com/sms.aspx?action=send';
        $response = $http->post($url, $requestData);
        if ($response->isOk()) {
            $body = Xml::toArray(Xml::build($response->body()));
            if ($body['returnsms']['returnstatus']&&$body['returnsms']['message']) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}
