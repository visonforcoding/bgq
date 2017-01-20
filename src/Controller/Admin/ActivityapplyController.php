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
        $pay_nums = 0;
        $apply_nums = 0;
        $check_nums = 0;
        if($id){
            $activity = $ActivityTable->get($id);
            //活动报名人数 付款数 审核通过
            $pay_nums = $this->Activityapply->find()->contain(['Activities'])
                            ->where(['Activities.id' => $id, 'Activities.apply_fee >' => 0, 'is_pass' => 1])->count();
            $apply_nums = $this->Activityapply->find()->contain(['Activities'])
                            ->where(['Activities.id' => $id])->count();
            $check_nums = $this->Activityapply->find()->contain(['Activities'])
                            ->where(['Activities.id' => $id, 'Activityapply.is_check' => 1])->count();
            $this->set('PageHeader', $activity->title . '-活动报名管理');
        }
        $this->set('activityapply', $this->Activityapply);
        $this->set([
            'pay_nums' => $pay_nums,
            'apply_nums' => $apply_nums,
            'check_nums' => $check_nums,
            'activity_id' => $id
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
            'contain' => ['Companions']
        ]);
        $this->set('companions', $activityapply->companions);
        $this->set('_serialize', ['activityapply']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add($activity_id=null) {
        $activityapply = $this->Activityapply->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->data();
            if($this->Activityapply->find()->where(['user_id'=>$data['user_id'], 'activity_id'=>$activity_id])->first()){
                $this->Util->ajaxReturn(false, '此人已经报过名了');
            }
            $activityapply->user_id = $data['user_id'];
            $activityapply->activity_id = $activity_id;
            $activityapply->is_pass = 1;
            $activityapply->is_check = 1;
            $activityapply->is_top = $data['is_top'];
            $activityapply->check_man = $this->_user->truename;
            $ActivityTable = \Cake\ORM\TableRegistry::get('activity');
            $activity = $ActivityTable->get($activity_id);
            $activity->apply_nums += 1;
            $res = $this->Activityapply->connection()->transactional(function()use($ActivityTable, $activity, $activityapply){
                return $this->Activityapply->save($activityapply) && $ActivityTable->save($activity);
            });
            if ($res) {
                $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $errors = $activityapply->errors();
                $this->Util->ajaxReturn(['status' => false, 'msg' => getMessage($errors), 'errors' => $errors]);
            }
        }
        $this->set(compact('activityapply'));
        $this->set([
            'activity_id' => $activity_id
        ]);
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
        $where['triple_pid'] = 0;
        if (is_numeric($is_check)) {
            $where = ['Activityapply.is_check' => $is_check];
        }
        if ($this->request->query('do') == 'check' && $must_check === NULL) {
            $must_check = 1;
            $where = ['Activityapply.is_check' => 0];
        }
        if (!empty($keywords)) {
            $where['Activityapply.name like'] = "%$keywords%";
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
        $query->contain(['Users'=>function($q){
            return $q->select(['Users.id', 'Users.truename', 'Users.company', 'Users.position', 'Users.phone', 'Users.create_time']);
        }, 'Activities', 'OtherUsers'=>function($q){
            return $q->select(['OtherUsers.create_time']);
        }, 'Companions']);
        $nums = $query->count();
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
//        $query->limit(intval($rows))->page(intval($page));
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
            $where['Users.truename like'] = "%$keywords%";
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
        $column = ['用户', '公司', '职位', '手机号', '活动', '报名时间', '注册时间', '是否需审核','审核状态','报名状态','签到','置顶'];
        if ($id) {
            $query = $Table->find()->where(['activity_id' => $id]);
        } else {
            $query = $Table->find();
        }
        $query->hydrate(false);
        $query->contain(['Users', 'Activities']);
        $query->select(['user_truename' => 'Users.truename', 'user_company' => 'Users.company', 'user_position' => 'Users.position',
            'user_phone' => 'Users.phone', 'activity_title' => 'Activities.title', 'create_time', 'user_create_time' => 'Users.create_time',
            'must_check'=>'Activities.must_check','is_check','is_pass','is_sign','is_top']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $query->formatResults(function($items) {
            return $items->map(function($item) {
                        //时间语义化转换
                        $item['must_check'] = $item['must_check'] == '1' ? '是' : '否';
                        $item['is_check'] = $item['is_check'] == '1' ? '已审核' : '未审核';
                        $item['is_pass'] = $item['is_pass'] == '1' ? '通过' : '不通过';
                        $item['is_sign'] = $item['is_sign'] == '1' ? '是' : '否';
                        $item['is_top'] = $item['is_top'] == '1' ? '是' : '否';
                        return $item;
                    });
        });
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = '活动报名' . date('Y-m-d') . '.xls';
        $this->loadComponent('Export');
        $this->Export->phpexcelExport($filename, $column, $res);
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
     * 直接操作报名状态
     * @param int $id 活动id
     */
    public function pass($id) {
        $activityapply = $this->Activityapply->get($id, [
            'contain' => ['Companions', 'Activities']
        ]);
        if($activityapply->is_pass == 0){
            $activityapply->activity->apply_nums += (1 + count($activityapply->companions));
        } else {
            $activityapply->activity->apply_nums -= (1 + count($activityapply->companions));
        }
        foreach ($activityapply->companions as $k=>$v){
            $activityapply->companions[$k]['is_pass'] = $activityapply->is_pass ? 0 : 1;
            $activityapply->companions[$k]['is_check'] = $activityapply->is_pass ? 0 : 1;
            $activityapply->companions[$k]['check_man'] = $this->_user->truename;
        }
        if($activityapply->activity->must_check){
            $activityapply->is_check = $activityapply->is_pass ? 0 : 1;
        }
        $activityapply->is_pass = $activityapply->is_pass ? 0 : 1;
        $activityapply->dirty('activity', true);
        $activityapply->dirty('companions', true);
        $activityapply->check_man = $this->_user->truename;
        $res = $this->Activityapply->save($activityapply);
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
        $ActivityapplyTable = \Cake\ORM\TableRegistry::get('Activityapply');
        $apply = $ActivityapplyTable->get($id, [
            'contain' => ['Companions', 'Activities']
        ]);
        if ($apply->apply_fee == 0) {
            //无需付费的 直接通过
            $apply->is_pass = 1;
            if(!$apply->verify_code){
                $apply->verify_code = dec2s4($apply->id + 1000000000);
            }
            $apply->activity->apply_nums += (1 + count($apply->companions));  //报名人数+1
        }
        if($apply->companions){
            foreach ($apply->companions as $k=>$v){
                if ($apply->apply_fee == 0) {
                    $apply->companions[$k]->is_pass = 1;
                }
                $apply->companions[$k]->is_check = 1;
                $apply->companions[$k]->check_man = $this->_user->truename;
                if(!$apply->companions[$k]->verify_code){
                    $apply->companions[$k]->verify_code = dec2s4($apply->companions[$k]->id + 1000000000);
                }
            }
        }
        $apply->dirty('companions', true);
        $apply->dirty('activity', true);
        $apply->is_check = 1;
        $apply->check_man = $this->_user->truename;
        $trans = $ActivityapplyTable->save($apply);
        if ($trans) {
            //消息
            $this->loadComponent('Business');
            $this->loadComponent('Sms');
            $this->Business->usermsg('-1', $apply->user_id, '活动报名消息', '您报名的活动《' . $apply->activity->title . '》已审核通过', 11, $id, '/activity/details/' . $apply->activity->id);
            if ($apply->apply_fee > 0) {
                $sms_msg = '您报名的活动《' . $apply->activity->title . '》已审核通过，请及时登录平台支付费用，并购帮祝您生活愉快~';
                $this->Sms->sendByQf106($apply->phone, $sms_msg);
            } else {
                $apply = $ActivityapplyTable->get($id, [
                    'contain' => ['Companions']
                ]);
                foreach ($apply->companions as $k=>$v){
                    $this->Sms->sendByQf106($v->phone, '您报名的活动《' . $apply->activity->title . '》已审核通过！' . '您的签到码为：' . $v->verify_code);
                }
                $this->Sms->sendByQf106($apply->phone, '您报名的活动《' . $apply->activity->title . '》已审核通过！' . '您的签到码为：' . $apply->verify_code);
            }
            $this->Util->ajaxReturn(true, '操作成功');
        } else {
            $this->Util->ajaxReturn(false, '操作失败');
        }
    }
    
    
    public function resue($id) {
        $ActivityapplyTable = \Cake\ORM\TableRegistry::get('Activityapply');
        $apply = $ActivityapplyTable->get($id, [
            'contain' => ['Companions', 'Activities']
        ]);
        if($apply->activity->apply_nums >= 0){
            $apply->activity->apply_nums -= (1 + count($apply->companions));  //报名人数-1
        }
        $apply->is_pass = 0;
        if($apply->activity->must_check){
            $apply->is_check = 0;
        }
        $apply->check_man = $this->_user->truename;
        if($apply->companions){
            foreach ($apply->companions as $k=>$v){
                $apply->companions[$k]->is_pass = 0;
                if($apply->activity->must_check){
                    $apply->companions[$k]->is_check = 0;
                }
                $apply->companions[$k]->check_man = $this->_user->truename;
            }
        }
        $apply->dirty('companions', true);
        $trans = $ActivityapplyTable->save($apply);
        if($trans){
            $this->Util->ajaxReturn(true,'还原成功');
        }  else {
            $this->Util->ajaxReturn(true,'还原成功');
        }
    }

    /**
     * 审核不通过
     * @param type $id
     */
    public function uncheck($id) {
        $data = $this->request->data;
        $apply = $this->Activityapply->get($id, [
            'contain' => ['Companions', 'Activities', 'OtherUsers']
        ]);
        if($apply->companions){
            foreach($apply->companions as $k=>$v){
                $apply->companions[$k]['is_check'] = 2;
                $apply->companions[$k]['reason'] = $data['reason'];
                $apply->companions[$k]['check_man'] = $this->_user->truename;
            }
        }
        $apply->is_check = 2;
        $apply->reason = $data['reason'];
        $apply->check_man = $this->_user->truename;
        $apply->dirty('companions', true);
        $res = $this->Activityapply->save($apply);
        if ($res) {
            //消息
            $this->loadComponent('Business');
            $this->Business->usermsg('-1', $apply->other_user->id, '活动报名消息', '您报名的活动《' . $apply->activity->title . '》审核未通过, 理由为：' . $data['reason'], 11, $id, '/activity/details/' . $apply->activity->id);
            $this->Util->ajaxReturn(true, '操作成功');
        } else {
            $this->Util->ajaxReturn(false, '操作失败');
        }
    }

    public function push($id=null) {
        $this->viewBuilder()->autoLayout(false);
        if ($this->request->is('post')) {
//            $keywords = $this->request->data('keyword');
//            $begin_time = $this->request->data('begin_time');
//            $end_time = $this->request->data('end_time');
//            $is_check = $this->request->data('is_check');
//            $must_check = $this->request->data('must_check');
//            $is_sign = $this->request->data('is_sign');
//            $is_pay = $this->request->data('is_pay');
            $text = $this->request->data('text');
            $push = $this->request->data('push');
            $select_id = $this->request->data('select_id');
            if($select_id){
                $select_id = explode(',', $select_id);
            }
//            $where = [];
//            if (is_numeric($is_check)) {
//                $where = ['Activityapply.is_check' => $is_check];
//            }
//            if ($this->request->query('do') == 'check' && $must_check === NULL) {
//                $must_check = 1;
//                $where = ['Activityapply.is_check' => 0];
//            }
//            if (!empty($keywords)) {
//                $where['Users.truename like'] = "%$keywords%";
//            }
//            if (is_numeric($must_check)) {
//                $where['Activities.must_check'] = $must_check;
//            }
//            if (is_numeric($is_pay)) {
//                $where['Activityapply.is_pass'] = $is_pay;
//            }
//            if ($is_sign > -1) {
//                $where['is_sign'] = $is_sign;
//            }
//            if (!empty($begin_time) && !empty($end_time)) {
//                $begin_time = date('Y-m-d', strtotime($begin_time));
//                $end_time = date('Y-m-d', strtotime($end_time));
//                $where['and'] = [['Activityapply.`create_time` >' => $begin_time], ['Activityapply.`create_time` <' => $end_time]];
//            }
//            if ($id) {
//                $query = $this->Activityapply->find()->where(['activity_id' => $id]);
//            } else {
//                $query = $this->Activityapply->find();
//            }
            $title = $this->request->data('title');
            $content = $this->request->data('content');
            $url = $this->request->data('url');
            if ($url) {
                if(stripos($url, 'm.chinamatop.com') !== false){
                    $extra['url'] = $url;
                } else {
                    $extra['url'] = 'http://m.chinamatop.com' . $url;
                }
            } else {
                $extra = [];
            }
            $query = $this->Activityapply->find()->where(['Activityapply.id in'=>$select_id]);
            $query->select(['Users.user_token', 'Users.phone', 'Users.id', 'Users.truename']);
            $query->hydrate(false);
//            if (!empty($where)) {
//                $query->where($where);
//            }
            $query->contain(['Users', 'Activities']);
            $res = $query->toArray();
            
            $user = '';
            $mobile_arr = [];
            foreach ($res as $k => $v) {
                $user .= $v['Users']['user_token'] . "\n";
                $mobile_arr[]  = $v['Users']['phone'];
            }
            // 选择短信
            if($text !== 'false'){
                $this->loadComponent('Sms');
                $mobile = implode(',', $mobile_arr); 
                $text_res = $this->Sms->sendManyByQf106($mobile, $content);
            }
            // 选择推送
            if($push !== 'false'){
                $this->loadComponent('Push');
                $UsermsgTable = \Cake\ORM\TableRegistry::get('Usermsg');
                $usermsg = $UsermsgTable->query()->insert(['user_id', 'title', 'msg', 'url', 'create_time']);
                $data = [
                    'title' => $title,
                    'msg' => $content,
                    'url' => !empty($extra) ? $extra['url'] : 'javascript:void(0)',
                    'create_time' => date('Y-m-d H:i:s')
                ];
                foreach ($res as $k => $v) {
                    $uid[] = $v['Users']['id'];
                    $data['user_id'] = $v['Users']['id'];
                    $usermsg->values($data);
                }
                $push_res = $this->Push->sendFile($title, $content, $title, $user, 'BGB', true, $extra);
                if ($push_res) {
                    $is_success = 1;
                } else {
                    $is_success = 0;
                }
                $usermsg->execute();
                $Pushlog = \Cake\ORM\TableRegistry::get('Pushlog');
                $pushlog = $Pushlog->newEntity([
                    'push_id'=>'-1',
                    'get_message_uid' => serialize($uid),
                    'title'=>$title,
                    'body'=>$content,
                    'extra' => empty($extra) ? '' : $extra['url'],
                    'type'=>'3',
                    'remark'=>  $this->request->data('remark'),
                    'is_success' => $is_success,
                ]);
                $Pushlog->save($pushlog);
            }
            return $this->Util->ajaxReturn(true, '保存成功');
        }
    }
    

}
