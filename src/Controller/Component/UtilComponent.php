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
     * @param array/boole $status 可为数组也可以为boole
     * @param type $msg
     */
    public function ajaxReturn($status, $msg = '') {
        $this->autoRender = false;
        $this->response->type('json');
        if (is_array($status) && !empty($status)) {
            echo json_encode($status, JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(array('status' => $status, 'msg' => $msg), JSON_UNESCAPED_UNICODE);
        }
        exit();
    }

}
