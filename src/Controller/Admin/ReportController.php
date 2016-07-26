<?php

/**
 * Encoding     :   UTF-8
 * Created on   :   2016-7-20 17:08:55 by caowenpeng , caowenpeng1990@126.com
 */

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * Index Controller  处理上报
 *
 * @property \App\Model\Table\IndexTable $Index
 * @property \App\Controller\Component\ChartComponent $Chart       
 */
class ReportController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->autoRender = FALSE;
    }

    public function logger() {
        $data = $this->request->query;
        $cookie = $this->request->cookies;
        \Cake\Log\Log::debug($data, 'devlog');
        \Cake\Log\Log::debug($cookie, 'devlog');
    }

}
