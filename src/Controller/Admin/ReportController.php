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
        debug($this->request);
                exit();
        $user = $this->request->session()->read('User.mobile');
        if ($user) {
            $pv->user_id = $user->id;
        }
        if ($this->isApp($pv->useragent)) {
            $pv->is_app = 1;
        }
        if ($this->isWeixin($pv->useragent)) {
            $pv->is_app = 2;
        }
        if ($this->isAndroid($pv->useragent)) {
            $pv->os = 2;
        }
        if ($this->isIphone($pv->useragent)) {
            $pv->os = 1;
        }
        $pv->os_version = $this->osVersion($pv->useragent);
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
        return preg_match('/(?:Android|iPhone\sOS)\s([0-9_\.]+)/i', $ua, $matches) ? $matches[1] : '';
    }

    /**
     * 设备检测
     */
    public function deviceCheck() {
        set_time_limit(0);
        $PvlogTable = \Cake\ORM\TableRegistry::get('Pvlog');
        $pvlogs = $PvlogTable->find()->toArray();
        foreach ($pvlogs as $pv) {
            if ($this->isApp($pv->useragent)) {
                $pv->is_app = 1;
            }
            if ($this->isWeixin($pv->useragent)) {
                $pv->is_app = 2;
            }
            if ($this->isAndroid($pv->useragent)) {
                $pv->os = 2;
            }
            if ($this->isIphone($pv->useragent)) {
                $pv->os = 1;
            }
            $pv->os_version = $this->osVersion($pv->useragent);
            $PvlogTable->save($pv);
        }
    }
    
    public function initData(){
        set_time_limit(0);
        $PvlogTable = \Cake\ORM\TableRegistry::get('Pvlog');
        $flag = 100000;
        $pvlog = $PvlogTable->find()->where(['url !='=>''])->order('rand()')->first();
        $data['ip']=$pvlog->ip;
        $data['screen']=$pvlog->screen;
        $data['refer']=$pvlog->refer;
        $data['url']=$pvlog->url;
        $data['act']=$pvlog->act;
        $data['os']=$pvlog->os;
        $data['is_app']=$pvlog->is_app;
        $data['os_version']=$pvlog->os_version;
        $data['useragent']=$pvlog->useragent;
        while ($flag>0){
            $flag--;
            $newpv = $PvlogTable->newEntity($data);
            $PvlogTable->save($newpv);
        }
                exit();
    }

}
