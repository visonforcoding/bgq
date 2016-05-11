<?php

namespace App\Controller\Mobile;

use App\Controller\Mobile\AppController;

/**
 * News Controller  新闻
 *
 * @property \App\Model\Table\NewsTable $News
 */
class NewsController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $this->paginate = [
            'contain' => ['Admins','Industries']
        ];
        $news = $this->paginate($this->News);
        //获取资讯banner图
        $bannerTable = \Cake\ORM\TableRegistry::get('banner');
        $banners = $bannerTable->find()->where("`enabled` = '1' and `type` = '1'")
                ->orderDesc('create_time')->limit(3)->toArray();
//        debug($banners);exit();
        $this->set(compact('news','banners'));
        $this->set('newsjson',  json_encode($news));
    }

    /**
     * View method
     *
     * @param string|null $id News id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $news = $this->News->get($id, [
            'contain' => ['Admins','Comments']
        ]);
        $this->set('news', $news);
        $this->set('newsjson',  json_encode($news));
        $this->set('_serialize', ['news']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $news = $this->News->newEntity();
        if ($this->request->is('post')) {
            $news = $this->News->patchEntity($news, $this->request->data);
            if ($this->News->save($news)) {
                $this->Flash->success(__('The news has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The news could not be saved. Please, try again.'));
            }
        }
        $admins = $this->News->Admins->find('list', ['limit' => 200]);
        $this->set(compact('news', 'admins'));
        $this->set('_serialize', ['news']);
    }

    /**
     * Edit method
     *
     * @param string|null $id News id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $news = $this->News->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $news = $this->News->patchEntity($news, $this->request->data);
            if ($this->News->save($news)) {
                $this->Flash->success(__('The news has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The news could not be saved. Please, try again.'));
            }
        }
        $admins = $this->News->Admins->find('list', ['limit' => 200]);
        $this->set(compact('news', 'admins'));
        $this->set('_serialize', ['news']);
    }

    /**
     * Delete method
     *
     * @param string|null $id News id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $news = $this->News->get($id);
        if ($this->News->delete($news)) {
            $this->Flash->success(__('The news has been deleted.'));
        } else {
            $this->Flash->error(__('The news could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

}
