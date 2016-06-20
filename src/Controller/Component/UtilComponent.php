<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * Util component
 */
class UtilComponent extends Component {

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /**
     * ajax 返回json object response object
     * @param array/boole $status 可为数组也可以为boole
     * @param \Cake\Network\Response $response
     */
    public function ajaxReturn($status, $msg = '', $statusCode = 200) {
        $this->autoRender = false;
        $this->response->type('json');
        if (is_array($status) && !empty($status)) {
            if (!array_key_exists('code', $status)) {
                $status['code'] = 200;
            }
            $json =  json_encode($status, JSON_UNESCAPED_UNICODE);
        } else {
            $json =  json_encode(array('status' => $status, 'msg' => $msg, 'code' => $statusCode), JSON_UNESCAPED_UNICODE);
        }
        $this->response->body($json);
        return $this->response;
    }

}
