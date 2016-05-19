<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * Activity Controller
 *
 * @property \App\Model\Table\ActivityTable $Activity
 */
class ActivityController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->set('activity', $this->Activity);
    }

    /**
     * View method
     *
     * @param string|null $id Activity id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->autoLayout(false);
        $activity = $this->Activity->get($id, [
            'contain' => ['Users', 'Industries']
        ]);
        $this->set('activity', $activity);
        $this->set('_serialize', ['activity']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $activity = $this->Activity->newEntity();
        if ($this->request->is('post')) {
            $activity = $this->Activity->patchEntity($activity, $this->request->data);
            $activity->admin_id = $this->_user->id;
            $activity->publisher = $this->_user->truename;
            if ($this->Activity->save($activity)) {
                $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $errors = $activity->errors();
                $this->Util->ajaxReturn(['status' => false, 'msg' => getMessage($errors), 'errors' => $errors]);
            }
        }
        $admins = $this->Activity->Admins->find('list', ['limit' => 200]);
        $industries = $this->Activity->Industries->find()->hydrate(false)->all()->toArray();
        $industries = \Wpadmin\Utils\Util::tree($industries, 0, 'id', 'pid');
        $this->set(compact('activity', 'admins', 'industries'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Activity id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $activity = $this->Activity->get($id, [
            'contain' => ['Industries']
        ]);
        if ($this->request->is(['post', 'put'])) {
            $activity = $this->Activity->patchEntity($activity, $this->request->data);
            if ($this->Activity->save($activity)) {
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $errors = $activity->errors();
                $this->Util->ajaxReturn(false, getMessage($errors));
            }
        }
        $admins = $this->Activity->Admins->find('list', ['limit' => 200]);
        $industries = $this->Activity->Industries->find('list', ['limit' => 200]);
        $this->set(compact('activity', 'admins', 'industries'));
        foreach($activity->industries as $industry){
        	$selIndustryIds[] = $industry->id;
        }
        $this->set(compact('activity','selIndustryIds'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Activity id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod('post');
        $id = $this->request->data('id');
        if ($this->request->is('post')) {
            $activity = $this->Activity->get($id);
            if ($this->Activity->delete($activity)) {
                $this->Util->ajaxReturn(true, '删除成功');
            } else {
                $errors = $activity->errors();
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
        $sort = 'activity.' . $this->request->data('sidx');
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
        $query = $this->Activity->find();
        $query->hydrate(false);
        if (!empty($where)) {
            $query->where($where);
        }
        $nums = $query->count();
        $query->contain(['Admins', 'Industries']);
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
        $Table = $this->Activity;
        $column = ['作者id', '标签id', '主办单位', '活动名称', '活动时间（3.2~4.1）', '地点', '规模', '阅读数', '点赞数', '评论数', '封面', '活动内容', '摘要', '创建时间', '更新时间'];
        $query = $Table->find();
        $query->hydrate(false);
        $query->select(['admin_id', 'industry_id', 'company', 'title', 'time', 'address', 'scale', 'read_nums', 'praise_nums', 'comment_nums', 'cover', 'body', 'summary', 'create_time', 'update_time']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = 'Activity_' . date('Y-m-d') . '.csv';
        \Wpadmin\Utils\Export::exportCsv($column, $res, $filename);
    }

    public function top($id){
    	$activity = $this->Activity->get($id);
    	$activity->is_top = 1;
    	$res = $this->Activity->save($activity);
    	if($res)
    	{
    		$this->Util->ajaxReturn(true, '置顶成功');
    	}
    	else
    	{
    		$this->Util->ajaxReturn(false, '置顶失败');
    	}
    }
    
    public function untop($id)
    {
    	$activity = $this->Activity->get($id);
    	$activity->is_top = 0;
    	$res = $this->Activity->save($activity);
    	if($res)
    	{
    		$this->Util->ajaxReturn(true, '取消置顶成功');
    	}
    	else
    	{
    		$this->Util->ajaxReturn(false, '取消置顶失败');
    	}
    }
    
}
