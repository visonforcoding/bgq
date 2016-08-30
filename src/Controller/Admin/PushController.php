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
        $where = ['is_del'=>0];
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
        $where = ['is_del'=>0];
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
                    $user .= $v->user_token . '\n';
                }
                $this->loadComponent('Push');
                if($url){
                    $extra['url'] = $url;
                    $res = $this->Push->sendFile($title, $content, $title, $user, 'BGB', false, $extra);
                } else {
                    $res = $this->Push->sendFile($title, $content, $title, $user, 'BGB', false);
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
        $res = $this->Push->android_check('uf02452147255932334001');
        debug($res);die;
    }
}