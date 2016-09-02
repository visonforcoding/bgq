<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * Rd Controller
 *
 * @property \App\Controller\Component\PushComponent $Push
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
        $activity_id = $this->request->data('activity_id');
        $industry_id = $this->request->data('industry_id');
        $type = $this->request->data('type');
        $sort = 'User.' . $this->request->data('sidx');
        $order = $this->request->data('sord');
        $keywords = $this->request->data('keywords');
        $where = ['enabled'=>1];
        if (!empty($keywords)) {
            $where['or'] = [['truename like' => "%$keywords%"], ['phone like' => "%$keywords%"]];
        }
        if ($this->request->query('type') == '1') {
            $where['status'] = 1;
        }
        $query = $this->User->find();
        $query->hydrate(false);
        if (!empty($where)) {
            $query->where($where);
        }
        $nums = $query->count();
        if($type == 1){
            if($activity_id){
                $query->matching('Activityapply', function($q)use($activity_id){
                    return $q->where(['Activityapply.activity_id'=>$activity_id]);
                });
            }
        } elseif($type == 2){
            if($industry_id){
                $query->matching('UserIndustry', function($q)use($industry_id){
                    return $q->where(['UserIndustry.industry_id' => $industry_id]);
                });
            }
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
    
    public function doPush(){
        $title = $this->request->data('title');
        $type = $this->request->data('type');
        $content = $this->request->data('content');
        $url = $this->request->data('url');
        $choose = $this->request->data('choose');
        $activity_id = $this->request->data('activity_id');
        $industry_id = $this->request->data('industry_id');
        $keyword = $this->request->data('keyword');
        $where = ['enabled'=>1];
        if (!empty($keywords)) {
            $where['or'] = [['truename like' => "%$keywords%"], ['phone like' => "%$keywords%"]];
        }
        $query = $this->User->find();
        $query->hydrate(false);
        if (!empty($where)) {
            $query->where($where);
        }
        if($type == 1){
            if($activity_id){
                $query->matching('Activityapply', function($q)use($activity_id){
                    return $q->where(['Activityapply.activity_id'=>$activity_id]);
                });
            }
        } else if($type == 2){
            if($industry_id){
                $query->matching('UserIndustry', function($q)use($industry_id){
                    return $q->where(['UserIndustry.industry_id' => $industry_id]);
                });
            }
        }
        $res = $query->toArray();
        $user = '';
        if($res !== false){
            if($res === null){
                return $this->Util->ajaxReturn(false, '用户为空');
            } else {
                foreach($res as $k=>$v){
                    $user .= $v['user_token'] . "\n";
                }
                $this->loadComponent('Push');
                if($url){
                    $extra['extra']['url'] = $url;
                    $res = $this->Push->sendFile($title, $content, $title, $user, 'BGB', true, $extra);
                } else {
                    $res = $this->Push->sendFile($title, $content, $title, $user, 'BGB', true);
                }
                
                if($res){
                    return $this->Util->ajaxReturn(true, '推送成功');
                } else {
                    return $this->Util->ajaxReturn(false, '推送失败');
                }
            }
        } else {
            return $this->Util->ajaxReturn(false, '系统错误');
        }
        
    }
    
    public function view($type, $id){
        $this->viewBuilder()->autoLayout(false);
        if($type == 1){
            $activityTable = \Cake\ORM\TableRegistry::get('activity');
            $res = $activityTable->get($id);
        } else {
            $industryTable = \Cake\ORM\TableRegistry::get('industry');
            $res = $industryTable->get($id);
        }
        $this->set([
            'content'=>$res,
            'type' => $type
        ]);
    }
    
    public function test(){
        $this->loadComponent('Push');
//        $UserTable = \Cake\ORM\TableRegistry::get('user');
//        $user = $UserTable->find()->where(['phone'=>'13560627825'])->toArray();
//        $a = '';
//        foreach($user as $k=>$v){
//            $a .= $v['user_token']. "\n";
//        }
//        $res = $this->Push->sendFile('2', '3', '4', $a, 'BGB', false);
//        $res = $this->Push->sendAll('1', '2', '3');
        
        $res = $this->Push->sendAlias('ca1c217f4f351cb2bff7', '1', '2', '3');
//        echo $a;
        print_r($res);die;
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