<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * Industry Controller
 *
 * @property \App\Model\Table\IndustryTable $Industry
 */
class AgencyController extends AppController {
    
    
    public function initialize() {
        parent::initialize();
        $this->Industry = \Cake\ORM\TableRegistry::get('Agency');
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $IndustryTable = \Cake\ORM\TableRegistry::get('Agency');
        $industries = $IndustryTable->find('threaded', [
                    'keyField' => 'id',
                    'parentField' => 'pid'
                ])->all()->toArray();
        $this->set([
            'industries'=>$industries
        ]);
    }

    /**
     * View method
     *
     * @param string|null $id Industry id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->autoLayout(false);
        $industry = $this->Industry->get($id, [
            'contain' => ['User']
        ]);
        $this->set('industry', $industry);
        $this->set('_serialize', ['industry']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $industry = $this->Industry->newEntity();
        if ($this->request->is('post')) {
            $this->autoRender = false;
            $this->response->type('json');
            $industry = $this->Industry->patchEntity($industry, $this->request->data);
            if ($this->Industry->save($industry)) {
                echo json_encode(array('status' => true, 'msg' => '添加成功'));
            } else {
                $errors = $industry->errors();
                echo json_encode(array('status' => false, 'msg' => getMessage($errors), 'errors' => $errors));
            }
            return;
        }
        $industrys = $this->Industry->find()->hydrate(false)->all()->toArray();
        $industrys = \Wpadmin\Utils\Util::tree($industrys, 0, 'id', 'pid');
        $this->set(compact('industry'));
        $this->set(compact('industrys'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Industry id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $industry = $this->Industry->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['post', 'put'])) {
            $this->autoRender = false;
            $this->response->type('json');
            $industry = $this->Industry->patchEntity($industry, $this->request->data);
            if ($this->Industry->save($industry)) {
                echo json_encode(array('status' => true, 'msg' => '修改成功'));
            } else {
                $errors = $industry->errors();
                echo json_encode(array('status' => false, 'msg' => getMessage($errors)));
            }
            return;
        }
        $industrys = $this->Industry->find()->hydrate(false)->all()->toArray();
        $industrys = \Wpadmin\Utils\Util::tree($industrys, 0, 'id', 'pid');

        $this->set(compact('industry'));
        $this->set(compact('industrys'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Industry id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod('post');
        $id = $this->request->data('id');
        if ($this->request->is('post')) {
            $this->autoRender = false;
            $this->response->type('json');
            $industry = $this->Industry->get($id);
            if ($this->Industry->delete($industry)) {
                echo json_encode(array('status' => true, 'msg' => '删除成功'));
            } else {
                $errors = $industry->errors();
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
        $sort = 'Industries.' . $this->request->data('sidx');
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
        $query = $this->Industry->find()->contain(['Industries']);
        $query->hydrate(false);
        if (!empty($where)) {
            $query->where($where);
        }
        $nums = $query->count();
        //$query->contain(['User']);
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
            $where['and'] = [['date(`ctime`) >' => $begin_time], ['date(`ctime`) <' => $end_time]];
        }
        $Table = $this->Industry;
        $column = ['父id', '名称'];
        $query = $Table->find();
        $query->hydrate(false);
        $query->select(['pid', 'name']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = 'Industry_' . date('Y-m-d') . '.csv';
        \Wpadmin\Utils\Export::exportCsv($column, $res, $filename);
    }

    /**
     * 为select2提供数据
     */
    public function getIndustryForSelect() {
        $keyword = $this->request->query('search');
        $query = $this->Industry->find('threaded', [
                    'keyField' => $this->Industry->primaryKey(),
                    'parentField' => 'pid'
                ])->hydrate(false)->select(['id', 'text' => 'name', 'pid']);
        if (!empty($keyword)) {
            $query->where("`name` like '%$keyword%'");
        }
        $industries = $query->toArray();
        if ($industries) {
            foreach ($industries as $key => $value) {
                if ($value['pid'] == 0) {
                    $industries[$key]['id'] = '';
                    unset($industries[$key]['pid']);
                }
            }
        }
        $this->Util->ajaxReturn($industries);
    }

}
