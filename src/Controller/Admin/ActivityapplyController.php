<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * Activityapply Controller
 *
 * @property \App\Model\Table\ActivityapplyTable $Activityapply
 * @property \App\Controller\Component\SmsComponent $Sms
 */
class ActivityapplyController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index($id = '') {
        $this->set('id', $id);
        if ($this->request->query('do')) {
            $this->set('do', 'check');
        }
        $ActivityTable = \Cake\ORM\TableRegistry::get('Activity');
        $activity = $ActivityTable->get($id);
        //活动报名人数 付款数 审核通过
        $pay_nums = $this->Activityapply->find()->contain(['Activities'])
                        ->where(['Activities.id' => $id, 'Activities.apply_fee >' => 0, 'is_pass' => 1])->count();
        $apply_nums = $this->Activityapply->find()->contain(['Activities'])
                        ->where(['Activities.id' => $id])->count();
        $check_nums = $this->Activityapply->find()->contain(['Activities'])
                        ->where(['Activities.id' => $id, 'Activityapply.is_check' => 1])->count();
        $this->set('PageHeader', $activity->title . '-活动报名管理');
        $this->set('activityapply', $this->Activityapply);
        $this->set([
            'pay_nums' => $pay_nums,
            'apply_nums' => $apply_nums,
            'check_nums' => $check_nums
        ]);
    }

    /**
     * View method
     *
     * @param string|null $id Activityapply id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->autoLayout(false);
        $activityapply = $this->Activityapply->get($id, [
            'contain' => ['Users', 'Activities']
        ]);
        $this->set('activityapply', $activityapply);
        $this->set('_serialize', ['activityapply']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $activityapply = $this->Activityapply->newEntity();
        if ($this->request->is('post')) {
            $activityapply = $this->Activityapply->patchEntity($activityapply, $this->request->data);
            if ($this->Activityapply->save($activityapply)) {
                $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $errors = $activityapply->errors();
                $this->Util->ajaxReturn(['status' => false, 'msg' => getMessage($errors), 'errors' => $errors]);
            }
        }
        $this->set(compact('activityapply'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Activityapply id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $activityapply = $this->Activityapply->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['post', 'put'])) {
            $activityapply = $this->Activityapply->patchEntity($activityapply, $this->request->data);
            if ($this->Activityapply->save($activityapply)) {
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $errors = $activityapply->errors();
                $this->Util->ajaxReturn(false, getMessage($errors));
            }
        }
        $this->set(compact('activityapply'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Activityapply id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod('post');
        $id = $this->request->data('id');
        if ($this->request->is('post')) {
            $activityapply = $this->Activityapply->get($id);
            if ($this->Activityapply->delete($activityapply)) {
                $this->Util->ajaxReturn(true, '删除成功');
            } else {
                $errors = $activityapply->errors();
                $this->Util->ajaxReturn(true, getMessage($errors));
            }
        }
    }

    /**
     * get jqgrid data 
     *
     * @return json
     */
    public function getDataList($id = '') {
        $this->request->allowMethod('ajax');
        $page = $this->request->data('page');
        $rows = $this->request->data('rows');
        $sort = 'Activityapply.' . $this->request->data('sidx');
        $order = $this->request->data('sord');
        $keywords = $this->request->data('keywords');
        $begin_time = $this->request->data('begin_time');
        $end_time = $this->request->data('end_time');
        $is_check = $this->request->data('is_check');
        $must_check = $this->request->data('must_check');
        $is_sign = $this->request->data('is_sign');
        $is_pay = $this->request->data('is_pay');
        $where = [];
        if (is_numeric($is_check)) {
            $where = ['Activityapply.is_check' => $is_check];
        }
        if ($this->request->query('do') == 'check' && $must_check === NULL) {
            $must_check = 1;
            $where = ['Activityapply.is_check' => 0];
        }
        if (!empty($keywords)) {
            $where['Users.truename like'] = "%$keywords%";
        }
        if (is_numeric($must_check)) {
            $where['Activities.must_check'] = $must_check;
        }
        if (is_numeric($is_pay)) {
            $where['Activityapply.is_pass'] = $is_pay;
        }
        if ($is_sign > -1) {
            $where['is_sign'] = $is_sign;
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['Activityapply.`create_time` >' => $begin_time], ['Activityapply.`create_time` <' => $end_time]];
        }
        if ($id) {
            $query = $this->Activityapply->find()->where(['activity_id' => $id]);
        } else {
            $query = $this->Activityapply->find();
        }
        $query->hydrate(false);
        if (!empty($where)) {
            $query->where($where);
        }
        $query->contain(['Users', 'Activities']);
        $nums = $query->count();
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $query->limit(intval($rows))->page(intval($page));
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
    public function exportExcel($id = null) {
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
            $where['and'] = [['date(`ctime`) >' => $begin_time], ['date(`ctime`) <' => $end_time]];
        }
        $is_sign = $this->request->query('is_sign');
        if ($is_sign > -1) {
            $where['is_sign'] = $is_sign;
        }
        $Table = $this->Activityapply;
        $column = ['用户', '公司', '职位', '手机号', '活动', '报名时间'];
        if ($id) {
            $query = $Table->find()->where(['activity_id' => $id]);
        } else {
            $query = $Table->find();
        }
        $query->hydrate(false);
        $query->contain(['Users', 'Activities']);
        $query->select(['user_truename' => 'Users.truename', 'user_company' => 'Users.company', 'user_position' => 'Users.position',
            'user_phone' => 'Users.phone', 'activity_title' => 'Activities.title', 'create_time']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = '活动报名' . date('Y-m-d') . '.csv';
        \Wpadmin\Utils\Export::exportCsv($column, $res, $filename);
    }

    /**
     * 置顶操作
     * @param int $id 活动id
     */
    public function top($id) {
        $activity = $this->Activityapply->get($id);
        $activity->is_top = 1;
        $res = $this->Activityapply->save($activity);
        if ($res) {
            $this->Util->ajaxReturn(true, '置顶成功');
        } else {
            $this->Util->ajaxReturn(false, '置顶失败');
        }
    }

    /**
     * 取消置顶操作
     * @param int $id 活动id
     */
    public function untop($id) {
        $activity = $this->Activityapply->get($id);
        $activity->is_top = 0;
        $res = $this->Activityapply->save($activity);
        if ($res) {
            $this->Util->ajaxReturn(true, '取消置顶成功');
        } else {
            $this->Util->ajaxReturn(false, '取消置顶失败');
        }
    }

    /**
     * 发布活动操作
     * @param int $id 活动id
     */
    public function pass($id) {
        $activity = $this->Activityapply->get($id);
        $activity->is_pass = 1;
        $res = $this->Activityapply->save($activity);
        if ($res) {
            $this->Util->ajaxReturn(true, '操作成功');
        } else {
            $this->Util->ajaxReturn(false, '操作失败');
        }
    }

    /**
     * 审核不通过操作
     * @param int $id 活动id
     */
    public function unpass($id) {
        $data = $this->request->data();
        $activity = $this->Activityapply->get($id);
        $activity->is_pass = 0;
        $res = $this->Activityapply->save($activity);
        if ($res) {
            $this->Util->ajaxReturn(true, '操作成功');
        } else {
            $this->Util->ajaxReturn(false, '操作失败');
        }
    }

    /**
     * 审核通过
     * @param type $id
     */
    public function check($id) {
        $apply = $this->Activityapply->get($id, [
            'contain' => 'Users'
        ]);
        $ActivityapplyTable = \Cake\ORM\TableRegistry::get('Activityapply');
        $ActivityTable = \Cake\ORM\TableRegistry::get('Activity');
        $activity = $ActivityTable->get($apply->activity_id);
        if ($activity->apply_fee == 0) {
            //无需付费的 直接通过
            $apply->is_pass = 1;
            $activity->apply_nums += 1;  //报名人数+1
        }
        $apply->is_check = 1;
        $apply->check_man = $this->_user->truename;
        $trans = $this->Activityapply->connection()->transactional(function()use($ActivityTable, $activity, $ActivityapplyTable, $apply) {
            return $ActivityapplyTable->save($apply) && $ActivityTable->save($activity);
        });
        if ($trans) {
            //消息
            $this->loadComponent('Business');
            $this->Business->usermsg($apply->user_id, '活动报名消息', '您报名的活动《' . $activity->title . '》已审核通过', 11, $id, '/activity/details/' . $activity->id);
            if ($activity->apply_fee > 0) {
                $this->loadComponent('Sms');
                $this->Sms->sendByQf106($apply->user->phone, '您报名的活动《' . $activity->title . '》已审核通过，请及时登录平台支付费用，并购帮祝您生活愉快~');
            }
            $this->Util->ajaxReturn(true, '操作成功');
        } else {
            $this->Util->ajaxReturn(false, '操作失败');
        }
    }

    /**
     * 审核不通过
     * @param type $id
     */
    public function uncheck($id) {
        $apply = $this->Activityapply->get($id);
        $apply->is_check = 2;
        $apply->check_man = $this->_user->truename;
        $res = $this->Activityapply->save($apply);
        if ($res) {
            //消息
            $ActivityTable = \Cake\ORM\TableRegistry::get('Activity');
            $activity = $ActivityTable->get($apply->activity_id);
            $this->loadComponent('Business');
            $this->Business->usermsg($apply->user_id, '活动报名消息', '您报名的活动《' . $activity->title . '》审核未通过', 11, $id, '/activity/details/' . $activity->id);
            $this->Util->ajaxReturn(true, '操作成功');
        } else {
            $this->Util->ajaxReturn(false, '操作失败');
        }
    }

    public function push($id=null) {
        $this->viewBuilder()->autoLayout(false);
        if ($this->request->is('post')) {
            $keywords = $this->request->query('keywords');
            $begin_time = $this->request->query('begin_time');
            $end_time = $this->request->query('end_time');
            $is_check = $this->request->query('is_check');
            $must_check = $this->request->query('must_check');
            $is_sign = $this->request->query('is_sign');
            $is_pay = $this->request->query('is_pay');
            $where = [];
            if (is_numeric($is_check)) {
                $where = ['Activityapply.is_check' => $is_check];
            }
            if ($this->request->query('do') == 'check' && $must_check === NULL) {
                $must_check = 1;
                $where = ['Activityapply.is_check' => 0];
            }
            if (!empty($keywords)) {
                $where['Users.truename like'] = "%$keywords%";
            }
            if (is_numeric($must_check)) {
                $where['Activities.must_check'] = $must_check;
            }
            if (is_numeric($is_pay)) {
                $where['Activityapply.is_pass'] = $is_pay;
            }
            if ($is_sign > -1) {
                $where['is_sign'] = $is_sign;
            }
            if (!empty($begin_time) && !empty($end_time)) {
                $begin_time = date('Y-m-d', strtotime($begin_time));
                $end_time = date('Y-m-d', strtotime($end_time));
                $where['and'] = [['Activityapply.`create_time` >' => $begin_time], ['Activityapply.`create_time` <' => $end_time]];
            }
            if ($id) {
                $query = $this->Activityapply->find()->where(['activity_id' => $id]);
            } else {
                $query = $this->Activityapply->find();
            }
            $query->select(['Users.user_token']);
            $query->hydrate(false);
            if (!empty($where)) {
                $query->where($where);
            }
            $query->contain(['Users', 'Activities']);
            $res = $query->toArray();
            $user = '';
            foreach ($res as $k => $v) {
                $user .= $v['Users']['user_token'] . "\n";
            }
            $this->loadComponent('Push');
            $title = $this->request->data('title');
            $content = $this->request->data('content');
            $url = $this->request->data('url');
            if ($url) {
                $extra['url'] = 'http://m.chinamatop.com' . $url;
                $push_res = $this->Push->sendFile($title, $content, $title, $user, 'BGB', true, $extra);
            } else {
                $push_res = $this->Push->sendFile($title, $content, $title, $user, 'BGB', true);
            }
            if ($push_res) {
                return $this->Util->ajaxReturn(true, '推送成功');
            } else {
                return $this->Util->ajaxReturn(false, '推送失败');
            }
        }
    }

}
