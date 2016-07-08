<?php

namespace App\Controller\Home;

use App\Controller\Home\AppController;

/**
 * User Controller
 *
 * @property \App\Model\Table\UserTable $User
 * @property \App\Controller\Component\HanvonComponent $Hanvon
 * @property \App\Controller\Component\SmsComponent $Sms
 * @property \App\Controller\Component\BusinessComponent $Business
 * @property \App\Controller\Component\WxComponent $Wx
 */
class IndexController extends AppController {
    
    public function index(){
        $user_id = $this->user->id;
        $userTbale = \Cake\ORM\TableRegistry::get('user');
        $user = $userTbale->get($user_id);
        $this->set([
            'pageTitle'=>$user->truename,
            'user' => $user
        ]);
    }
}