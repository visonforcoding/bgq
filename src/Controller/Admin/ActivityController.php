<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * Activity Controller
 *
 * @property \App\Model\Table\ActivityTable $Activity
 */
class ActivityController extends AppController {
    
    
    const SERIES_CONF = 'activitySeries';

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $series = \Cake\Core\Configure::read(self::SERIES_CONF);
        $domain = $this->request->env('SERVER_NAME');
        $this->set(compact('domain'));
        $this->set('activity', $this->Activity);
        $this->set([
            'series'=>$series
        ]);
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
     *   将与活动标签相同的专家随机选择4个添加到活动专家推荐中
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $activity = $this->Activity->newEntity();
        if ($this->request->is('post')) {
            $activity = $this->Activity->patchEntity($activity, $this->request->data);
            $activity->apply_end_time = strtotime($this->request->data('apply_end_time'));
            $activity->admin_id = $this->_user->id;
            $activity->user_id = $this->_user->id;
            $activity->publisher = $this->_user->truename;
            $res = $this->Activity->save($activity);
            if ($res) {
                return $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $errors = $activity->errors();
                return $this->Util->ajaxReturn(['status' => false, 'msg' => getMessage($errors), 'errors' => $errors]);
            }
        }
        $regions = $this->Activity->Regions->find('list', ['limit' => 200]);

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
            'contain' => ['Industries', 'Savants', 'Activity_recommends'],
        ]);
        if ($this->request->is(['post', 'put'])) {
            $activity = $this->Activity->patchEntity($activity, $this->request->data);
            $activity->apply_end_time = strtotime($this->request->data('apply_end_time'));
            if ($this->Activity->save($activity)) {
                return $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $errors = $activity->errors();
                return $this->Util->ajaxReturn(false, getMessage($errors));
            }
        }
        $regions = $this->Activity->Regions->find('list', ['limit' => 200]);
        $selSavantIds = [];
        if ($activity->savants) {
            foreach ($activity->savants as $savant) {
                $selSavantIds[] = $savant->id;
            }
        }
        $selActivityIds = [];
        if ($activity->activity_recommends) {
            foreach ($activity->activity_recommends as $activityRecommend) {
                $selActivityIds[] = $activityRecommend->id;
            }
        }
        foreach ($activity->industries as $industry) {
            $selIndustryIds[] = $industry->id;
        }
        $this->set(compact('regions'));
        $this->set(compact('activity', 'selIndustryIds', 'selSavantIds', 'selActivityIds'));
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
            $activity->is_del = 1;
            $activity->status = 0;
            if ($this->Activity->save($activity)) {
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
        $series_id = $this->request->data('series_id');
        $region_id = $this->request->data('region_id');
        $begin_time = $this->request->data('begin_time');
        $end_time = $this->request->data('end_time');
        $where = ['from_user'=>0,'Activity.is_del'=>0];
        
        if (!empty($series_id)) {
            $where['and'] = ['series_id'=>$series_id];
        }
        if (!empty($region_id)) {
            $where['and'] = ['region_id'=>$region_id];
        }
        if (!empty($keywords)) {
            $where['OR'] = [
                ['Users.`truename` like' => "%$keywords%"],
                ['Activity.`title` like' => "%$keywords%"],
                ['Activity.`company` like' => "%$keywords%"],
                ['Activity.`address` like' => "%$keywords%"],
            ];
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['Activity.`create_time` >' => $begin_time], ['Activity.`create_time` <' => $end_time]];
        }
        $query = $this->Activity->find()->contain(['Users', 'Regions', 'Activityapply' => function($q) {
                return $q->select([
                    'activity_id',
                ]);
            }]);

        $query->hydrate(false);
        if (!empty($where)) {
            $query->where($where);
        }
        $nums = $query->count();
//        $query->contain(['Industries', 'Regions']);
        if (!empty($sort) && !empty($order)) {
            $query->order(['Activity.is_top' => 'desc', $sort => $order]);
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
        $where = ['from_user'=>0,'Activity.is_del'=>0];
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
        if (!$res) {
            return $this->Util->ajaxReturn(false, '发布失败');
        }
        $folder = 'upload/qrcode/activitycode/' . date('Y-m-d');
        if (!file_exists(WWW_ROOT . $folder)) {
            $res = mkdir(WWW_ROOT . $folder);
        }
        if (!$res) {
            return $this->Util->ajaxReturn(false, '系统错误');
        }
        // 生成二维码
        $savePath = $folder . '/' . time() . $id . '.png';
        \PHPQRCode\QRcode::png('http://' . $this->request->env('HTTP_HOST') . '/activity/sign/' . $id, WWW_ROOT . $savePath);
        $activity = $this->Activity->get($id);
        $activity->qrcode = $savePath;
        $res = $this->Activity->save($activity);
        if (!$res) {
            return $this->Util->ajaxReturn(false, '二维码生成失败');
        }


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

    public function all() {
        $activity = $this->Activity->find()->all()->toArray();
        foreach ($activity as $k => $v) {
            $folder = 'upload/qrcode/activitycode/' . date('Y-m-d');
            if (!file_exists(WWW_ROOT . $folder)) {
                $res = mkdir(WWW_ROOT . $folder);
                if (!$res) {
                    return $this->Util->ajaxReturn(false, '系统错误');
                }
            }
            // 生成二维码
            $savePath = $folder . '/' . time() . $v['id'] . '.png';
            \PHPQRCode\QRcode::png('http://' . $this->request->env('HTTP_HOST') . '/activity/sign/' . $v['id'], WWW_ROOT . $savePath);
            $activity = $this->Activity->get($v['id']);
            $activity->qrcode = '/' . $savePath;
            $res = $this->Activity->save($activity);
            if ($res) {
                debug('1');
            } else {
                debug('2' . $v['id']);
            }
        }
        exit();
    }
    
      /**
     * 资讯评论
     * @param type $id
     */
    public function comments($id) {
        $this->viewBuilder()->autoLayout(false);
        $ActivitycomTable = \Cake\ORM\TableRegistry::get('Activitycom');
        $activity= $this->Activity->find()->select(['id','title'])->first();
        $comsCount = $ActivitycomTable->find()->where(['activity_id'=>$id])->count();
        $coms = $ActivitycomTable->find('threaded', [
                    'keyField' => 'id',
                    'parentField' => 'pid'
                ])->contain(['Users'=>function($q){
                    return $q->select(['id','truename','avatar','company','position']);
                },'Replyusers'=>function($q){
                    return $q->select(['id','truename','avatar','company','position']);
                }])->hydrate(true)->where(['activity_id'=>$id])
                        ->toArray();
        $comsHtml = $this->recyOutputComs($coms); 
        $this->set([
            'comsHtml'=>$comsHtml,
            'comsCount'=>$comsCount,
            'activity'=>$activity
        ]);        
     }
     
     
     /**
      * 递归输出评论html
      * @param type $coms
      * @return string
      */
     protected function recyOutputComs($coms){
         $output = '<div class="comments-list">';
         if($coms){
             foreach ($coms as $com){
                 $output .= '<div class="comment">';
                 $output .= '<a href="###" class="avatar"><img class="img-circle" style="width:60px;height:60px;" src="'.getAvatar($com->user->avatar).'"/></a>';
                 $output .= '<div class="content">
                                <div class="pull-right"><span class="text-muted">'.
                                $com->create_time->timeAgoInWords([ 'accuracy' => [
                                             'year' => 'year',
                                             'month' => 'month',
                                             'week' => 'week',
                                             'day'=>'day',
                                             'hour' => 'hour'
                                         ],'end' => '+10 year']
                                ).'</span> &nbsp;<strong>#3</strong></div>
                                <a href="#"><span class="author"><a href="#"><strong>'.
                        $com->user->truename.'&nbsp;'.$com->user->company.'&nbsp;'.$com->user->position.'</strong></a>';
                 if($com->reply){
                     $output .= '<span class="text-muted"> 回复 </span>
                                <a href="#">'.$com->user->truename.'&nbsp;'.$com->user->company.'&nbsp;'.$com->user->position.'</a>';
                 }
                 $output .=  '</span>';
                 $output .='<div class="text">'.$com->body.'</div>
                            <div class="actions">
                                <a class="reply" data-id="'.$com->id.'" href="##">回复</a>
                                <a class="delete" data-id="'.$com->id.'" href="##">删除</a>
                            </div>
                           </div>';
                 if(!empty($com->children)){
                     $output .= $this->recyOutputComs($com->children);
                 }
                 $output .='</div>';
             }
         }
       $output .= '</div>';  
       return $output;
     }
     
     /**
      * 回复评论
      * @return type
      */
    public function reply() {
        if ($this->request->is('post')) {
            $id = $this->request->data('id');
            $body = $this->request->data('body');
            $ActivitycomTable = \Cake\ORM\TableRegistry::get('Activitycom');
            $lastcom =  $ActivitycomTable->get($id);
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
                $news = $this->Activity->get($newscom->activity_id);
                $news->comment_nums += 1;
                $this->Activity->save($news);
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
    public function comsDelete(){
         if ($this->request->is('post')) {
            $id = $this->request->data('id');
            $ActivitycomTable = \Cake\ORM\TableRegistry::get('Activitycom');
            $com =  $ActivitycomTable->get($id);
            $res = $ActivitycomTable->delete($com);
            if ($res) {
                $news = $this->Activity->get($com->activity_id);
                $news->comment_nums -= 1;
                $this->Activity->save($news);
                return $this->Util->ajaxReturn(true, '回复成功');
            } else {
                return $this->Util->ajaxReturn(false, '回复失败');
            }
        }
    }
    
    /**
     * 丢弃
     * @return type
     */
    public function able(){
          if ($this->request->is('post')) {
            $id = $this->request->data('id');
            $activity = $this->Activity->get($id);
            $activity->status = $activity->status==1?0:1;
            if ($activity->status == 1&&empty($activity->qrcode)) {
                        // 生成二维码
                $savePath = $folder . '/' . time() . $id . '.png';
                \PHPQRCode\QRcode::png('http://' . $this->request->env('HTTP_HOST') . '/activity/sign/' . $id, WWW_ROOT . $savePath);
                $activity = $this->Activity->get($id);
                $activity->qrcode = $savePath;
                $res = $this->Activity->save($activity);
                if (!$res) {
                    return $this->Util->ajaxReturn(false, '二维码生成失败');
                }
            }
            if ($this->Activity->save($activity)) {
                return $this->Util->ajaxReturn(true, '更改成功');
            } else {
                return $this->Util->ajaxReturn(false, '更改失败');
            }
        }
    }
    
    /**
     * 查看收藏
     */
    public function viewCollect($id=null){
        $this->set('id', $id);
        $type = $this->request->query('type');
        if($type){
            $this->set([
                'type'=>$type
            ]);
        }
    }
    
    /**
     * 查看点赞
     */
    public function viewLike($id=null){
        $this->set('id', $id);
        $type = $this->request->query('type');
        if($type){
            $this->set([
                'type'=>$type
            ]);
        }
    }
}
