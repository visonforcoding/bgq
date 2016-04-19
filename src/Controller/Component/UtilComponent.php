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
     * ajax 返回json
     * @param type $status
     * @param type $msg
     */
    public function ajaxReturn($status,$msg) {
        $this->autoRender = false;
        $this->response->type('json');
        exit(json_encode(array('status' => $status, 'msg' => $msg),JSON_UNESCAPED_UNICODE));
    }

}
