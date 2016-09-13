<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * Word Controller
 *
 * @property \App\Model\Table\WordTable $Word
 */
class WordController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->set('word', $this->Word);
    }

    /**
     * View method
     *
     * @param string|null $id Word id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->autoLayout(false);
        $word = $this->Word->get($id, [
            'contain' => []
        ]);
        $this->set('word', $word);
        $this->set('_serialize', ['word']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $word = $this->Word->newEntity();
        if ($this->request->is('post')) {
            $word = $this->Word->patchEntity($word, $this->request->data);
            if ($this->Word->save($word)) {
                \Cake\Cache\Cache::delete('wordpatt','redis');
                $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $errors = $word->errors();
                $this->Util->ajaxReturn(['status' => false, 'msg' => getMessage($errors), 'errors' => $errors]);
            }
        }
        $this->set(compact('word'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Word id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $word = $this->Word->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['post', 'put'])) {
            $word = $this->Word->patchEntity($word, $this->request->data);
            if ($this->Word->save($word)) {
                \Cake\Cache\Cache::delete('wordpatt','redis');
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $errors = $word->errors();
                $this->Util->ajaxReturn(false, getMessage($errors));
            }
        }
        $this->set(compact('word'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Word id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod('post');
        $id = $this->request->data('id');
        if ($this->request->is('post')) {
            $word = $this->Word->get($id);
            if ($this->Word->delete($word)) {
                \Cake\Cache\Cache::delete('wordpatt','redis');
                $this->Util->ajaxReturn(true, '删除成功');
            } else {
                $errors = $word->errors();
                $this->Util->ajaxReturn(true, getMessage($errors));
            }
        }
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
        $sort = 'Word.' . $this->request->data('sidx');
        $order = $this->request->data('sord');
        $keywords = $this->request->data('keywords');
        $begin_time = $this->request->data('begin_time');
        $end_time = $this->request->data('end_time');
        $where = [];
        if (!empty($keywords)) {
            $where['body like'] = "%$keywords%";
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(`create_time`) >' => $begin_time], ['date(`create_time`) <' => $end_time]];
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
        $sort = $this->request->query('sidx');
        $order = $this->request->query('sord');
        $keywords = $this->request->query('keywords');
        $begin_time = $this->request->query('begin_time');
        $end_time = $this->request->query('end_time');
        $where = [];
        if (!empty($keywords)) {
            $where['body like'] = "%$keywords%";
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(`create_time`) >' => $begin_time], ['date(`create_time`) <' => $end_time]];
        }
        $Table = $this->Word;
        $column = ['body'];
        $query = $Table->find();
        $query->hydrate(false);
        $query->select(['body']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = 'Word_' . date('Y-m-d') . '.csv';
        \Wpadmin\Utils\Export::exportCsv($column, $res, $filename);
    }

}
