<?php

/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller\Mobile;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 * @property \App\Controller\Component\UtilComponent $Util
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    /**
     * 无需验证登录的action
     * @var array 
     */
    private $firewall;
    protected $user;

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize() {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Util');
        //无需登录的
        $this->firewall = array(
            ['user', 'login'],
            ['user', 'register'],
            ['news', 'index'],
            ['news', 'view'],
        );
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event) {
        $this->viewBuilder()->layout('layout');
        $wxConfig = [];
        if($this->request->is('weixin')){
            $this->loadComponent('Wx');
            $wxConfig = $this->Wx->wxconfig(['onMenuShareTimeline','onMenuShareAppMessage','scanQRCode'],false);
        }
        $this->set(compact('wxConfig'));
    }

    public function beforeFilter(Event $event) {
        $this->user = $this->request->session()->read('User.mobile');
        \Cake\Log\Log::debug('cookie');
        \Cake\Log\Log::debug($this->request->cookie('login_token'));
        if(!$this->user&&$this->request->isLemon()){
            //debug($this->request->cookie('login_token'));
        }
        return $this->checkLogin();
    }
    

    /**
     * 检查用户登录
     * @return type
     */
    private function checkLogin() {
        $controller = strtolower($this->request->param('controller'));
        $action = strtolower($this->request->param('action'));
        $request_aim = [$controller, $action];
        if (in_array($request_aim, $this->firewall) || 
                in_array($controller, ['user', 'wx','news','activity','meet','pay','api'])) {
            return true;
        }
        return $this->handCheckLogin();
    }

    
    /**
     * 处理检测登陆
     * @return type
     */
    protected function handCheckLogin() {
        $user = $this->request->session()->check('User.mobile');
        $url = '/'.$this->request->url;
        if($this->request->isLemon()&&$this->request->cookie('token_uin')&&!$user){
            //如果是APP，获取user_token 自动登录
            $user_token = $this->request->cookie('token_uin');
            $UserTable = \Cake\ORM\TableRegistry::get('User');
            $user =  $UserTable->findByUser_tokenAndEnabled($user_token,1)->first();
            if($user){
                $this->request->session()->write('User.mobile', $user);
                $this->user = $this->request->session()->read('User.mobile');
            }
        }
        if (!$user) {
            if ($this->request->is('ajax')) {
                $url = $this->request->referer();
                $login_url = '/user/login?redirect_url='.$url;  //最好 url——encode一下,  先注意验证一下url带有问号参数的情况
                $this->autoRender = false;
                $this->response->type('json');
                $this->response->body(json_encode(['status' => false, 'msg' => '请先登录', 'code' => 403,'redirect_url'=>$login_url]));
                $this->response->send();
                return $this->response->stop();
            }
            $this->redirect('/user/login?redirect_url='.$url); //return $response object
            $this->response->send();
            return $this->response->stop();
            //header("location:".'/user/login');
        }
    }
    

}
