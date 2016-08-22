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
        $PvlogTable = \Cake\ORM\TableRegistry::get('Pvlog');
        $pv = $PvlogTable->newEntity($data);
        $pv->ip = $this->request->clientIp();
        $pv->url = $this->request->referer();
        $user = $this->request->session()->read('User.mobile');
        $pv->user_id = $user->id;
        $pv->useragent =  $this->request->header('User-Agent');
        $PvlogTable->save($pv);
        exit();
    }

}
