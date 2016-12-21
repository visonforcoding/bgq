<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * MentorSubscribe Controller
 *
 * @property \App\Model\Table\MentorSubscribeTable $MentorSubscribe
 */
class MentorSubscribeController extends AppController {
    
    public function initialize() {
        parent::initialize();
        $this->MentorSubscribe = \Cake\ORM\TableRegistry::get('MentorSubscribe');
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->set('mentorSubscribe', $this->MentorSubscribe);
    }

    /**
     * View method
     *
     * @param string|null $id Mentor Subscribe id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->autoLayout(false);
        $mentorSubscribe = $this->MentorSubscribe->get($id, [
            'contain' => ['Mentors']
        ]);
        $this->set('mentorSubscribe', $mentorSubscribe);
        $this->set('_serialize', ['mentorSubscribe']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $mentorSubscribe = $this->MentorSubscribe->newEntity();
        if ($this->request->is('post')) {
            $mentorSubscribe = $this->MentorSubscribe->patchEntity($mentorSubscribe, $this->request->data);
            if ($this->MentorSubscribe->save($mentorSubscribe)) {
                $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $errors = $mentorSubscribe->errors();
                $this->Util->ajaxReturn(['status' => false, 'msg' => getMessage($errors), 'errors' => $errors]);
            }
        }
        $mentors = $this->MentorSubscribe->Mentors->find('list', ['limit' => 200]);
        $this->set(compact('mentorSubscribe', 'mentors'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Mentor Subscribe id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $mentorSubscribe = $this->MentorSubscribe->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['post', 'put'])) {
            $mentorSubscribe = $this->MentorSubscribe->patchEntity($mentorSubscribe, $this->request->data);
            if ($this->MentorSubscribe->save($mentorSubscribe)) {
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $errors = $mentorSubscribe->errors();
                $this->Util->ajaxReturn(false, getMessage($errors));
            }
        }
        $mentors = $this->MentorSubscribe->Mentors->find('list', ['limit' => 200]);
        $this->set(compact('mentorSubscribe', 'mentors'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Mentor Subscribe id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod('post');
        $id = $this->request->data('id');
        if ($this->request->is('post')) {
            $mentorSubscribe = $this->MentorSubscribe->get($id);
            if ($this->MentorSubscribe->delete($mentorSubscribe)) {
                $this->Util->ajaxReturn(true, '删除成功');
            } else {
                $errors = $mentorSubscribe->errors();
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
        $sort = 'MentorSubscribe.' . $this->request->data('sidx');
        $order = $this->request->data('sord');
        $keywords = $this->request->data('keywords');
        $begin_time = $this->request->data('begin_time');
        $end_time = $this->request->data('end_time');
        $where = [];
        $where['MentorSubscribe.is_del'] = 0;
        if (!empty($keywords)) {
            $where['or'] = [
                'Mentors.name' => "%$keywords%",
                'Users.truename' => "%$keywords%"
            ];
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['MentorSubscribe.update_time >' => $begin_time], ['MentorSubscribe.update_time <' => $end_time]];
        }
        $query = $this->MentorSubscribe->find();
        $query->hydrate(false);
        if (!empty($where)) {
            $query->where($where);
        }
        $query->contain(['Mentors'=>function($q){
            return $q->where(['Mentors.is_del'=>0]);
        }, 'Users'=>function($q){
            return $q->where(['Users.enabled'=>1]);
        }]);
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
        $Table = $this->MentorSubscribe;
        $column = ['用户id', '导师id', '是否已取消订阅', '创建时间', '更新时间'];
        $query = $Table->find();
        $query->hydrate(false);
        $query->select(['uid', 'mentor_id', 'is_del', 'create_time', 'update_time']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = 'MentorSubscribe_' . date('Y-m-d') . '.csv';
        \Wpadmin\Utils\Export::exportCsv($column, $res, $filename);
    }

}
