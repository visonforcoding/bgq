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

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function test() {
        $WeixinSdk = new WeixinSdk();
        $token = 'cwptest';
        $WeixinSdk->checkSignature($token);
    }

    public function getUserJump() {
        $wxconfig = \Cake\Core\Configure::read('weixin');
        $redirect_url = 'http://'.$_SERVER['SERVER_NAME'].'/mobile/wx/getUserCode';
        $wx_code_url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='
                . $wxconfig['appID'] . '&redirect_uri='.urlencode($redirect_url).'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
        $this->redirect($wx_code_url);
    }

    public function getUserCode() {
        $code = $this->request->query('code');
        $wxconfig = \Cake\Core\Configure::read('weixin');
        $httpClient = new \Cake\Network\Http\Client(['ssl_verify_peer'=>false]);
        $wx_accesstoken_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$wxconfig['appID'].'&secret='.$wxconfig['appsecret'].
                '&code='.$code.'&grant_type=authorization_code';
        //\Cake\Log\Log::debug($wx_accesstoken_url);
        $response = $httpClient->get($wx_accesstoken_url);
        if($response->isOk()){
           $access_token =  json_decode($response->body())->access_token;
           $open_id =  json_decode($response->body())->openid;
           $wx_user_url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$open_id.'&lang=zh_CN';
           $res = $httpClient->get($wx_user_url);
           if($res->isOk()){
               var_dump($res->body());
           }
        }
        exit();
        $options = [
            'debug' => true,
            'app_id' => $wxconfig['appID'],
            'secret' => $wxconfig['appsecret'],
            'token' => $wxconfig['token'],
            // 'aes_key' => null, // 可选
            'log' => [
                'level' => 'debug',
                'file' => LOGS . '/logs/easywechat.log', // XXX: 绝对路径！！！！
            ],
                //...
        ];
        $WXSDK = new WXSDK($options);
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
