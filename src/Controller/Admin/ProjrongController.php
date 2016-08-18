<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * Projrong Controller
 *
 * @property \App\Model\Table\ProjrongTable $Projrong
 */
class ProjrongController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->set('projrong', $this->Projrong);
    }

    /**
     * View method
     *
     * @param string|null $id Projrong id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->autoLayout(false);
        $projrong = $this->Projrong->get($id, [
            'contain' => ['Users', 'Industries']
        ]);
        $this->set('projrong', $projrong);
        $this->set('_serialize', ['projrong']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $projrong = $this->Projrong->newEntity();
        if ($this->request->is('post')) {
            $projrong = $this->Projrong->patchEntity($projrong, $this->request->data);
            if ($this->Projrong->save($projrong)) {
                $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $errors = $projrong->errors();
                $this->Util->ajaxReturn(['status' => false, 'msg' => getMessage($errors), 'errors' => $errors]);
            }
        }
        $this->set(compact('projrong', 'tags'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Projrong id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $projrong = $this->Projrong->get($id, [
            'contain' => ['Industries','Attachs']
        ]);
        if ($this->request->is(['post', 'put'])) {
            $projrong = $this->Projrong->patchEntity($projrong, $this->request->data);
            if ($this->Projrong->save($projrong)) {
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $errors = $projrong->errors();
                $this->Util->ajaxReturn(false, getMessage($errors));
            }
        }
        $selIndustryIds = [];
        foreach ($projrong->industries as $industry) {
            $selIndustryIds[] = $industry->id;
        }
        $this->set(compact('projrong', 'users', 'selIndustryIds'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Projrong id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod('post');
        $id = $this->request->data('id');
        if ($this->request->is('post')) {
            $projrong = $this->Projrong->get($id);
            if ($this->Projrong->delete($projrong)) {
                $this->Util->ajaxReturn(true, '删除成功');
            } else {
                $errors = $projrong->errors();
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
        $sort = 'Projrong.' . $this->request->data('sidx');
        $order = $this->request->data('sord');
        $keywords = $this->request->data('keywords');
        $stage_id = $this->request->data('stage_id');
        $scale_id = $this->request->data('scale_id');
        $begin_time = $this->request->data('begin_time');
        $end_time = $this->request->data('end_time');
        $where = [];
        if (!empty($keywords)) {
              $where['or'] = [['title like' => "%$keywords%"], ['address like' => "%$keywords%"]];
        }
        if (!empty($stage_id)) {
            $where['stage_id'] = "$stage_id";
        }
        if (!empty($scale_id)) {
            $where['scale_id'] = "$scale_id";
        }
        if (!empty($begin_time) && !empty($end_time)) {
            //时间筛选
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(Projrong.`create_time`) >' => $begin_time], ['date(Projrong.`create_time`) <' => $end_time]];
        }
        $query = $this->Projrong->find();
        $query->hydrate(false);
        if (!empty($where)) {
            $query->where($where);
        }
        $nums = $query->count();
        $query->contain(['Stage', 'Scale', 'Users', 'Industries']);
        
        $industry = $this->request->data('industries');
        if (!empty($industry['_ids'][0])) {
            //过滤
            $query->matching('Industries', function($q)use($industry) {
                return $q->where(['Industries.id' => $industry['_ids'][0]]);
            });
        }
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
              $where['or'] = [['title like' => "%$keywords%"], ['address like' => "%$keywords%"]];
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(`create_time`) >' => $begin_time], ['date(`create_time`) <' => $end_time]];
        }
        $Table = $this->Projrong;
        $column = ['发布人id', '发布人', '公司', '项目名称', '融资阶段', '地点', '融资规模', '股份', '阅读数', '点赞数', '评论数', '封面', '活动内容', '项目简介', '公司简介', '核心团队', '资料地址', '创建时间', '更新时间'];
        $query = $Table->find();
        $query->hydrate(false);
        $query->select(['user_id', 'publisher', 'company', 'title', 'rzjd', 'address', 'scale', 'stock', 'read_nums', 'praise_nums', 'comment_nums', 'cover', 'body', 'summary', 'comp_desc', 'team', 'attach', 'create_time', 'update_time']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = 'Projrong_' . date('Y-m-d') . '.csv';
        \Wpadmin\Utils\Export::exportCsv($column, $res, $filename);
    }
    
    
    
    /**
     * 删除单个附件
     * @param type $id
     */
    public function delAttach($id){
        $AttachTable = \Cake\ORM\TableRegistry::get('Attach');
        $attatch = $AttachTable->get($id);
        if($AttachTable->delete($attatch)){
            $this->Util->ajaxReturn(true, '删除成功');
        }else{
            $this->Util->ajaxReturn(false,  errorMsg($attatch, '删除失败'));
        }
    }
    
    
    /**
     * 删除单个附件
     * @param type $id
     */
    public function viewAttach($id){
        $this->viewBuilder()->autoLayout(false);
        $AttachTable = \Cake\ORM\TableRegistry::get('Attach');
        $attatchs = $AttachTable->find()->where(['proj_id'=>$id])->toArray();
        $this->set([
            'items'=>$attatchs
        ]);
    }

}
