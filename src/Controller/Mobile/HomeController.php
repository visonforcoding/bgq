<?php

namespace App\Controller\Mobile;

use App\Controller\Mobile\AppController;

/**
 * Home Controller  个人中心
 *
 * @property \App\Model\Table\HomeTable $Home
 * @property \App\Model\Table\UserTable $User
 * @property \App\Controller\Component\BusinessComponent $Business
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

    /**
     * 我的活动 报名
     */
    public function myActivityApply() {
        
    }

    /**
     * 我的活动 发布
     */
    public function myActivitySubmit() {
        $ActivityTable = \Cake\ORM\TableRegistry::get('activity');
        $activities = $ActivityTable->findByUserId($this->user->id)->toArray();
        $this->set([
            'activities' => $activities
        ]);
    }

    /**
     * 实名认证
     */
    public function realnameAuth() {
        $user_id = $this->user->id;
        $user = $this->User->get($user_id);
        if ($this->request->is('post')) {
            $user = $this->User->patchEntity($user, $this->request->data());
            $user->status = 1; //实名状态改为未审核
            if ($this->User->save($user)) {
                $this->loadComponent('Business');
                $this->Business->adminmsg(1, $user_id, '您有一条实名认证申请需处理');
                $this->Util->ajaxReturn(true, '保存成功');
            } else {
                $this->Util->ajaxReturn(false, '保存失败');
            }
        }
        $this->set(compact('user'));
    }

    /**
     * 专家认证
     */
    public function savantAuth() {
        $user_id = $this->user->id;
        $user = $this->User->get($user_id);
        $UserTable = \Cake\ORM\TableRegistry::get('user');
        if ($this->request->is('post')) { 
            $SavantTable = \Cake\ORM\TableRegistry::get('savant');
            $savant = $SavantTable->newEntity();
            $savant->user_id = $user_id;
            $savant = $SavantTable->patchEntity($savant, $this->request->data());
            $user->savant_status = 2;
            $errorFlag = [];
            $this->User->connection()->transactional(function()use($SavantTable,$savant,$user,$UserTable,$errorFlag){
                //开启事务
                $errorFlag[] = $SavantTable->save($savant);
                $errorFlag[] = $UserTable->save($user);
            });
            if (!in_array(false, $errorFlag)) {
                $this->loadComponent('Business');
                $this->Business->adminmsg(1, $user_id, '您有一条专家认证申请需处理');
                $this->Util->ajaxReturn(true, '保存成功');
            } else {
                $this->Util->ajaxReturn(false, '保存失败');
            }
        }
        $this->set(compact('user'));
    }

}
