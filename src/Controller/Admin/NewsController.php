<?php

namespace App\Controller\Admin;

use Wpadmin\Controller\AppController;

/**
 * News Controller
 *
 * @property \App\Model\Table\NewsTable $News
 */
class NewsController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->set('news', $this->News);
    }

    /**
     * View method
     *
     * @param string|null $id News id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->autoLayout(false);
        $news = $this->News->get($id, [
            'contain' => ['Admins']
        ]);
        $this->set('news', $news);
        $this->set('_serialize', ['news']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $news = $this->News->newEntity();
        if ($this->request->is('post')) {
            $news = $this->News->patchEntity($news, $this->request->data);
            $news->admin_id = $this->_user->id;
            $news->admin_name = $this->_user->truename;
            if (empty($this->request->data('user_id')) && empty($this->request->data('source'))) {
                $this->Util->ajaxReturn(false, '作者和来源必须要填一个');
            }
            if ($this->News->save($news)) {
                $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $errors = $news->errors();
                $this->Util->ajaxReturn(['status' => false, 'msg' => getMessage($errors), 'errors' => $errors]);
            }
        }
//        $savants = $this->News->Savants->find('list', ['limit' => 200]);
//        $users = $this->News->Users->find('list', ['limit' => 200]);
        $this->set(compact('news'));
    }

    /**
     * Edit method
     *
     * @param string|null $id News id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $news = $this->News->get($id, [
            'contain' => ['Industries', 'Savants']
        ]);
        if ($this->request->is(['post', 'put'])) {
            $news = $this->News->patchEntity($news, $this->request->data);
            $news->admin_id = $this->_user->id;
            $news->admin_name = $this->_user->truename;
            if (empty($this->request->data('user_id')) && empty($this->request->data('source'))) {
                $this->Util->ajaxReturn(false, '作者和来源必须要填一个');
            }
            if ($this->News->save($news)) {
                $this->Util->ajaxReturn(true, '修改成功');
            } else {
                $errors = $news->errors();
                $this->Util->ajaxReturn(false, getMessage($errors));
            }
        }
        $users = $this->News->Users->find('list', ['limit' => 200]);
        $this->set(compact('news', 'users'));
        $selIndustryIds = [];
        foreach ($news->industries as $industry) {
            $selIndustryIds[] = $industry->id;
        }
        // 专家推荐
        $selSavantIds = [];
        if ($news->savants) {
            foreach ($news->savants as $savant) {
                $selSavantIds[] = $savant->id;
            }
        }
        $this->set(compact('news', 'selIndustryIds', 'selSavantIds'));
    }

    /**
     * Delete method
     *
     * @param string|null $id News id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod('post');
        $id = $this->request->data('id');
        if ($this->request->is('post')) {
            $news = $this->News->get($id);
            if ($this->News->delete($news)) {
                $this->Util->ajaxReturn(true, '删除成功');
            } else {
                $errors = $news->errors();
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
        $sort = 'News.' . $this->request->data('sidx');
        $order = $this->request->data('sord');
        $keywords = $this->request->data('keywords');
        $industry = $this->request->data('industries');
        $begin_time = $this->request->data('begin_time');
        $end_time = $this->request->data('end_time');
        $where = [];
        if (!empty($keywords)) {
            $where['or'] = [[' Users.truename like' => "%$keywords%"], ['(`title`) like' => "%$keywords%"], ['(`summary`) like' => "%$keywords%"]];
        }
        if (!empty($begin_time) && !empty($end_time)) {
            $begin_time = date('Y-m-d', strtotime($begin_time));
            $end_time = date('Y-m-d', strtotime($end_time));
            $where['and'] = [['date(`create_time`) >' => $begin_time], ['date(`create_time`) <' => $end_time]];
        }
        $query = $this->News->find();
        $query->contain(['Users', 'Industries' => function($q) {
                return $q->hydrate(false)->select(['name']);
            }]);

        if (!empty($industry['_ids'][0])) {
            //过滤
            $query->matching('Industries', function($q)use($industry) {
                return $q->where(['Industries.id' => $industry['_ids'][0]]);
            });
        }

        //$query->hydrate(false);
        if (!empty($where)) {
            $query->where($where);
        }
        $nums = $query->count();
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
        $Table = $this->News;
        $column = ['作者', '标题', '阅读数', '点赞数', '评论数', '封面', '内容', '摘要', '创建时间', '更新时间'];
        $query = $Table->find();
        $query->hydrate(false);
        $query->select(['admin_id', 'title', 'read_nums', 'praise_nums', 'comment_nums', 'cover', 'body', 'summary', 'create_time', 'update_time']);
        if (!empty($where)) {
            $query->where($where);
        }
        if (!empty($sort) && !empty($order)) {
            $query->order([$sort => $order]);
        }
        $res = $query->toArray();
        $this->autoRender = false;
        $filename = 'News_' . date('Y-m-d') . '.csv';
        \Wpadmin\Utils\Export::exportCsv($column, $res, $filename);
    }

    /**
     * 资讯评论
     * @param type $id
     */
    public function comments($id) {
        $this->viewBuilder()->autoLayout(false);
        $NewscomTable = \Cake\ORM\TableRegistry::get('Newscom');
        $news = $this->News->find()->select(['id','title'])->first();
        $comsCount = $NewscomTable->find()->where(['news_id'=>$id])->count();
        $coms = $NewscomTable->find('threaded', [
                    'keyField' => 'id',
                    'parentField' => 'pid'
                ])->contain(['Users'=>function($q){
                    return $q->select(['id','truename','avatar']);
                },'Reply'=>function($q){
                    return $q->select(['id','truename','avatar']);
                }])->hydrate(true)->where(['news_id'=>$id])
                        ->toArray();
        $comsHtml = $this->recyOutputComs($coms); 
        $this->set([
            'comsHtml'=>$comsHtml,
            'comsCount'=>$comsCount,
            'news'=>$news
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
                                $com->create_time->timeAgoInWords(
                                   [ 'accuracy' => [
                                             'year' => 'year',
                                             'month' => 'month',
                                             'week' => 'week',
                                             'day'=>'day',
                                             'hour' => 'hour'
                                         ],'end' => '+10 year']
                                ).'</span> &nbsp;<strong>#3</strong></div>
                                <span class="author">
                                <a href="#"><strong>'.$com->user->truename.'</strong></a>';
                 if($com->reply){
                     $output .= '<span class="text-muted"> 回复 </span>
                                <a href="#">'.$com->reply->truename.'</a>';
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
            $NewscomTable = \Cake\ORM\TableRegistry::get('Newscom');
            $lastcom =  $NewscomTable->get($id);
            $reply = [
                'user_id' => -1, //并购帮官方用户
                'news_id' => $lastcom->news_id,
                'body' => $body,
                'reply_user' => $lastcom->user_id,
                'pid' => $lastcom->id,
            ];
            $newscom = $NewscomTable->newEntity();
            $newscom = $NewscomTable->patchEntity($newscom, $reply);
            $res = $NewscomTable->save($newscom);
            if ($res) {
                $news = $this->News->get($newscom->news_id);
                $news->comment_nums += 1;
                $this->News->save($news);
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
            $NewscomTable = \Cake\ORM\TableRegistry::get('Newscom');
            $com =  $NewscomTable->get($id);
            $res = $NewscomTable->delete($com);
            if ($res) {
                $news = $this->News->get($com->news_id);
                $news->comment_nums -= 1;
                $this->News->save($news);
                return $this->Util->ajaxReturn(true, '回复成功');
            } else {
                return $this->Util->ajaxReturn(false, '回复失败');
            }
        }
    }
}
        