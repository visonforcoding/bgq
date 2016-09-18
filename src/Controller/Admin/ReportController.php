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
        if ($user) {
            $pv->user_id = $user->id;
        }
        $pv->useragent = $this->request->header('User-Agent');
        $PvlogTable->save($pv);
        exit();
    }

    protected function isAndroid($ua) {
        return preg_match('/Android/i', $ua);
    }

    protected function isIphone($ua) {
        return preg_match('/iPhone/i', $ua);
    }

    protected function isApp($ua) {
        return preg_match('/smartlemon/i', $ua);
    }

    protected function isWeixin($ua) {
        return preg_match('/MicroMessenger/i', $ua);
    }
    protected function osVersion($ua) {
        return preg_match('/(?:Android|iPhone\sOS)\s([0-9_\.]+)/i', $ua,$matches)?$matches[1]:'';
    }

    /**
     * 设备检测
     */
    public function deviceCheck() {
        set_time_limit(0);
        $PvlogTable = \Cake\ORM\TableRegistry::get('Pvlog');
        $pvlogs = $PvlogTable->find()->toArray();
        debug($pvlogs);
        foreach ($pvlogs as $pv) {
            if($this->isApp($pv->useragent)){
                $pv->is_app = 1;
            }
            if($this->isWeixin($pv->useragent)){
                $pv->is_app = 2;
            }
            if($this->isAndroid($pv->useragent)){
                $pv->os = 2;
            }
            if($this->isIphone($pv->useragent)){
                $pv->os = 1;
            }
            $pv->os_version = $this->osVersion($pv->useragent);
            debug($PvlogTable->save($pv));
        }
        exit();
    }

}
