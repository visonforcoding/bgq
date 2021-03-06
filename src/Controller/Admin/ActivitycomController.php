<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * Activitycom Controller
 *
 * @property \App\Model\Table\ActivitycomTable $Activitycom
 */
class ActivitycomController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->set('activitycom', $this->Activitycom);
    }

    /**
     * View method
     *
     * @param string|null $id Activitycom id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->autoLayout(false);
        $activitycom = $this->Activitycom->get($id, [
            'contain' => ['Activities', 'Users', 'Replyusers', 'Likes']
        ]);
        $this->set('activitycom', $activitycom);
        $this->set('_serialize', ['activitycom']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $activitycom = $this->Activitycom->newEntity();
        if ($this->request->is('post')) {
            $activitycom = $this->Activitycom->patchEntity($activitycom, $this->request->data);
            if ($this->Activitycom->save($activitycom)) {
                $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $errors = $activitycom->errors();
                $this->Util->ajaxReturn(['status' => false, 'msg' => getMessage($errors), 'errors' => $errors]);
            }
        }
        $activities = $this->Activitycom->Activities->find('list', ['limit' => 200]);
        $users = $this->Activitycom->Users->find('list', ['limit' => 200]);
        $replyusers = $this->Activitycom->Replyusers->find('list', ['limit' => 200]);
        $this->set(compact('activitycom', 'activities', 'users', 'replyusers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Activitycom id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $activitycom = $this->Activitycom->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['post', 'put'])) {
            $activitycom = $this->Activitycom->patchEntity($activitycom, $this->request->data);
            if ($this->Activitycom->save($activitycom)) {
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $errors = $activitycom->errors();
                $this->Util->ajaxReturn(false, getMessage($errors));
            }
        }
        $activities = $this->Activitycom->Activities->find('list', ['limit' => 200]);
        $users = $this->Activitycom->Users->find('list', ['limit' => 200]);
        $replyusers = $this->Activitycom->Replyusers->find('list', ['limit' => 200]);
        $this->set(compact('activitycom', 'activities', 'users', 'replyusers'));
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
        $sort = 'Activitycom.' . $this->request->data('sidx');
        $order = $this->request->data('sord');
        $keywords = $this->request->data('keywords');
        $begin_time = $this->request->data('begin_time');
        $end_time = $this->request->data('end_time');
        $where = ['Activitycom.is_delete'=>0];
        if (!empty($keywords)) {
            $where['Activitycom.body like'] = "%$keywords%";
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(`ctime`) >' => $begin_time], ['date(`ctime`) <' => $end_time]];
        }
        $user_id = $this->request->data('user_id');
        if ($user_id) {
            $where['Activitycom.user_id'] = $user_id;
        }
        $query = $this->Activitycom->find();
        $query->hydrate(false);
        if (!empty($where)) {
            $query->where($where);
        }
        $nums = $query->count();
        $query->contain(['Activities', 'Users', 'Replyusers', 'Likes']);
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
            $where['body like'] = "%$keywords%";
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(`ctime`) >' => $begin_time], ['date(`ctime`) <' => $end_time]];
        }
        $user_id = $this->request->data('user_id');
        if ($user_id) {
            $where['Activitycom.user_id'] = $user_id;
        }
        $Table = $this->Activitycom;
        $column = ['用户id', '活动id', '评论内容', '点赞数', '评论时间', 'å›žå¤ç”¨æˆ·id', '¸¸id'];
        $query = $Table->find();
        $query->hydrate(false);
        $query->select(['user_id', 'activity_id', 'body', 'praise_nums', 'create_time', 'reply_id', 'pid']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = 'Activitycom_' . date('Y-m-d') . '.csv';
        \Wpadmin\Utils\Export::exportCsv($column, $res, $filename);
    }

    /**
     * 回复评论
     * @return type
     */
    public function reply($id) {
        if ($this->request->is('post')) {
            $body = $this->request->data('reply');
            $ActivitycomTable = \Cake\ORM\TableRegistry::get('Activitycom');
            $lastcom = $ActivitycomTable->get($id);
            $reply = [
                'user_id' => -1, //并购帮官方用户
                'activity_id' => $lastcom->activity_id,
                'body' => $body,
                'reply_id' => $lastcom->user_id,
                'pid' => $lastcom->id,
            ];
            $newscom = $ActivitycomTable->newEntity();
            $newscom = $ActivitycomTable->patchEntity($newscom, $reply);
            $res = $ActivitycomTable->save($newscom);
            if ($res) {
                $ActivityTable = \Cake\ORM\TableRegistry::get('Activity');
                $news = $ActivityTable->get($newscom->activity_id);
                $news->comment_nums += 1;
                $ActivityTable->save($news);
                return $this->Util->ajaxReturn(true, '回复成功');
            } else {
                return $this->Util->ajaxReturn(false, '回复失败');
            }
        }
    }

    /**
     * 评论的删除
     * @return type
     */
    public function delete() {
        if ($this->request->is('post')) {
            $id = $this->request->data('id');
            $ActivitycomTable = \Cake\ORM\TableRegistry::get('Activitycom');
            $com = $ActivitycomTable->get($id);
            $com->is_delete = 1;  //假删除处理
            if ($ActivitycomTable->save($com)) {
                $ActivityTable = \Cake\ORM\TableRegistry::get('Activity');
                $news = $ActivityTable->get($com->activity_id);
                $news->comment_nums -= 1;
                $ActivityTable->save($news);
                return $this->Util->ajaxReturn(true, '删除成功');
            } else {
                return $this->Util->ajaxReturn(false, '删除失败');
            }
        }
    }

}
