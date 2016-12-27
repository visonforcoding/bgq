<?php

/**
 * @date : 2016-12-14
 * @author : Wash Cai <1020183302@qq.com>
 */

namespace App\Controller\Mobile;

use Wpadmin\Utils\Util;
use PhpParser\Node\Stmt\Switch_;
use App\Controller\Mobile\AppController;
/**
 * Course Controller  课程
 *
 * @property \App\Model\Table\CourseTable $Course
 * @property \App\Controller\Component\BusinessComponent $Business
 * @property \App\Controller\Component\PushComponent $Push
 */
class CourseController extends AppController {
    
    protected $limit = '10';
    
    /**
     * 获取导师列表
     */
    public function getSubscrMentor($page=NULL, $limit=NULL){
        $this->handCheckLogin();
        if($this->request->is('post')){
            $user_id = $this->user->id;
            $MentorTable = \Cake\ORM\TableRegistry::get('Mentor');
            $mentor = $MentorTable->find()
                    ->contain(['Classes'=>function($q){
                        return $q->where(['Classes.is_del'=>0]);
                    }, 'Classes.Courses'=>function($q){
                        return $q->where(['Courses.is_del'=>0]);
                    }])
                    ->matching('MentorSubscribes',function($q)use($user_id){
                        return $q->where(['MentorSubscribes.is_del'=>0, 'uid'=>$user_id]);
                    })
                    ->where(['Mentor.is_del'=>0])
                    ->page($page, $limit?$limit:$this->limit)
                    ->toArray();
            if($mentor){
                return $this->Util->ajaxReturn(true, '', $mentor);
            } elseif($mentor == []) {
                return $this->Util->ajaxReturn(false, '暂无订阅导师');
            } else {
                return $this->Util->ajaxReturn(false, '系统错误');
            }
        }
    }
    
    /**
     * 获取课程列表
     * @param type $page 分页
     */
    public function getCourse($page='', $limit='', $is_recom='', $is_free=''){
        if($this->request->is('post')){
            $CourseTable = \Cake\ORM\TableRegistry::get('Course');
            $contain = [];
            if($this->user){
                $user_id = $this->user->id;
                $contain = [
                    'CourseApplies'=>function($q)use($user_id){
                        return $q->where(['CourseApplies.is_pay'=>1, 'CourseApplies.user_id'=>$user_id]);
                    }
                ];
            } else {
                $contain = [];
            }
            $where = [];
            $where = ['Course.is_del'=>0, 'is_online'=>1];
            if($is_recom){
                $where['is_recom'] = 1;
            }
            if($is_free){
                $where['fee'] = 0;
            } elseif($is_free == '0'){
                $where['fee >'] = 0;
            }
            $course = $CourseTable->find()
                        ->contain($contain)
                        ->where($where)
                        ->page($page, $limit?$limit:$this->limit)
                        ->orderDesc('Course.update_time')
                        ->toArray();
            if($course){
                return $this->Util->ajaxReturn(true, '', $course);
            } elseif($course == []){
                return $this->Util->ajaxReturn(false, '暂无数据');
            } else {
                return $this->Util->ajaxReturn(false, '系统错误');
            }
        }
    }
    
    public function payCourse(){
        $this->set([
            'pageTitle' => '已购课程'
        ]);
    }
    
    /**
     * 已购课程
     */
    public function getPayCourse(){
        $this->handCheckLogin();
        if($this->request->is('post')){
            $user_id = $this->user->id;
            $CourseApplyTable = \Cake\ORM\TableRegistry::get('CourseApply');
            $course_apply = $CourseApplyTable->find()
                    ->contain(['Courses'=>function($q){
                        return $q->where(['Courses.is_del'=>0]);
                    }])
                    ->where(['CourseApply.is_pay'=>1, 'CourseApply.user_id'=>$user_id, 'CourseApply.is_del'=>0])
                    ->orderDesc('CourseApply.create_time')
                    ->toArray();
            if($course_apply){
                return $this->Util->ajaxReturn(true, '', $course_apply);
            } elseif($course_apply == []) {
                return $this->Util->ajaxReturn(false, '暂无购买课程');
            } else {
                return $this->Util->ajaxReturn(false, '系统错误');
            }
        }
    }
    
    public function search($keyword=NULL){
        $this->set([
            'pageTitle' => '课程搜索',
            'keyword' => $keyword,
        ]);
    }
    
    /**
     * 课程搜索
     * @param type $page
     */
    public function getSearchRes($page=''){
        if($this->request->is('post')){
            $data = $this->request->data;
            $CourseTable = \Cake\ORM\TableRegistry::get('Course');
            $course = $CourseTable->find()
                    ->distinct('Course.id')
                    ->contain(['Classes'=>function($q){
                        return $q->where(['Classes.is_del'=>0]);
                    }, 'Classes.Mentors'=>function($q){
                        return $q->where(['Mentors.is_del'=>0]);
                    }])
                    ->leftJoinWith('Classes.Mentors')
                    ->where(['or'=>[
                        'Course.title like'=>'%' . $data['keyword'] . '%',
                        'Course.abstract like'=>'%' . $data['keyword'] . '%',
                        'Mentors.name like'=>'%' . $data['keyword'] . '%',
                    ], 'Course.is_del'=>0, 'Course.is_online'=>1])
                    ->orderDesc('Course.create_time')
                    ->toArray();
            if($course){
                return $this->Util->ajaxReturn(true, '', $course);
            } elseif($course == []){
                return $this->Util->ajaxReturn(false, '暂无搜索结果');
            } else {
                return $this->Util->ajaxReturn(false, '系统错误');
            }
        }
    }
    
    /**
     * 培训首页
     */
    public function index(){
        $courseType = \Cake\Core\Configure::read('courseType');
        $this->set([
            'pageTitle' => '培训',
            'courseType' => $courseType
        ]);
    }
    
    /**
     * banner图
     */
    public function getBanner(){
        $BannerTable = \Cake\ORM\TableRegistry::get('banner');
        $banner = $BannerTable->find()
                ->where(['type'=>4, 'enabled'=>1])
                ->orderDesc('create_time')
                ->limit(3)
                ->toArray();
        return $this->Util->ajaxReturn(true, '', $banner);
    }
    
    /**
     * 课程全部页面
     * @param type $page
     * @param type $limit
     * @param type $is_recom
     * @param type $is_free
     */
    public function allCourse($page=NULL, $limit=NULL, $is_recom=NULL, $is_free=NULL){
        if($is_recom){
            $pageTitle = '推荐课程';
        }
        if($is_free !== 0){
            $pageTitle = '免费收听';
        } else {
            $pageTitle = '付费课程';
        }
        $this->set([
            'pageTitle' => $pageTitle,
            'page' => $page,
            'limit' => $limit,
            'is_recom' => $is_recom,
            'is_free' => $is_free
        ]);
    }
    
    public function allMentor(){
        $this->set([
            'pageTitle'=>'全部订阅导师'
        ]);
    }
    
    /**
     * 培训详情页
     * @param type $id 培训id
     */
    public function detail($id=null){
        $CourseTable = \Cake\ORM\TableRegistry::get('Course');
        $contain = [
            'Classes'=>function($q){
                return $q->where(['Classes.is_del'=>0])->orderAsc('Classes.sort');
            }, 'Classes.Mentors'=>function($q){
                return $q->where(['Mentors.is_del'=>0]);
            }
        ];
        if($this->user){
            $user_id = $this->user->id;
            $contain['Classes.ClassLearns'] = function($q)use($user_id){
                return $q->where(['uid'=>$user_id]);
            };
            $contain['CourseApplies'] = function($q)use($user_id){
                return $q->where(['user_id'=>$user_id]);
            };
        }
        $course = $CourseTable->get($id, [
            'contain'=>$contain,
            'conditions'=>[
                'Course.is_del' => 0
            ]
        ]);
//        debug($course);die;
        if($this->request->is('weixin') || $this->request->is('lemon')){
            $course->read_nums += 1;
            $CourseTable->save($course);
        }
        $course->class_nums = count($course->classes);
//        debug($course);die;
        $this->set([
            'pageTitle' => $course->title,
            'course' => $course
        ]);
    }
    
    public function getMentorData($id=NULL){
        $contain = [];
        if($this->user){
            $user_id = $this->user->id;
            $contain = ['MentorSubscribe'=>function($q)use($user_id){
                return $q->where(['uid'=>$user_id]);
            }];
        }
        $MentorTable = \Cake\ORM\TableRegistry::get('Mentor');
        $mentor = $MentorTable->find()
                ->contain($contain)
                ->where(['Mentor.is_del'=>0])
                ->toArray();
        if($mentor){
            return $this->Util->ajaxReturn(true, '', $mentor);
        } else {
            return $this->Util->ajaxReturn(false, '系统错误');
        }
    }
    
    public function subscrMentor($id=NULL){
        $this->handCheckLogin();
        if($this->request->is('post')){
            $MentorSubscribeTable = \Cake\ORM\TableRegistry::get('MentorSubscribe');
            $mentorSubscribe = $MentorSubscribeTable->find()
                    ->where(['uid'=>$this->user->id, 'mentor_id'=>$id])->first();
            if($mentorSubscribe){
                $mentorSubscribe->is_del = $mentorSubscribe->is_del ? 0 : 1;
            } else {
                $data = [
                    'mentor_id' => $id,
                    'uid' => $this->user->id,
                    'is_del' => 0
                ];
                $mentorSubscribe = $MentorSubscribeTable->newEntity($data);
            }
            $res = $MentorSubscribeTable->save($mentorSubscribe);
            if($res){
                if($res->is_del){
                    return $this->Util->ajaxReturn(true, '取消订阅成功', $res->is_del);
                } else {
                    return $this->Util->ajaxReturn(true, '订阅成功', $res->is_del);
                }
            } else {
                return $this->Util->ajaxReturn(false, '订阅失败');
            }
        }
    }
    
    public function chargeOrder($money=NULL){
        $this->handCheckLogin();
        if($this->request->is('post')){
            $gift = 0;
            $RechargeGiftTable = \Cake\ORM\TableRegistry::get('RechargeGift');
            $rechargeGift = $RechargeGiftTable->find()->all()->toArray();
            for($i=0;$i<count($rechargeGift);$i++){
                if($money >= $rechargeGift[$i]->recharge_money){
                    $gift = $rechargeGift[$i]->gift;
                }
            }
            $OrderTable = \Cake\ORM\TableRegistry::get('Order');
            $order = $OrderTable->newEntity([
                'type' => 3, // 类型为充值
                'relate_id' => 0, //充值
                'user_id' => $this->user->id,
                'seller_id' => $this->user->id,     //活动报名的收入 固定给-1 的用户
                'order_no' => time() . $this->user->id . createRandomCode(4, 1),
                'fee' => 0, // 实际支付的默认值
                'price' => $money,
                'remark' => '充值余额',
                'gift' => $gift
            ]);
            \Cake\Log\Log::debug($order, 'devlog');
            $order = $OrderTable->save($order);
            if($order){
                return $this->Util->ajaxReturn(true, '', $order->id);
            } else {
                return $this->Util->ajaxReturn(false, '系统错误');
            }
        }
    }
    
    /**
     * 删除已购培训
     * @param type $id 培训id
     */
    public function delPayCourse($id=NULL){
        $this->handCheckLogin();
        if($this->request->is('post')){
            $CourseApplyTable = \Cake\ORM\TableRegistry::get('CourseApply');
            $courseApply = $CourseApplyTable->find()->where(['CourseApply.course_id'=>$id])->first();
            $courseApply->is_del = 1;
            $res = $CourseApplyTable->save($courseApply);
            if($res){
                return $this->Util->ajaxReturn(true, '删除成功');
            } else {
                return $this->Util->ajaxReturn(false, '删除失败');
            }
        }
    }
    
}