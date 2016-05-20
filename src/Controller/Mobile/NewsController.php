<?php

namespace App\Controller\Mobile;

use App\Controller\Mobile\AppController;

/**
 * News Controller  新闻
 *
 * @property \App\Model\Table\NewsTable $News
 * @property \App\Controller\Component\BusinessComponent $Business
 */
class NewsController extends AppController {

    protected $newslimit = 5;

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $news = $this->News->find()
                        ->contain(['Admins', 'Industries'])
                        ->limit($this->newslimit)->orderDesc('News.create_time')->toArray();
        //获取资讯banner图
        $bannerTable = \Cake\ORM\TableRegistry::get('banner');
        $banners = $bannerTable->find()->where("`enabled` = '1' and `type` = '1'")
                        ->orderDesc('create_time')->limit(3)->toArray();
//        debug($banners);exit();
        $this->set(compact('news', 'banners'));
        $this->set('newsjson', json_encode($news));
    }

    /**
     * ajax 获取 更多页的 新闻数据
     * @param type $page  页数
     */
    public function getMoreNews($page) {
        $news = $this->News->find()
                        ->contain(['Admins', 'Industries'])->page($page, $this->newslimit)
                        ->orderDesc('News.create_time')->toArray();
        if ($news) {
            $this->Util->ajaxReturn(['status' => true, 'data' => $news]);
        } else {
            $this->Util->ajaxReturn(['status' => false]);
        }
    }

    /**
     * 评论
     */
    public function comment() {
        $this->handCheckLogin();
        if ($this->request->is('post')) {
            $CommentTable = \Cake\ORM\TableRegistry::get('newscom');
            $comment = $CommentTable->newEntity([
                'user_id'=>  $this->user->id,
                'news_id'=>  $this->request->data('id'),
                'body'=>  $this->request->data('content')
            ]);
            if ($CommentTable->save($comment)) {
                //文章新闻数+1
                $news = $this->News->get($this->request->data('id'));
                $news->comment_nums +=1;
                $this->News->save($news);
                $this->Util->ajaxReturn(true, '评论成功');
            } else {
                $msg = errorMsg($comment,'评论成功');
                $this->Util->ajaxReturn(false, $msg);
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
        if(!empty($this->user)){
            $user_id = $this->user->id;
            $news = $this->News->get($id, [
                'contain' => ['Admins', 'Comments','Comments.Users'=>function($q){
                        return $q->select(['id','avatar','truename','company','position']);
                },'Comments.Likes'=>function($q)use($user_id){
                    return $q->where(['type'=>1,'user_id'=>$user_id]);
                }]
            ]);
        }else{
            $news = $this->News->get($id, [
                'contain' => ['Admins', 'Comments','Comments.Users'=>function($q){
                        return $q->select(['id','avatar','truename','company','position']);
                }]
            ]);
        }
        //阅读数+1
        $news->read_nums +=1;
        $this->News->save($news);
        $this->set('news', $news);
        $this->set('_serialize', ['news']);
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
                $this->Util->ajaxReturn(true,'点赞成功');
            }else{
                $this->Util->ajaxReturn(false,'点赞失败');
            }
        }
    }
}
