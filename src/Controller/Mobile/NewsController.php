<?php

namespace App\Controller\Mobile;

use App\Controller\Mobile\AppController;

/**
 * News Controller  新闻
 *
 * @property \App\Model\Table\NewsTable $News
 * @property \App\Controller\Component\BusinessComponent $Business
 * @property \App\Controller\Component\WxComponent $Wx
 */
class NewsController extends AppController {

    protected $newslimit = 5;

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $this->set('pageTitle', '资讯');
    }

    /**
     * ajax 获取 更多页的 新闻数据
     * @param type $page  页数
     */
    public function getMoreNews($page) {
        $news = $this->News->find()
                        ->contain(['Users', 'Industries'])->page($page, $this->newslimit)
                        ->orderDesc('News.create_time')->toArray();
        if ($news) {
            return $this->Util->ajaxReturn(['status' => true, 'data' => $news]);
        } else {
            return $this->Util->ajaxReturn(['status' => false]);
        }
    }

    
    /**
     * 评论
     */
    public function comment() {
        $data = [];
       $this->handCheckLogin();
        if ($this->request->is('post')) {
            $reply_id = $this->request->data('reply_id');
            $CommentTable = \Cake\ORM\TableRegistry::get('newscom');
            if($reply_id==$this->user->id){
                $this->Util->ajaxReturn(false,'不能对自己进行回复');
            }
            if(is_numeric($reply_id)&&$reply_id>0){
                //该条评论是 对评论的回复
                $data['pid'] = $reply_id;
                $reply_com = $CommentTable->get($reply_id);
                $data['reply_user'] = $reply_com->user_id;
            }
            $comment = $CommentTable->newEntity(array_merge($data,[
                'user_id'=>  $this->user->id,
                'news_id'=>  $this->request->data('id'),
                'body'=>  $this->request->data('content')
            ]));
            $newComment = $CommentTable->save($comment);
            if ($newComment) {
                //文章新闻数+1
                $news = $this->News->get($this->request->data('id'));
                $news->comment_nums +=1;
                $this->News->save($news);
                if(is_numeric($reply_id)&&$reply_id>0){
                    $this->loadComponent('Business');
                    $jump_url = '/news/view/'.  $this->request->data('id').'#allcoment#common_'.$newComment->id;
                    $this->Business->usermsg($reply_com->user_id,'评论回复','有人回复了你的评论!', 3,$newComment->id,$jump_url);
                }
                $user_id = $this->user->id;
                $res = $this->News->Comments->get($newComment->id, [
                    'contain' => ['Users'=>function($q){
                            return $q->select(['id','avatar','truename','company','position']);
                    },'Likes'=>function($q)use($user_id){
                        return $q->where(['type'=>1,'user_id'=>$user_id]);
                    },'Reply'=>function($q){
                        return $q->select(['id','truename']);
                    }],
                    'order' => ['Comments.create_time' => 'Desc'],
                ]);
                return $this->Util->ajaxReturn(['status'=>true, 'msg'=>'评论成功', 'data'=>  $res]);
            } else {
                $msg = errorMsg($comment,'评论成功');
                return $this->Util->ajaxReturn(false, $msg);
            }
        }
    }

    /**
     * View method
     *
     * @param string|null $id News id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $isCollect = [];
        if(!empty($this->user)){
            $user_id = $this->user->id;
            $news = $this->News->get($id, [
                'contain' => ['Users', 'Comments'=>function($q){
                    return $q->where(['is_delete'=>0])->orderDesc('Comments.create_time')->limit($this->newslimit);
                },'Comments.Users'=>function($q){
                    return $q->select(['id','avatar','truename','company','position']);
                },'Comments.Likes'=>function($q)use($user_id){
                    return $q->where(['type'=>1,'user_id'=>$user_id]);
                },'Praises'=>function($q)use($user_id){
                    return $q->where(['type'=>1,'user_id'=>$user_id]);
                },'Comments.Reply'=>function($q){
                    return $q->select(['id','truename']);
                },'Savants'],
            ]);
            $collectTable = \Cake\ORM\TableRegistry::get('collect');
            $isCollect = $collectTable->find()->where(['user_id'=>$user_id, 'relate_id'=>$id, 'type'=>1, 'is_delete'=>0])->toArray();
        }else{
            $news = $this->News->get($id, [
                'contain' => ['Users', 'Comments'=>function($q){
                    return $q->where(['is_delete'=>0])->orderDesc('Comments.create_time')->limit($this->newslimit);
                },'Comments.Users'=>function($q){
                    return $q->select(['id','avatar','truename','company','position']);
                },'Comments.Reply'=>function($q){
                    return $q->select(['id','truename']);
                },'Savants'],
            ]);
        }
        $this->set('isCollect', $isCollect);
        //阅读数+1
        $news->read_nums +=1;
        $this->News->save($news);
        $this->set('news', $news);
        $this->set('user', $this->user);
        $this->set('_serialize', ['news']);
        $this->set('pageTitle', '资讯内容');
    }
    
    
    /**
     * 评论点赞
     */
    public function commentPraise(){
        $this->handCheckLogin();
        if($this->request->is('post')){
            $relate_id = $this->request->data('id');
            $user_id = $this->user->id;
            $this->loadComponent('Business');
            if($this->Business->commentPraise($user_id, $relate_id, 1)){
                return $this->Util->ajaxReturn(true,'点赞成功');
            }else{
                return $this->Util->ajaxReturn(false,'点赞失败');
            }
        }
    }
    
    /**
     * 资讯点赞
     */
    public function newsPraise(){
         $this->handCheckLogin();
        if($this->request->is('post')){
            $relate_id = $this->request->data('id');
            $user_id = $this->user->id;
            $this->loadComponent('Business');
            $res = $this->Business->praise($user_id, $relate_id, 1);
            if($res===true){
                return $this->Util->ajaxReturn(true,'点赞成功');
            } elseif($res == '取消点赞成功'){
                return $this->Util->ajaxReturn(true,'取消点赞成功');
            }else{
                return $this->Util->ajaxReturn(false, $res);
            }
        }
    }
    
    /**
     * 收藏
     */
    public function collect(){
        $this->handCheckLogin();
        $this->loadComponent('Business');
        $data_id = $this->request->data('id');
        $res = $this->Business->collectIt($this->user->id,$data_id, 1);
        if($res!==false){
            $res['status'] = true;
            return $this->Util->ajaxReturn($res);
        }else{
            return $this->Util->ajaxReturn(false,'服务器出错');
        }
    }
    
    /**
     * 活动搜索
     */
    public function search($id=null) {
        $industries = $this->News->Industries->find()->hydrate(false)->all()->toArray();
        $this->set('industries', $industries);
        $this->set([
            'pageTitle'=>'资讯搜索',
            'industries'=>$industries,
            'id' => $id,
        ]);
    }
    
    /**
     * 搜索结果
     */
    public function getSearchRes() {
        $data = $this->request->data();
        $industry_id = $data['industry_id'];
        
        $res = $this
                ->News
                ->find()
                ->where(['title LIKE' => '%' . $data['keyword'] . '%']);
        if ($industry_id) {
            $res = $res->matching(
                'Industries', function($q)use($industry_id) {
                    return $q->where(['Industries.id' => $industry_id]);
                }
            );
        } else {
            $res = $res->contain(['Industries']);
        }
        
        $res = $res->orderDesc('News.create_time'); // 默认按时间倒序排列
        $res = $res->contain(['Users'])
                ->limit($this->newslimit)
                ->toArray();
        if ($res!==false) {
            if($res == [])
            {
                return $this->Util->ajaxReturn(false, '暂无搜索结果');
            }
            return $this->Util->ajaxReturn(['status' => true, 'data' => $res]);
        } else {
            return $this->Util->ajaxReturn(false, '系统错误');
        }
    }
    
    /**
     * 将子元素分到父元素数组的一个子集里面，无限循环
     * @param array $arr 原数组
     * @param int $pid 父id
     * @return array 重构后的数组
     */
    public function tree($arr, $pid = '0') {
        $p = [];
        foreach ($arr as $k => $v) {
            if ($v['pid'] == $pid) {
                $p[$k] = $v;
                $p[$k]['child'] = $this->tree($arr, $v['id']);
            }
        }
        return $p;
    }
    
    /**
     * 加载更多搜索结果
     * @param int $page 页数
     */
    public function getMoreSearch($page){
        $data = $this->request->data();
        $industry_id = $data['industry_id'];
        $news = $this->News->find()->where(['title LIKE' => '%' . $data['keyword'] . '%']);
        if ($industry_id) {
            $news = $news->matching(
                'Industries', function($q)use($industry_id) {
                    return $q->where(['Industries.id' => $industry_id]);
                }
            )->contain(['Users']);
        } else {
            $news = $news->contain(['Industries', 'Users']);
        }
        
        if ($data['sort']) {
            $news = $news->orderDesc('News.' . $data['sort']);
        } else {
            $news = $news->orderDesc('News.create_time');
        }

        $news = $news
                ->page($page, $this->newslimit)
                ->toArray();
        if ($news) {
            return $this->Util->ajaxReturn(['status' => true, 'data' => $news]);
        } else {
            return $this->Util->ajaxReturn(['status' => false]);
        }
    }
    
    /**
     * ajax获取更多评论
     * @param int $page 分页
     * @param int $id 活动id
     */
    public function getMoreComment($page, $id) {
        $comment = $this->News
                        ->Comments
                        ->find()
                        ->where(['news_id' => $id, 'is_delete'=>0])
                        ->contain(['Users', 'Reply'])
                        ->page($page, $this->newslimit)
                        ->orderDesc('Comments.create_time')
                        ->toArray();
        if ($comment) {
            return $this->Util->ajaxReturn(['status' => true, 'data' => $comment]);
        } else {
            return $this->Util->ajaxReturn(['status' => false]);
        }
    }
    
    /**
     * 展示全部评论
     * @param type $id
     */
    public function showAllComment($id){
        $user_id = $this->user->id;
        // 评论
        $comment = $this
                ->News
                ->Comments
                ->find()
                ->contain(['Users', 'Reply', 'Likes'=>function($q)use($user_id){
                    return $q->where(['type'=>1,'user_id'=>$user_id]);
                }])
                ->where(['news_id' => $id, 'is_delete'=>0])
                ->order(['Comments.create_time' => 'DESC'])
                ->limit(10)
                ->toArray();
        if ($comment) {
            return $this->Util->ajaxReturn(['status' => true, 'data' => $comment]);
        } else {
            return $this->Util->ajaxReturn(['status' => false]);
        }
    }
    
    public function getBanner(){
        //获取资讯banner图
        $bannerTable = \Cake\ORM\TableRegistry::get('banner');
        $banners = $bannerTable->find()->where("`enabled` = '1' and `type` = '1'")
                        ->orderDesc('create_time')->limit(3)->toArray();
        return $this->Util->ajaxReturn(['status'=>true, 'data'=>$banners]);
    }
    
    /**
     * 编辑名片
     */
    public function editCard(){
//        $user_id = $this->user->id;
        $user_id = 8;
        $UserTable = \Cake\ORM\TableRegistry::get('User');
        $userInfo = $UserTable->get($user_id);
        if($this->request->is('post')){
            $userInfo->card_path = $this->request->data('card_path');
            debug($userInfo);
            if($UserTable->save($userInfo)){
                return $this->Util->ajaxReturn(true, '更改成功');
            }else{
                return $this->Util->ajaxReturn(false,'服务器开小差了');
            }
        }
        $this->set([
            'pageTitle'=>'名片修改',
             'user'=>$userInfo
        ]);
    }
    
    public function delComment($id){
        $newscomTable = \Cake\ORM\TableRegistry::get('newscom');
        $newscom = $newscomTable->get($id);
        $newscom->is_delete = 1;
        $res = $newscomTable->save($newscom);
        if($res){
            return $this->Util->ajaxReturn(true, '删除成功');
        } else {
            return $this->Util->ajaxReturn(false, '删除失败');
        }
    }
}

