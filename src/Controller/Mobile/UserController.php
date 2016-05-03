<?php

namespace App\Controller\Mobile;

use App\Controller\Mobile\AppController;
use Cake\Mailer\Email;

/**
 * User Controller
 *
 * @property \App\Model\Table\UserTable $User
 * @property \App\Controller\Component\HanvonComponent $Hanvon
 * @property \App\Controller\Component\SmsComponent $Sms
 */
class UserController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $this->paginate = [
            'contain' => ['Industries', 'Cities']
        ];
        $user = $this->paginate($this->User);

        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function register() {
        //发邮件
        $user = $this->User->newEntity();
        if ($this->request->is('post')) {
            $user = $this->User->patchEntity($user, $this->request->data);
            if ($this->User->save($user)) {
                $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $errors = $user->errors();
                $this->Util->ajaxReturn(false, $errors);
            }
        }
//        $industries = $this->User->Industrie->find('list', ['limit' => 200]);
//        $cities = $this->User->Cities->find('list', ['limit' => 200]);
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * 用户登录
     */
    public function login() {
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->User->patchEntity($user, $this->request->data);
            if ($this->User->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(array(
            'pageTitle' => '登录'
        ));
    }

    /**
     * 检查手机号是否存在
     */
    public function ckUserPhoneExist() {
        if ($this->request->is(['patch', 'post', 'put'])) {
            $phone = $this->request->data('phone');
            $user = $this->User->findByPhoneAndEnabled($phone, 1)->first();
            if ($user) {
                $this->Util->ajaxReturn(['status' => true]);
            } else {
                $this->Util->ajaxReturn(['status' => false, 'msg' => '该手机号未注册或不可用']);
            }
        }
    }
    
    /**
     * 发送动态验证码
     */
    public function sendVcode(){
        $this->loadComponent('Sms');
        $mobile = $this->request->data('phone');
        $code = createRandomCode(4, 2); //创建随机验证码
        $content = '您的动态验证码为'.$code;
        $codeTable = \Cake\ORM\TableRegistry::get('smsmsg');
        $vcode = $codeTable->find()->where("`phone` = '$mobile'")->orderDesc('create_time')->first();
        if(empty($vcode)||(time()-$vcode['time'])>30){
            $ckSms = $this->Sms->sendByQf106($mobile,$content,$code);
            if($ckSms){
                $this->Util->ajaxReturn(true,'发送成功');
                $this->request->session()->write('UserLoginVcode', $value);
            }
        }else{
        }
    }

}
