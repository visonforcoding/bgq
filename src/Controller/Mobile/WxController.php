<?php

namespace App\Controller\Mobile;

use App\Controller\Mobile\AppController;
use App\Utils\Weixin\WeixinSdk;
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
        echo $token;
        exit();
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
                $this->Util->ajaxReturn(true,'添加成功');
            } else {
                $errors = $user->errors();
                $this->Util->ajaxReturn(false,$errors);
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
            'pageTitle'=>'登录'
        ));
    }

}
