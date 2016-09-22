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
        foreach ($data as $key => $value) {
            if (!in_array($key, ['screen', 'refer', 'act', 'ptag', 'ip', 'url', 'urlmap', 'user_id',
                        'is_app', 'os', 'os_version', 'useragent'])) {
                unset($data[$key]);
            }
        }
        $cookie = $this->request->cookies;
        $PvlogTable = \Cake\ORM\TableRegistry::get('Pvlog');
        $pv = $PvlogTable->newEntity($data);
        if (!isset($data['ptag'])) {
            $pv->ptag = 0;
        }
        $pv->ip = $this->request->clientIp();
        $pv->url = $this->request->referer();
        $pregres = preg_match('/(.*)\?/', $pv->url, $matches);
        $url = $pv->url;
        if ($pregres) {
            $url = $matches[1];
        }
        $redis = new \Redis();
        $redis_conf = \Cake\Core\Configure::read('redis_server');
        $redis->connect($redis_conf['host'], $redis_conf['port']);
        if ($redis->hExists('urlmap', $url)) {
            //查询是否resis 中有映射
            $pv->urlmap = $redis->hGet('urlmap', $url);
        } else {
            //如果没有 则 生成 存入数据库 并写入 redis
            $UrlmapTable = \Cake\ORM\TableRegistry::get('Urlmap');
            $urlmap = $UrlmapTable->newEntity([
                'url' => $url,
                'map' => uniqid()
            ]);
            if ($UrlmapTable->save($urlmap)) {
                $redis->hSet('urlmap', $url, $urlmap->map);
            }
            $pv->urlmap = $urlmap->map;
        }
        $user = $this->request->session()->read('User.mobile');
        $pv->user_id = 0;
        if ($user) {
            $pv->user_id = $user->id;
        }
        $pv->is_app = 3;
        $pv->useragent = $this->request->header('User-Agent');
        if ($this->isApp($pv->useragent)) {
            $pv->is_app = 1;
        }
        if ($this->isWeixin($pv->useragent)) {
            $pv->is_app = 2;
        }
        $pv->os = 3;
        if ($this->isAndroid($pv->useragent)) {
            $pv->os = 2;
        }
        if ($this->isIphone($pv->useragent)) {
            $pv->os = 1;
        }
        $pv->os_version = $this->osVersion($pv->useragent);
        $pv->create_time = date('Y-m-d H:i:s');
        $pvdata = $pv->toArray();
        $pvdata_str = serialize($pvdata);
        $redis->rPush('pvlog', $pvdata_str); //缓冲进redis 队列
        $datas = [];
        $size = $redis->lSize('pvlog');
        $pvlog_conf = \Cake\Core\Configure::read('pvlog');
        $store_nums = $pvlog_conf['store_nums'];
        if ($size >= $store_nums) {
            //队列 中 达到 指定数目 则 转存入 mysql
            $records = $redis->lrange('pvlog', 0, $size-1);
            foreach ($records as $record) {
                $datas[] = unserialize($record);
            }
        }
        if ($datas) {
            $query = $PvlogTable->query()->insert(['screen', 'refer', 'act', 'ptag', 'ip', 'url', 'urlmap', 'user_id',
                'is_app', 'os', 'os_version', 'useragent','create_time']);
            foreach ($datas as $k => $value) {
                $query->values($value);
            }
            $ins = $query->execute();
            if ($ins) {
                //插入成功则 删除掉已保存 队列元素
                $redis->ltrim('pvlog', $size, -1);
            }else{
                //出错 警报
            }
        }
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

    public function initData() {
        set_time_limit(0);
        $PvlogTable = \Cake\ORM\TableRegistry::get('Pvlog');
        $flag = 100000;
        $pvlog = $PvlogTable->find()->where(['url !=' => ''])->order('rand()')->first();
        $data['ip'] = $pvlog->ip;
        $data['screen'] = $pvlog->screen;
        $data['refer'] = $pvlog->refer;
        $data['url'] = $pvlog->url;
        $data['act'] = $pvlog->act;
        $data['os'] = $pvlog->os;
        $data['is_app'] = $pvlog->is_app;
        $data['os_version'] = $pvlog->os_version;
        $data['useragent'] = $pvlog->useragent;
        while ($flag > 0) {
            $flag--;
            $newpv = $PvlogTable->newEntity($data);
            $PvlogTable->save($newpv);
        }
        exit();
    }

}
