<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * Candidate Controller  应聘者管理
 *
 * @property \App\Model\Table\CandidateTable $Candidate
 */
class CandidateController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index($id = null) {
        if ($id) {
            $this->set([
                'job_id' => $id
            ]);
        }
        $this->set('candidate', $this->Candidate);
    }

    /**
     * View method
     *
     * @param string|null $id Candidate id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->autoLayout(false);
        $candidate = $this->Candidate->get($id, [
            'contain' => ['Job']
        ]);
        $this->set('candidate', $candidate);
        $this->set('_serialize', ['candidate']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $candidate = $this->Candidate->newEntity();
        if ($this->request->is('post')) {
            $candidate = $this->Candidate->patchEntity($candidate, $this->request->data);
            if ($this->Candidate->save($candidate)) {
                $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $errors = $candidate->errors();
                $this->Util->ajaxReturn(['status' => false, 'msg' => getMessage($errors), 'errors' => $errors]);
            }
        }
        $this->set(compact('candidate'));
    }

    /**
     * Edit method 
     *
     * @param string|null $id Candidate id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $candidate = $this->Candidate->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['post', 'put'])) {
            $candidate = $this->Candidate->patchEntity($candidate, $this->request->data);
            if ($this->Candidate->save($candidate)) {
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $errors = $candidate->errors();
                $this->Util->ajaxReturn(false, getMessage($errors));
            }
        }
        $this->set(compact('candidate'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Candidate id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod('post');
        $id = $this->request->data('id');
        if ($this->request->is('post')) {
            $candidate = $this->Candidate->get($id);
            if ($this->Candidate->delete($candidate)) {
                $this->Util->ajaxReturn(true, '删除成功');
            } else {
                $errors = $candidate->errors();
                $this->Util->ajaxReturn(true, getMessage($errors));
            }
        }
    }

    /**
     * get jqgrid data 
     *
     * @return json
     */
    public function getDataList($id = null) {
        $this->request->allowMethod('ajax');
        $page = $this->request->data('page');
        $rows = $this->request->data('rows');
        $sort = 'Candidate.' . $this->request->data('sidx');
        $order = $this->request->data('sord');
        $keywords = $this->request->data('keywords');
        $begin_time = $this->request->data('begin_time');
        $end_time = $this->request->data('end_time');
        $where = [];
        if ($id) {
            $where['job_id'] = $id;
        }
        if (!empty($keywords)) {
              $where['or'] = [['Candidate.truename like' => "%$keywords%"], ['Job.company like' => "%$keywords%"],['Job.position like' => "%$keywords%"]];
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(Candidate.`create_time`) >' => $begin_time], ['date(Candidate.`create_time`) <' => $end_time]];
        }
        $query = $this->Candidate->find();
        $query->hydrate(false);
        if (!empty($where)) {
            $query->where($where);
        }
        $query->contain(['Job']);
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
    public function exportExcel($id=null) {
        $sort = $this->request->data('sidx');
        $order = $this->request->data('sord');
        $keywords = $this->request->data('keywords');
        $begin_time = $this->request->data('begin_time');
        $end_time = $this->request->data('end_time');
        $where = [];
        if ($id) {
            $where['job_id'] = $id;
        }
        if (!empty($keywords)) {
            $where[' username like'] = "%$keywords%";
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(`ctime`) >' => $begin_time], ['date(`ctime`) <' => $end_time]];
        }
        $Table = $this->Candidate;
        $column = ['应聘公司','应聘职位', '姓名', '生日', '电话', '邮箱', '地址', '工作经历', '教育经历', '期望薪水', '创建时间'];
        $query = $Table->find();
        $query->contain(['Job']);
        $query->hydrate(false);
        $query->select(['company'=>'Job.company','position'=>'Job.position', 'truename', 'birthday', 'phone', 'email', 'address', 'career', 'education', 'salary', 'create_time']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = '应聘数据' . date('Y-m-d') . '.xls';
          $this->loadComponent('Export');
        $this->Export->phpexcelExport($filename, $column, $res);
    }

}
