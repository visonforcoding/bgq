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

    /**
     * Index method  专家约见首页
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        
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
        $savant = $this->User->get($id, ['contain' => ['Savant', 'Subjects']]);
        $this->set([
            'savant' => $savant
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

}
