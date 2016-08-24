<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * BookChat Controller
 *
 * @property \App\Model\Table\BookChatTable $BookChat
 */
class BookChatController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->set('bookChat', $this->BookChat);
    }

    /**
     * View method
     *
     * @param string|null $id Book Chat id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->autoLayout(false);
        
        $bookChat = $this->BookChat->get($id, [
            'contain' => ['Users', 'ReplyUsers', 'SubjectBooks']
        ]);
        $this->set('bookChat', $bookChat);
        $this->set('_serialize', ['bookChat']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $bookChat = $this->BookChat->newEntity();
        if ($this->request->is('post')) {
            $bookChat = $this->BookChat->patchEntity($bookChat, $this->request->data);
            if ($this->BookChat->save($bookChat)) {
                $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $errors = $bookChat->errors();
                $this->Util->ajaxReturn(['status' => false, 'msg' => getMessage($errors), 'errors' => $errors]);
            }
        }
        $users = $this->BookChat->Users->find('list', ['limit' => 200]);
        $replyUsers = $this->BookChat->ReplyUsers->find('list', ['limit' => 200]);
        $subjectBooks = $this->BookChat->SubjectBooks->find('list', ['limit' => 200]);
        $this->set(compact('bookChat', 'users', 'replyUsers', 'subjectBooks'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Book Chat id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $bookChat = $this->BookChat->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['post', 'put'])) {
            $bookChat = $this->BookChat->patchEntity($bookChat, $this->request->data);
            if ($this->BookChat->save($bookChat)) {
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $errors = $bookChat->errors();
                $this->Util->ajaxReturn(false, getMessage($errors));
            }
        }
        $users = $this->BookChat->Users->find('list', ['limit' => 200]);
        $replyUsers = $this->BookChat->ReplyUsers->find('list', ['limit' => 200]);
        $subjectBooks = $this->BookChat->SubjectBooks->find('list', ['limit' => 200]);
        $this->set(compact('bookChat', 'users', 'replyUsers', 'subjectBooks'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Book Chat id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod('post');
        $id = $this->request->data('id');
        if ($this->request->is('post')) {
            $bookChat = $this->BookChat->get($id);
            if ($this->BookChat->delete($bookChat)) {
                $this->Util->ajaxReturn(true, '删除成功');
            } else {
                $errors = $bookChat->errors();
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
        $BookTable = \Cake\ORM\TableRegistry::get('BookChat');
        $this->request->allowMethod('ajax');
        $page = $this->request->data('page');
        $rows = $this->request->data('rows');
        $sort = 'BookChat.' . $this->request->data('sidx');
        $order = $this->request->data('sord');
        $keywords = $this->request->data('keywords');
        $begin_time = $this->request->data('begin_time');
        $end_time = $this->request->data('end_time');
        $where = [];
        if (!empty($keywords)) {
            $where['content like'] = "%$keywords%";
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(`create_time`) >' => $begin_time], ['date(`create_time`) <' => $end_time]];
        }
        $query = $BookTable->find();
        $query->hydrate(false);
        if (!empty($where)) {
            $query->where($where);
        }
        $query->contain(['Users', 'ReplyUsers', 'SubjectBooks','SubjectBooks.Subjects']);
        $nums = $query->count();
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }

        $query->limit(intval($rows))
                ->page(intval($page));
        $res = $query->toArray();
        if (empty($res)) {
            $res = array();
        }
        if ($nums > 0) {
            $total_pages = ceil($nums / $rows);
        } else {
            $total_pages = 0;
        }
        $data = array('page' => $page, 'total' => $total_pages, 'records' => $nums, 'rows' => $res);
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
            $where['and'] = [['date(`create_time`) >' => $begin_time], ['date(`create_time`) <' => $end_time]];
        }
        $Table = $this->BookChat;
        $column = ['用户id', '回复用户id', '约见id', '内容', '创建时间'];
        $query = $Table->find();
        $query->hydrate(false);
        $query->select(['user_id', 'reply_id', 'book_id', 'content', 'create_time']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = 'BookChat_' . date('Y-m-d') . '.csv';
        \Wpadmin\Utils\Export::exportCsv($column, $res, $filename);
    }

}
