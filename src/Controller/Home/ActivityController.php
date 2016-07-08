<?php

namespace App\Controller\Home;

use App\Controller\Home\AppController;
use Cake\Mailer\Email;

/**
 * User Controller
 *
 * @property \App\Model\Table\UserTable $User
 * @property \App\Controller\Component\HanvonComponent $Hanvon
 * @property \App\Controller\Component\SmsComponent $Sms
 * @property \App\Controller\Component\BusinessComponent $Business
 * @property \App\Controller\Component\WxComponent $Wx
 */
class ActivityController extends AppController {
    
    public function release(){
        if($this->request->is('post')){
            
        }
    }
}