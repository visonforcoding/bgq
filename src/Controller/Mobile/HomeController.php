<?php

namespace App\Controller\Mobile;

use App\Controller\Mobile\AppController;

/**
 * Home Controller  个人中心
 *
 * @property \App\Model\Table\HomeTable $Home
 * @property \App\Model\Table\UserTable $User
 */
class HomeController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadModel('User');
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $user_id = $this->user->id;
        $user = $this->User->get($user_id);
        $this->set(compact('user'));
    }

}
