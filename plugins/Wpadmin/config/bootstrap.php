<?php

/**
 * Encoding     :   UTF-8
 * Created on   :   2015-12-26 22:58:51 by allen <blog.rc5j.cn> , caowenpeng1990@126.com
 */
require dirname(__FILE__) . '/function.php';  //引入全局函数文件

use Cake\Event\Event;
use Cake\Event\EventManager;
use Cake\Database\Type\TimeType;
use Cake\I18n\Time;

//TimeType::$dateTimeClass = 'Admin\I18n\DateOnly';
Time::setJsonEncodeFormat('yyyy-MM-dd HH:mm:ss');
if (PHP_SAPI === 'cli') {
    // Attach bake events here.
    EventManager::instance()->on(
            'Bake.beforeRender.Controller.controller', function (Event $event) {
        $view = $event->subject();
//        if(strpos('Admin.', $view->viewVars['plugin'])!==FALSE){
        if(strtolower($view->theme)=='wpadmin'){
            // add the login and logout actions to the Users controller
            $view->viewVars['actions'] = [
                'index',
                'view',
                'add',
                'edit',
                'delete',
                'getDataList',
                'exportExcel',
            ];
        }
//        if ($view->viewVars['name'] == 'Admin') {
    }
//    }
    );
}