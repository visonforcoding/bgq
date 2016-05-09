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
            'contain' => ['Industries']
        ];
        $user = $this->paginate($this->User);

        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * 注册 选择行业标签
     * 
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function registerBusiness() {
        $reg_phone = $this->request->session()->read('reg.phone');
        if (!$reg_phone) {
            $this->redirect('/user/register');
        }
        if ($this->request->isPost()) {
            $user = $this->User->findByPhone($reg_phone)->first();
            if ($user) {
                $data = $this->request->data();
                $data['enabled'] = 1;
                $user = $this->User->patchEntity($user, $data);
                if ($this->User->save($user)) {
                    //注册成功就算登录
                    $this->request->session()->write('User.mobile', $user);
                    $this->Util->ajaxReturn(['status' => true, 'url' => '/user/index']);
                } else {
                    $this->Util->ajaxReturn(['status' => false, 'msg' => '服务器出错']);
                }
            }
            return;
        }
        $IndustryTable = \Cake\ORM\TableRegistry::get('industry');
        $industries = $IndustryTable->find('threaded', [
                    'keyField' => 'id',
                    'parentField' => 'pid'
                ])->where("`id` != '3'")->hydrate(false)->toArray();
        $this->set(array(
            'industries' => $industries
        ));
    }

    /**
     * 注册行业机构  注册第二步
     * 
     */
    public function registerOrg() {
        $reg_phone = $this->request->session()->read('reg.phone');
        if (!$reg_phone) {
            $this->redirect('/user/register');
        }
        if ($this->request->isPost()) {
            $user = $this->User->findByPhone($reg_phone)->first();
            if ($user) {
                $user->agency_id = $this->request->data('agency');
                if ($this->User->save($user)) {
                    $this->request->session()->write('reg.step', 'two');
                    $this->Util->ajaxReturn(['status' => true, 'url' => '/user/register-business']);
                } else {
                    $this->Util->ajaxReturn(['status' => false, 'msg' => '服务器出错']);
                }
            }
            return;
        }
        $AgencyTable = \Cake\ORM\TableRegistry::get('agency');
        $agencies = $AgencyTable->find('threaded', [
                    'keyField' => 'id',
                    'parentField' => 'pid'
                ])->hydrate(false)->toArray();
        $this->set(array(
            'agencies' => $agencies
        ));
    }

    /**
     * 注册首页 第一步
     */
    public function register() {
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->User->newEntity();
            $data = $this->request->data();
            $data['enabled'] = 0;
            \Cake\Log\Log::debug($this->request->session()->read('reg.wx_bind'));
            \Cake\Log\Log::debug($this->request->session()->check('reg.wx_openid'));
            if ($this->request->session()->read('reg.wx_bind') && $this->request->session()->check('reg.wx_openid')) {
            \Cake\Log\Log::debug($this->request->session()->read('reg.wx_openid'));
                //第一次微信登录的完善信息
                $data['wx_openid'] = $this->request->session()->read('reg.wx_oepnid');
            }
            debug($data);exit();
            debug($this->request->session()->read('reg.wx_oepnid'));exit();
            $user = $this->User->patchEntity($user, $data);
            if ($this->User->save($user)) {
                //session 记录 注册手机号 和 注册步骤
                $this->request->session()->write([
                    'reg.phone' => $user->phone,
                    'reg.step' => 'one',
                ]);
                $this->Util->ajaxReturn(['status' => true, 'url' => '/user/register-org']);
            } else {
                $errors = $user->errors();
                $this->Util->ajaxReturn(['status' => false, 'msg' => getMessage($errors)]);
            }
        }
    }

    /**
     * 处理识别名片
     */
    public function recogMp() {
        $this->loadComponent('Hanvon');
        $path = $this->request->data('path');
        $file = ROOT . '/webroot' . $path;
        $res = $this->Hanvon->handMpByJuhe($file);
        $response = [];
        if ($res) {
            $response['status'] = true;
            $response['result'] = $res;
        } else {
            $response['status'] = false;
        }
        $this->Util->ajaxReturn($response);
    }

    /**
     * 用户登录
     */
    public function login() {
        if ($this->request->is(['patch', 'post', 'put'])) {
            $phone = $this->request->data('phone');
            $user = $this->User->findByPhoneAndEnabled($phone, 1)->first();
            if ($user) {
                $vcode = $this->request->session()->read('UserLoginVcode');
                if ($vcode['code'] == $this->request->data('vcode')) {
                    if (time() - $vcode['time'] < 60 * 10) {
                        //10分钟验证码超时
                        $this->request->session()->write('User.mobile', $user);
                        $this->Util->ajaxReturn(['status' => true]);
                    } else {
                        $this->Util->ajaxReturn(false, '验证码已过期，请重新获取');
                    }
                } else {
                    $this->Util->ajaxReturn(false, '验证码验证错误');
                }
            } else {
                $this->Util->ajaxReturn(['status' => false, 'msg' => '该手机号未注册或不可用']);
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
    public function sendVcode() {
        $this->loadComponent('Sms');
        $mobile = $this->request->data('phone');
        $code = createRandomCode(4, 2); //创建随机验证码
        $content = '您的动态验证码为' . $code;
        $codeTable = \Cake\ORM\TableRegistry::get('smsmsg');
        $vcode = $codeTable->find()->where("`phone` = '$mobile'")->orderDesc('create_time')->first();
        if (empty($vcode) || (time() - strtotime($vcode['time'])) > 30) {
            //30s 的间隔时间
            $ckSms = $this->Sms->sendByQf106($mobile, $content, $code);
            if ($ckSms) {
                $this->request->session()->write('UserLoginVcode', ['code' => $code, 'time' => time()]);
                $this->Util->ajaxReturn(true, '发送成功');
            }
        } else {
            $this->Util->ajaxReturn(false, '30s后再发送');
        }
    }

    /**
     * 微信绑定页
     */
    public function wxBindPhone() {
        $open_id = $this->request->session()->read('reg.wx_openid');
        if (!$open_id) {
            throw new Exception('非法操作');
            //交互待处理
        }
        if ($this->request->isPost()) {
            $phone = $this->request->data('phone');
            $user = $this->User->findByPhoneAndEnabled($phone, 1)->first();
            $vcode = $this->request->session()->read('UserLoginVcode');
            if ($vcode['code'] != $this->request->data('vcode')) {
                $this->Util->ajaxReturn(false, '验证码验证错误');
            }
            if (time() - $vcode['time'] < 60 * 10) {
                //10分钟验证码超时
                if ($user) {
                    //注册过 绑定 并登录
                    $user->wx_openid = $open_id;
                    if ($this->User->save($user)) {
                        $this->request->session()->write('User.mobile', $user);
                        $this->Util->ajaxReturn(['status' => true]);
                    } else {
                        $this->Util->ajaxReturn(false, '服务器出错');
                    }
                }else{
                    //注册完善信息
                    $this->request->session()->write('reg.wx_bind',true);
                    $this->Util->ajaxReturn(['status'=>false,'msg'=>'您还未有平台账户需前往完善信息','url'=>'/user/register?type=wx_bind']);
                }
            } else {
                $this->Util->ajaxReturn(false, '验证码已过期，请重新获取');
            }
        }
    }

}
