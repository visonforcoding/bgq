<?php

namespace Wpadmin\Controller;

use Wpadmin\Controller\AppController;

/**
 * Util Controller
 *
 * 
 */
class UtilController extends AppController {

    public function icon() {
        $iconFile = \Cake\Core\Plugin::path('Wpadmin') . '/config/icons.json';
        $iconJson = file_get_contents($iconFile);
        $iconArr = json_decode($iconJson,true);
        $this->viewBuilder()->autoLayout(false);
        $this->set('iconArr',$iconArr);
    }

}
