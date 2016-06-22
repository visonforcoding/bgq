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
            $activity->user_id = $this->_user->id;
            $activity->publisher = $this->_user->truename;
            if ($this->Activity->save($activity)) {
                return $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $errors = $activity->errors();
                return $this->Util->ajaxReturn(['status' => false, 'msg' => getMessage($errors), 'errors' => $errors]);
            }
        }
        $admins = $this->Activity->Admins->find('list', ['limit' => 200]);
        $regions = $this->Activity->Regions->find('list', ['limit' => 200]);
        $savants = $this->Activity->Savants->find('list', ['limit' => 200]);
        $industries = $this->Activity->Industries->find()->hydrate(false)->all()->toArray();
        $industries = \Wpadmin\Utils\Util::tree($industries, 0, 'id', 'pid');
        
        $this->set(compact('activity', 'admins', 'industries', 'regions', 'savants'));
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
            'contain' => ['Industries', 'Savants'],
        ]);
        if ($this->request->is(['post', 'put'])) {
            $activity = $this->Activity->patchEntity($activity, $this->request->data);
            if ($this->Activity->save($activity)) {
                return $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $errors = $activity->errors();
                return $this->Util->ajaxReturn(false, getMessage($errors));
            }
        }
        $admins = $this->Activity->Admins->find('list', ['limit' => 200]);
        $industries = $this->Activity->Industries->find('list', ['limit' => 200]);
        $regions = $this->Activity->Regions->find('list', ['limit' => 200]);
        $this->set(compact('activity', 'admins', 'industries', 'regions'));
        $selSavantIds = [];
        if($activity->savants)
        {
            foreach ($activity->savants as $savant)
            {
                $selSavantIds[] = $savant->id;
            }
        }
        foreach ($activity->industries as $industry) {
            $selIndustryIds[] = $industry->id;
        }
        $this->set(compact('activity', 'selIndustryIds', 'selSavantIds'));
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
                return $this->Util->ajaxReturn(true, '删除成功');
            } else {
                $errors = $activity->errors();
                return $this->Util->ajaxReturn(true, getMessage($errors));
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
        $sort = 'Activity.' . $this->request->data('sidx');
        $order = $this->request->data('sord');
        $keywords = $this->request->data('keywords');
        $begin_time = $this->request->data('begin_time');
        $end_time = $this->request->data('end_time');
        $where = [];
        if (!empty($keywords)) {
            $where['OR'] = [
                ['users.`truename` like' => "%$keywords%"],
                ['activity.`title` like' => "%$keywords%"],
                ['activity.`company` like' => "%$keywords%"],
                ['activity.`address` like' => "%$keywords%"],
            ];
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['activity.`create_time` >' => $begin_time], ['activity.`create_time` <' => $end_time]];
        }
        $query = $this->Activity->find()->contain(['Users']);
        $query->hydrate(false);
        if (!empty($where)) {
            $query->where($where);
        }
        $nums = $query->count();
        $query->contain(['Industries', 'Regions']);

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

    /**
     * 置顶操作
     * @param int $id 活动id
     */
    public function top($id) {
        $activity = $this->Activity->get($id);
        $activity->is_top = 1;
        $res = $this->Activity->save($activity);
        if ($res) {
            return $this->Util->ajaxReturn(true, '置顶成功');
        } else {
            return $this->Util->ajaxReturn(false, '置顶失败');
        }
    }

    /**
     * 取消置顶操作
     * @param int $id 活动id
     */
    public function untop($id) {
        $activity = $this->Activity->get($id);
        $activity->is_top = 0;
        $res = $this->Activity->save($activity);
        if ($res) {
            return $this->Util->ajaxReturn(true, '取消置顶成功');
        } else {
            return $this->Util->ajaxReturn(false, '取消置顶失败');
        }
    }

    /**
     * 发布活动操作
     * @param int $id 活动id
     */
    public function release($id) {
        $activity = $this->Activity->get($id);
        $activity->is_check = 1;
        $res = $this->Activity->save($activity);
        if(!$res)
        {
            return $this->Util->ajaxReturn(false, '发布失败');
        }
        $folder = WWW_ROOT.'/upload/qrcode/activitycode/'.date('Y-m-d');
        if(!file_exists($folder))
        {
            $res = mkdir($folder);
        }
        if(!$res)
        {
            return $this->Util->ajaxReturn(false, '系统错误');
        }
        $savePath = $folder.'/'.time().$id.'.png';
        \PHPQRCode\QRcode::png('http://m.chinamatop.com/activity/sign/'.$id, $savePath);
        return $this->Util->ajaxReturn(true, '发布成功');
    }

    /**
     * 审核不通过操作
     * @param int $id 活动id
     */
    public function unrelease($id) {
        $data = $this->request->data();
        $activity = $this->Activity->get($id);
        $activity->is_check = 2;
        $activity->reason = $data['reason'];
        $res = $this->Activity->save($activity);
        if ($res) {
            return $this->Util->ajaxReturn(true, '操作成功');
        } else {
            return $this->Util->ajaxReturn(false, '操作失败');
        }
    }

}
