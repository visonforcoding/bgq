<?php

namespace App\Controller\Home;

use App\Controller\Home\AppController;
use Cake\Mailer\Email;

/**
 * User Controller
 *
 * @property \App\Model\Table\ActivityTable $Activity
 * @property \App\Controller\Component\HanvonComponent $Hanvon
 * @property \App\Controller\Component\SmsComponent $Sms
 * @property \App\Controller\Component\BusinessComponent $Business
 * @property \App\Controller\Component\WxComponent $Wx
 */
class ActivityController extends AppController {
    
    public function release(){
        $activity = $this->Activity->newEntity();
        $data = [];
        if($this->request->is('post')){
            $data['company'] = $this->request->data('company');
            $data['scale'] = $this->request->data('scale');
            $data['title'] = $this->request->data('title');
            $data['time'] = $this->request->data('time');
            $data['summary'] = $this->request->data('summary');
            $data['address'] = $this->request->data('address');
            $data['body'] = $this->request->data('body');
            $data['from_user'] = -1;
            $activity = $this->Activity->patchEntity($activity, $data);
            $res = $this->Activity->save($activity);
            if($res){
                return $this->Util->ajaxReturn(true, '提交成功，请下载APP查看');
            } else {
                return $this->Util->ajaxReturn(false, '系统错误');
            }
        }
        
        $userTable = \Cake\ORM\TableRegistry::get('user');
        $industryTable = \Cake\ORM\TableRegistry::get('industry');
        $user = $userTable->get($this->user->id);
        $series = \Cake\Core\Configure::read('activitySeries');
        $industries = $industryTable->find()->where(['pid !='=>0])->toArray();
        $this->set([
            'pageTitle'=>'发布活动',
            'user' => $user,
            'series' => $series,
            'industries' => $industries,
            'activity' => $activity
        ]);
    }
}