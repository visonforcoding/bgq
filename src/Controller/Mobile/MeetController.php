<?php

namespace App\Controller\Mobile;

use App\Controller\Mobile\AppController;

/**
 * Meet Controller  专家约见栏目
 *
 * @property \App\Model\Table\UserTable $User Description
 * @property \App\Controller\Component\BusinessComponent $Business 通用业务处理组件
 */
class MeetController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadModel('User');
    }

    protected $limit = '5'; // 分页条数
    
    /**
     * Index method  专家约见首页
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        // 轮播图
        $bannerTable = \Cake\ORM\TableRegistry::get('banner');
        $banners = $bannerTable
                ->find()
                ->where("`enabled` = '1' and `type` = '3'")
                ->orderDesc('create_time')
                ->limit(3)
                ->toArray();
        $this->set(compact('banners'));
        
        $users = $this
                ->User
                ->find()
                ->contain(['Subjects'])
//                ->matching('Industries', function($q) {
//                    return $q->where(['Industries.id' => '1']);
//                })
                ->where(['enabled'=>'1', 'level'=>'2'])
                ->limit($this->limit)
                ->toArray();
        $this->set('meetjson', json_encode($users));
    }
    
    /**
     * 大咖首页点击类别获取结果
     */
    public function getIndex(){
        $data = $this->request->data();
        $industry_id = $data['industry_id'];
        $users = $this
                ->User
                ->find()
                ->contain(['Subjects'])
                ->matching('Industries', function($q)use($industry_id) {
                    return $q->where(['Industries.id' => $industry_id]);
                })
                ->where(['enabled'=>'1', 'level'=>'2'])
                ->limit($this->limit)
                ->toArray();
        if($users)
        {
            $this->Util->ajaxReturn(['status'=>true, 'data'=>$users]);
        }
        else
        {
            $this->Util->ajaxReturn(false, '暂无结果');
        }
    }

    /**
     * 大咖推荐
     */
    public function meetReco() {
        $dakas = $this->User->find()
                ->hydrate(false)
                ->select(['id', 'truename', 'company', 'position', 'meet_nums', 'avatar'])
                ->where("`level`= '2' and `enabled` = '1'")
                ->orderDesc('meet_nums')
                ->toArray();
        $this->set([
            'dakas' => json_encode($dakas)
        ]);
    }

    /**
     * 专家类别查看  eg:互联网、大消费
     * @param type $id 行业标签id
     */
    public function meetCat($id = null) {
        //拥有该标签的所有专家
        $savants = $this->User->find()
                        ->matching('Industries', function($q)use($id) {
                            return $q->where(['Industries.id' => $id])->orWhere(['pid' => $id]);
                        })->toArray();
        //该标签类下的所有子类
        $sub_industries = $this->User->Industries->findByPid($id)->toArray();
        $this->set([
            'savants' => $savants,
            'sub_industries' => $sub_industries
        ]);
    }

    /**
     * 专家详情页
     */
    public function view($id = null) {
        $biggie = $this->User->get($id, ['contain' => ['Savant', 'Subjects']]);
//        debug($biggie);die;
        $this->set([
            'biggie' => $biggie
        ]);
    }

    /**
     * 主题详情页 ->预约操作
     * @param type $id
     */
    public function subjectDetail($id = null) {
        $SubjectTable = \Cake\ORM\TableRegistry::get('MeetSubject');
        $subject = $SubjectTable->find()
                ->contain(['User'=>function($q){
                    return $q->select(['id','truename','company','position']);
                }])
                ->where(['MeetSubject.id' => $id])
                ->first();
        $this->set(compact('subject'));
    }

    /**
     * 话题 添加
     */
    public function subject($id = null) {
        if ($this->request->is('post')) {
            $SubjectTable = \Cake\ORM\TableRegistry::get('meet_subject');
            $subject = $SubjectTable->newEntity();
            $subject = $SubjectTable->patchEntity($subject, $this->request->data());
            $subject->user_id = $this->user->id;
            if ($SubjectTable->save($subject)) {
                $this->Util->ajaxReturn(true, '添加成功');
            } else {
                $this->Util->ajaxReturn(false, '添加失败');
            }
        }
    }
    
    
    /***
     * 话题预约页
     */
    public function book($id = null){
        $SubjectTable = \Cake\ORM\TableRegistry::get('MeetSubject');
        $subject = $SubjectTable->find()
                ->contain(['User'=>function($q){
                    return $q->select(['id','truename','company','position']);
                }])
                ->where(['MeetSubject.id' => $id])
                ->first();
        if($this->request->is('ajax')){
            $this->handCheckLogin();
            $data['subject_id'] = $id;
            $data['summary'] = $this->request->data('summary');
            $data['user_id']  = $this->user->id;
            $data['savant_id']  = $subject->user->id;
            $BookTable = \Cake\ORM\TableRegistry::get('SubjectBook');
            $book = $BookTable->newEntity($data);
            if($BookTable->save($book)){
                $this->loadComponent('Business');
                $user_id = $subject->user->id;
                $this->Business->usermsg($user_id,'话题预约','您有新的话题预约请求',4,$book->id);
                $this->Util->ajaxReturn(true,'预定成功');
            }else{
                $error = errorMsg($book,'预定失败');
                $this->Util->ajaxReturn(false,$error);
            }
            
        }
        $this->set(compact('subject'));
    }
    
    /**
     * 预定成功页
     */
    public function bookSuccess(){
        
    }

    /**
     * 预约
     */
    public function meet() {
        
    }
    
    /**
     * 搜索页
     */
    public function search(){
        $this->set('search');
    }

    /**
     * ajax获取搜索结果
     */
    public function getSearchRes(){
        $data = $this->request->data();
        $keyword = $data['keyword'];
        $User = $this
                ->User
                ->find()
                ->contain(['Subjects'=>function($q)use($keyword){
                    return $q->where(['title like'=>'%'.$keyword.'%']);
                }])
                ->where(['enabled'=>'1', 'level'=>'2', 'truename like'=>'%'.$keyword.'%'])
                ->limit(10)
                ->toArray();
        if($User) {
            $this->Util->ajaxReturn(['status' => true, 'msg' => '', 'data' => $User]);
        } else {
            $this->Util->ajaxReturn(false, '暂无搜索结果');
        }
    }
    
    /**
     * 滑动搜索结果加载更多
     * @param int $page
     */
    public function getMoreSearch($page){
        $data = $this->request->data();
        $keyword = $data['keyword'];
        $User = $this
                ->User
                ->find()
                ->contain(['Subjects'=>function($q)use($keyword){
                    return $q->where(['title like'=>'%'.$keyword.'%']);
                }])
                ->where(['enabled'=>'1', 'level'=>'2', 'truename like'=>'%'.$keyword.'%'])
                ->page($page, $this->limit)
                ->toArray();
        if($User) {
            $this->Util->ajaxReturn(['status' => true, 'msg' => '', 'data' => $User]);
        } else {
            $this->Util->ajaxReturn(false, '暂无搜索结果');
        }
    }
    
    /**
     * 专家主页
     * @param type $id
     */
    public function myhome($id){
        if($this->user->id == $id)
        {
            $this->redirect('/home/index');
        }
        $user = $this->User->get($id, [
            'contain' => ['Industries', 'Careers', 'Educations'],
        ]);
        $this->set('user', $user);
    }
}
