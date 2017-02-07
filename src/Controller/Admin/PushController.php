<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * Rd Controller
 *
 * @property \App\Controller\Component\PushComponent $Push
 * @property \App\Controller\Component\SmsComponent $Sms
 */
class PushController extends AppController {
    
    public function initialize() {
        parent::initialize();
        $this->loadModel('User');
    }
    
    public function index(){
        $this->set('push', $this->Push);
    }
    
    public function getDataList() {
        $this->request->allowMethod('ajax');
        $page = $this->request->data('page');
        $rows = $this->request->data('rows');
//        $activity_id = $this->request->data('activity_id');
        $industry_id = $this->request->data('industry_id');
//        $type = $this->request->data('type');
        $sort = 'User.' . $this->request->data('sidx');
        $order = $this->request->data('sord');
        $keyword = $this->request->data('keyword');
        
        $where = ['enabled'=>1];
        if (!empty($keyword)) {
            $where['or'] = [['truename like' => "%$keyword%"], ['phone like' => "%$keyword%"]];
        }
//        if ($this->request->query('type') == '1') {
//            $where['status'] = 1;
//        }
        $query = $this->User->find();
        $query->hydrate(false);
        if (!empty($where)) {
            $query->where($where);
        }
        $nums = $query->count();
        if($industry_id === 'all'){
            
        } elseif($industry_id){
            $query->matching('UserIndustry', function($q)use($industry_id){
                return $q->where(['UserIndustry.industry_id' => $industry_id]);
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
     * 推送
     */
    public function doPush(){
        $title = $this->request->data('title');
//        $type = $this->request->data('type');
        $content = $this->request->data('content');
        $remark = $this->request->data('remark');
        $url = $this->request->data('url');
//        $choose = $this->request->data('choose');
//        $activity_id = $this->request->data('activity_id');
        $industry_id = $this->request->data('industry_id');
        $keyword = $this->request->data('keyword');
        $push = $this->request->data('push');
        $text = $this->request->data('text');
        $where = ['enabled'=>1];
        if (!empty($keyword)) {
            $where['or'] = [['truename like' => "%$keyword%"], ['phone like' => "%$keyword%"]];
        }
        $query = $this->User->find();
        $query->hydrate(false);
        if (!empty($where)) {
            $query->where($where);
        }
        if($industry_id === 'all'){
            
        } elseif($industry_id){
            $query->matching('UserIndustry', function($q)use($industry_id){
                return $q->where(['UserIndustry.industry_id' => $industry_id]);
            });
        }
        $res = $query->toArray();
        $user = '';
        $uid = [];
        $PushlogTable = \Cake\ORM\TableRegistry::get('pushlog');
        $UsermsgTable = \Cake\ORM\TableRegistry::get('usermsg');
        if($res !== false && $push === 'true'){
            if($res === null){
                return $this->Util->ajaxReturn(false, '用户为空');
            } else {
                if($url){
                    if(stripos($url, 'm.chinamatop.com') !== false){
                        $extra['url'] = $url;
                    } else {
                        $extra['url'] = 'http://m.chinamatop.com' . $url;
                    }
                } else {
                    $extra = [];
                }
                $query = $UsermsgTable->query()->insert(['user_id', 'title', 'msg', 'url', 'create_time']);
                $data = [
                    'title' => $title,
                    'msg' => $content,
                    'url' => !empty($extra) ? $extra['url'] : 'javascript:void(0)',
                    'create_time' => date('Y-m-d H:i:s')
                ];
                foreach($res as $k=>$v){
                    $user .= $v['user_token'] . "\n";
                    $uid[] = $v['id'];
                    $data['user_id'] = $v['id'];
                    $query->values($data);
                }
                $this->loadComponent('Push');
                if($industry_id === 'all' && empty($keyword)){
                    $push_res = $this->Push->sendAll($title, $content, $title, true, $extra);
                    $type = 1;
                } else {
                    $push_res = $this->Push->sendFile($title, $content, $title, $user, 'BGB', true, $extra);
                    $type = 3;
                }
                $query->execute();
                if($push_res){
                    $is_success = 1;
                } else {
                    $is_success = 0;
                }
                $pushlog = $PushlogTable->newEntity();
                $data = [
                    'push_id' => -1,
                    'title' => $title,
                    'get_message_uid' => serialize($uid),
                    'body' => $content,
                    'extra' => $extra['url'],
                    'type' => $type,
                    'remark' => $remark,
                    'is_success' => $is_success
                ]; 
                $pushlog = $PushlogTable->patchEntity($pushlog, $data);
                $PushlogTable->save($pushlog);
            }
        }
        if($text === 'true' && $res !== false){
            if($res === null){
                return $this->Util->ajaxReturn(false, '用户为空');
            } else {
                $this->loadComponent('Sms');
                $mobile_arr = [];
                foreach($res as $k=>$v){
                    $mobile_arr[] = $v['phone'];
                }
                $mobile = implode(',', $mobile_arr); 
                $text_res = $this->Sms->sendManyByQf106($mobile, $content);
            }
        }
        return $this->Util->ajaxReturn(true, '发送成功');
    }
    
    public function view($id){
        $this->viewBuilder()->autoLayout(false);
        $res = '';
        if($id === 'all'){
            
        } else {
            $industryTable = \Cake\ORM\TableRegistry::get('industry');
            $res = $industryTable->get($id);
        }
        $this->set([
            'content'=>$res,
//            'type' => $type
        ]);
    }
    
    public function test(){
        $this->loadComponent('Push');
        $str = "13560627825\n13510663507\n15986227560\n18316629973\n15914057632\n13763053901";
        $res = $this->Push->sendFile('标题', '内容', 'ticker', $str, 'BGB', false);
        debug($res);die;
    }
    
    public function check($a, $i){
        $this->loadComponent('Push');
        $res1 = $this->Push->android_check($a);
        $res2 = $this->Push->ios_check($i);
        $res3 = json_decode($res1);
        $res4 = json_decode($res2);
        if($res3->ret == 'SUCCESS'){
            echo '安卓' . $this->showMsg($res3->data->status);
        }
        if($res4->ret == 'SUCCESS'){
            echo '苹果' . $this->showMsg($res4->data->status);
        }
        echo $res1;
        echo $res2;die;
    }
    
    public function showMsg($id){
        switch ($id){
            case 0:
                return '排队中';
            case 1:
                return '发送中';
            case 2:
                return '发送完成';
            case 3:
                return '发送失败';
            case 4:
                return '消息被撤销';
            case 5:
                return '消息过期';
            case 6:
                return '筛选结果为空';
            case 7:
                return '定时任务尚未开始处理';
        }
    }
}