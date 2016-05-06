<?php

namespace App\Controller\Mobile;

use App\Controller\Mobile\AppController;
use App\Utils\Weixin\WeixinSdk;
use EasyWeChat\Foundation\Application as WXSDK;

/**
 * User Controller
 *
 * @property \App\Model\Table\UserTable $User
 * @property \App\Controller\Component\HanvonComponent $Hanvon
 */
class WxController extends AppController {
    
    
    public function initialize() {
        parent::initialize();
        $this->loadModel('User');
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function test() {
       $open_id = '123'; 
       $user = $this->User->findByWx_openid($open_id)->first();
       debug($user);die();
        $WeixinSdk = new WeixinSdk();
        $token = 'cwptest';
        $WeixinSdk->checkSignature($token);
    }

    /**
     * 授权登录/获取信息页  跳转页
     */
    public function getUserJump() {
        $wxconfig = \Cake\Core\Configure::read('weixin');
        $redirect_url = 'http://'.$_SERVER['SERVER_NAME'].'/mobile/wx/getUserCode';
        $wx_code_url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='
                . $wxconfig['appID'] . '&redirect_uri='.urlencode($redirect_url).'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
        $this->redirect($wx_code_url);
    }

    
    /***
     * 获取code->获取openid user 信息 业务处理
     */
    public function getUserCode() {
        $code = $this->request->query('code');
        $wxconfig = \Cake\Core\Configure::read('weixin');
        $httpClient = new \Cake\Network\Http\Client(['ssl_verify_peer'=>false]);
        $wx_accesstoken_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$wxconfig['appID'].'&secret='.$wxconfig['appsecret'].
                '&code='.$code.'&grant_type=authorization_code';
        //\Cake\Log\Log::debug($wx_accesstoken_url);
        $response = $httpClient->get($wx_accesstoken_url);
        if($response->isOk()){
           $open_id =  json_decode($response->body())->openid;
           //首次登录需有一个绑定平台操作
           $user = $this->User->findByWx_openid($open_id)->first();
           if($user){
               //存在则直接进入首页
              return $this->redirect(['controller'=>'index','action'=>'index']);
           }else{
              return  $this->redirect(['controller'=>'user','action'=>'wxBindPhone']);
           }
           $access_token =  json_decode($response->body())->access_token;
           $wx_user_url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$open_id.'&lang=zh_CN';
           $res = $httpClient->get($wx_user_url);
           if($res->isOk()){
               $userinfo = json_decode($res->body()); //微信用户信息
               $open_id = $userinfo->openid;
               //$headimgurl = $userinfo->headimgurl;
           }
        }
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $user = $this->User->get($id, [
            'contain' => ['Industries', 'Cities']
        ]);

        $this->set('user', $user);
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
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $user = $this->User->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->User->patchEntity($user, $this->request->data);
            if ($this->User->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $industries = $this->User->Industries->find('list', ['limit' => 200]);
        $cities = $this->User->Cities->find('list', ['limit' => 200]);
        $this->set(compact('user', 'industries', 'cities'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->User->get($id);
        if ($this->User->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * 用户登录
     */
    public function login() {
        $this->set(array(
            'pageTitle' => '登录'
        ));
    }

}
