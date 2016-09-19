<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * SubjectBook Controller
 *
 * @property \App\Model\Table\SubjectBookTable $SubjectBook
 */
class SubjectBookController extends AppController {
    
    public function initialize() {
        parent::initialize();
        $this->SubjectBook = \Cake\ORM\TableRegistry::get('SubjectBook');
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->set('subjectBook', $this->SubjectBook);
    }

    /**
     * View method
     *
     * @param string|null $id Subject Book id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->autoLayout(false);
        $subjectBook = $this->SubjectBook->get($id, [
            'contain' => ['Subjects', 'Users', 'Savants', 'Lmorder', 'Usermsgs', 'BookChats']
        ]);
        $this->set('subjectBook', $subjectBook);
        $this->set('_serialize', ['subjectBook']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $subjectBook = $this->SubjectBook->newEntity();
        if ($this->request->is('post')) {
            $subjectBook = $this->SubjectBook->patchEntity($subjectBook, $this->request->data);
            if ($this->SubjectBook->save($subjectBook)) {
                $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $errors = $subjectBook->errors();
                $this->Util->ajaxReturn(['status' => false, 'msg' => getMessage($errors), 'errors' => $errors]);
            }
        }
        $subjects = $this->SubjectBook->Subjects->find('list', ['limit' => 200]);
        $users = $this->SubjectBook->Users->find('list', ['limit' => 200]);
        $savants = $this->SubjectBook->Savants->find('list', ['limit' => 200]);
        $this->set(compact('subjectBook', 'subjects', 'users', 'savants'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Subject Book id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $subjectBook = $this->SubjectBook->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['post', 'put'])) {
            $subjectBook = $this->SubjectBook->patchEntity($subjectBook, $this->request->data);
            if ($this->SubjectBook->save($subjectBook)) {
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $errors = $subjectBook->errors();
                $this->Util->ajaxReturn(false, getMessage($errors));
            }
        }
        $subjects = $this->SubjectBook->Subjects->find('list', ['limit' => 200]);
        $users = $this->SubjectBook->Users->find('list', ['limit' => 200]);
        $savants = $this->SubjectBook->Savants->find('list', ['limit' => 200]);
        $this->set(compact('subjectBook', 'subjects', 'users', 'savants'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Subject Book id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod('post');
        $id = $this->request->data('id');
        if ($this->request->is('post')) {
            $subjectBook = $this->SubjectBook->get($id);
            if ($this->SubjectBook->delete($subjectBook)) {
                $this->Util->ajaxReturn(true, '删除成功');
            } else {
                $errors = $subjectBook->errors();
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
        $sort = 'SubjectBook.' . $this->request->data('sidx');
        $order = $this->request->data('sord');
        $keywords = $this->request->data('keywords');
        $begin_time = $this->request->data('begin_time');
        $end_time = $this->request->data('end_time');
        $where = [];
        if (!empty($keywords)) {
            $where['or'] = [['Subjects.title like' => "%$keywords%"], ['Users.truename like' => "%$keywords%"], ['Savants.truename like' => "%$keywords%"]];
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(`create_time`) >' => $begin_time], ['date(`create_time`) <' => $end_time]];
        }
        $query = $this->SubjectBook->find();
        $query->hydrate(false);
        if (!empty($where)) {
            $query->where($where);
        }
        $query->contain(['Subjects', 'Users', 'Savants', 'Lmorder', 'Usermsgs', 'BookChats']);
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
        $sort = $this->request->query('sidx');
        $order = $this->request->query('sord');
        $keywords = $this->request->query('keywords');
        $begin_time = $this->request->query('begin_time');
        $end_time = $this->request->query('end_time');
        $where = [];
        if (!empty($keywords)) {
            $where['username like'] = "%$keywords%";
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(`create_time`) >' => $begin_time], ['date(`create_time`) <' => $end_time]];
        }
        $Table = $this->SubjectBook;
        $column = ['话题id', '用户id', '专家id', '需求简介', '0,未确认1确认通过2不予通过3完成', '专家标记是否已经完成约见', 'create_time', 'update_time'];
        $query = $Table->find();
        $query->hydrate(false);
        $query->select(['subject_id', 'user_id', 'savant_id', 'summary', 'status', 'is_done', 'create_time', 'update_time']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = 'SubjectBook_' . date('Y-m-d') . '.csv';
        \Wpadmin\Utils\Export::exportCsv($column, $res, $filename);
    }

}
