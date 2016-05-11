<?php

namespace App\Controller\Mobile;

use App\Controller\Mobile\AppController;

/**
 * Meet Controller  专家约见栏目
 *
 * @property \App\Model\Table\UserTable $User Description
 */
class MeetController extends AppController {
    
    
    public function initialize() {
        parent::initialize();
        $this->loadModel('User');
    }

    /**
     * Index method  专家约见首页
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {

    }
    
    /**
     * 大咖推荐
     */
    public function meetReco(){
        $dakas = $this->User->find()
                ->hydrate(false)
                ->select(['id','truename','company','position','meet_nums','avatar'])
                ->where("`level`= '2' and `enabled` = '1'")
                ->orderDesc('meet_nums')
                ->toArray();
        $this->set([
            'dakas'=>  json_encode($dakas)
        ]);
    }

    /**
     * View method
     *
     * @param string|null $id Meet id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $meet = $this->Meet->get($id, [
            'contain' => []
        ]);

        $this->set('meet', $meet);
        $this->set('_serialize', ['meet']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $meet = $this->Meet->newEntity();
        if ($this->request->is('post')) {
            $meet = $this->Meet->patchEntity($meet, $this->request->data);
            if ($this->Meet->save($meet)) {
                $this->Flash->success(__('The meet has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The meet could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('meet'));
        $this->set('_serialize', ['meet']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Meet id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $meet = $this->Meet->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $meet = $this->Meet->patchEntity($meet, $this->request->data);
            if ($this->Meet->save($meet)) {
                $this->Flash->success(__('The meet has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The meet could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('meet'));
        $this->set('_serialize', ['meet']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Meet id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $meet = $this->Meet->get($id);
        if ($this->Meet->delete($meet)) {
            $this->Flash->success(__('The meet has been deleted.'));
        } else {
            $this->Flash->error(__('The meet could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

}
