<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * Articles Controller
 *
 * @property \App\Model\Table\ArticlesTable $Articles
 */
class ArticlesController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->set('articles', $this->Articles);
    }

    /**
     * View method
     *
     * @param string|null $id Article id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->autoLayout(false);
        $article = $this->Articles->get($id, [
            'contain' => []
        ]);
        $this->set('article', $article);
        $this->set('_serialize', ['article']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $article = $this->Articles->newEntity();
        if ($this->request->is('post')) {
            $this->autoRender = false;
            $this->response->type('json');
            $article = $this->Articles->patchEntity($article, $this->request->data);
            if ($this->Articles->save($article)) {
                echo json_encode(array('status' => true, 'msg' => '添加成功'));
            } else {
                $errors = $article->errors();
                echo json_encode(array('status' => false, 'msg' => getMessage($errors), 'errors' => $errors));
            }
            return;
        }
        $this->set(compact('article'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Article id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $article = $this->Articles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['post', 'put'])) {
            $this->autoRender = false;
            $this->response->type('json');
            $article = $this->Articles->patchEntity($article, $this->request->data);
            if ($this->Articles->save($article)) {
                echo json_encode(array('status' => true, 'msg' => '修改成功'));
            } else {
                $errors = $article->errors();
                echo json_encode(array('status' => false, 'msg' => getMessage($errors)));
            }
            return;
        }
        $this->set(compact('article'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Article id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod('post');
        $id = $this->request->data('id');
        if ($this->request->is('post')) {
            $this->autoRender = false;
            $this->response->type('json');
            $article = $this->Articles->get($id);
            if ($this->Articles->delete($article)) {
                echo json_encode(array('status' => true, 'msg' => '删除成功'));
            } else {
                $errors = $article->errors();
                echo json_encode(array('status' => false, 'msg' => getMessage($errors)));
            }
        }
        return;
    }

    /**
     * get jqgrid data 
     *
     * @return json
     */
    public function getDataList() {
        $this->request->allowMethod('ajax');
        $page = $this->request->data('page');
        $rows = $this->request->data('rows');
        $sort = $this->request->data('sidx');
        $order = $this->request->data('sord');
        $keywords = $this->request->data('keywords');
        $begin_time = $this->request->data('begin_time');
        $end_time = $this->request->data('end_time');
        $where = [];
        if (!empty($keywords)) {
            $where[' username like'] = "%$keywords%";
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(`ctime`) >' => $begin_time], ['date(`ctime`) <' => $end_time]];
        }
        $data = $this->getJsonForJqrid($page, $rows, '', $sort, $order, $where);
        $this->autoRender = false;
        $this->response->type('json');
        echo json_encode($data);
    }

    /**
     * export csv
     *
     * @return csv 
     */
    public function exportExcel() {
        $sort = $this->request->data('sidx');
        $order = $this->request->data('sord');
        $keywords = $this->request->data('keywords');
        $begin_time = $this->request->data('begin_time');
        $end_time = $this->request->data('end_time');
        $where = [];
        if (!empty($keywords)) {
            $where[' username like'] = "%$keywords%";
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(`ctime`) >' => $begin_time], ['date(`ctime`) <' => $end_time]];
        }
        $Table = $this->Articles;
        $column = ['title', 'body', 'created', 'modified'];
        $query = $Table->find();
        $query->hydrate(false);
        $query->select(['title', 'body', 'created', 'modified']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = 'Articles_' . date('Y-m-d') . '.csv';
        \Admin\Utils\Export::exportCsv($column, $res, $filename);
    }

}
