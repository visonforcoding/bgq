<?php

/**
 * @date : 2016-5-5
 * @author : Wash Cai <1020183302@qq.com>
 */

namespace App\Controller\Mobile;

use Wpadmin\Utils\Util;
use PhpParser\Node\Stmt\Switch_;
use App\Controller\Mobile\AppController;
/**
 * Activity Controller  活动
 *
 * @property \App\Model\Table\ActivityTable $Activity
 * @property \App\Controller\Component\BusinessComponent $Business
 * @property \App\Controller\Component\PushComponent $Push
 */
class ActivityController extends AppController {

    protected $limit = '10'; // 分页条数

    /**
     * 活动详情
     */

    public function details($id = '') {
        if ($id) {
            $isLike = '';
            $isCollect = '';
            $savant = '';
            // 已报名的人
            $allApply = $this->Activity->Activityapply->find()
                    ->contain(['Users'=>function($q){
                        return $q->where(['Users.enabled'=>1]);
                    }])
                    ->where(['activity_id' => $id, 'is_pass'=>1])
                    ->order([
                        'Activityapply.is_top' => 'DESC',
                        'Activityapply.create_time' => 'DESC'
                    ])
                    ->hydrate(false)
                    ->toArray();
            if ($allApply != '') {
                $userApply = [];
                foreach ($allApply as $k => $v) {
                    $userApply[] = $v['user'];
                }
                $this->set('userApply', $userApply);
            }
            $order = [];
            if ($this->user) {
                // 是否已赞
                $isLike = $this->Activity->Likelogs->find()
                        ->where(['user_id' => $this->user->id, 'relate_id' => $id, 'type' => 0])
                        ->first();
                // 是否已收藏
                $isCollect = $this
                        ->Activity
                        ->Collect
                        ->find()
                        ->where(['user_id' => $this->user->id, 'relate_id' => $id, 'type' => 0])
                        ->first();
                if ($isCollect) {
                    $isCollect = !$isCollect['is_delete'];
                } else {
                    $isCollect = 0;
                }

                $this->set('user', $this->user->id);
                $user_id = $this->user->id;
                // 活动详情
                
                if(strpos($this->request->referer(), 'admin') === FALSE){
                    $activity = $this->Activity->get($id, [
                        'contain' => [
                            'Admins','Industries','Regions','Savants',
                            'Activity_recommends',
                            'Activityapply' => function($q)use($user_id){
                                return $q->where(['user_id'=>$user_id]);
                            },
                            'Activitycom' => function($q)use($id){
                                return $q->where(['activity_id'=>$id, 'is_delete'=>0])->orderDesc('Activitycom.create_time')->limit($this->limit);
                            },
                            'Activitycom.Users'=>function($q){
                                return $q->where(['Users.enabled'=>1]);
                            },
                            'Activitycom.Replyusers'=>function($q){
                                return $q->where(['Replyusers.enabled'=>1]);
                            },
                            'Activitycom.Likes'=>function($q)use($user_id){
                                return $q->where(['type'=>0,'user_id'=>$user_id]);
                            }
                        ],
                        'conditions' => [
                            'status' => 1,
                        ]
                    ]);
                } else {
                    $activity = $this->Activity->get($id, [
                        'contain' => [
                            'Admins','Industries','Regions','Savants',
                            'Activity_recommends',
                            'Activityapply' => function($q)use($user_id){
                                return $q->where(['user_id'=>$user_id]);
                            },
                            'Activitycom' => function($q)use($id){
                                return $q->where(['activity_id'=>$id, 'is_delete'=>0])->orderDesc('Activitycom.create_time')->limit($this->limit);
                            },
                            'Activitycom.Users'=>function($q){
                                return $q->where(['Users.enabled'=>1]);
                            },
                            'Activitycom.Replyusers'=>function($q){
                                return $q->where(['Replyusers.enabled'=>1]);
                            },
                            'Activitycom.Likes'=>function($q)use($user_id){
                                return $q->where(['type'=>0,'user_id'=>$user_id]);
                            }
                        ],
                    ]);
                }
                $orderTable = \Cake\ORM\TableRegistry::get('order');
                if($activity->activityapply){
                    if($activity->activityapply['0']->is_pass == 0){
                        $order = $orderTable->find()->where(['type'=>2, 'relate_id'=>$activity->activityapply['0']->id, 'user_id'=>$this->user->id])->first();
                    }
                }
            } else {
                if(strpos($this->request->referer(), 'admin') === FALSE){
                    $activity = $this->Activity->get($id, [
                        'contain' => [
                            'Admins',
                            'Industries',
                            'Regions',
                            'Savants',
                            'Activity_recommends',
                            'Activitycom' => function($q)use($id){
                                return $q->where(['activity_id'=>$id, 'is_delete' => 0])->orderDesc('Activitycom.create_time')->limit($this->limit);
                            },
                            'Activitycom.Users'=>function($q){
                                return $q->where(['Users.enabled'=>1]);
                            },
                            'Activitycom.Replyusers'=>function($q){
                                return $q->where(['Replyusers.enabled'=>1]);
                            },
                        ],
                        'conditions' => [
                            'status' => 1
                        ]
                    ]);
                } else {
                    $activity = $this->Activity->get($id, [
                        'contain' => [
                            'Admins',
                            'Industries',
                            'Regions',
                            'Savants',
                            'Activity_recommends',
                            'Activitycom' => function($q)use($id){
                                return $q->where(['activity_id'=>$id, 'is_delete' => 0])->orderDesc('Activitycom.create_time')->limit($this->limit);
                            },
                            'Activitycom.Users'=>function($q){
                                return $q->where(['Users.enabled'=>1]);
                            },
                            'Activitycom.Replyusers'=>function($q){
                                return $q->where(['Replyusers.enabled'=>1]);
                            },
                        ],
                    ]);
                }
                $this->set('user', '');
            }
            foreach($activity->activitycom as $k=>$v){
                $activity->activitycom[$k]->user->avatar = getSmallAvatar($v->user->avatar);
            }
            $activity->read_nums += 1; // 阅读加1
            $this->Activity->save($activity);
            $this->set([
                'pageTitle'=>'并购帮',
                'activity'=>$activity,
                'isCollect'=>$isCollect,
                'isLike'=>$isLike,
                'order'=>$order,
            ]);
        } else {
            return $this->Util->ajaxReturn(false, '传值错误');
        }
    }

    /**
     * 活动列表
     */
    public function index() {
        $isApply = [];
        if ($this->user) {
            // 用户已报名的活动
            $activityApply = $this
                    ->Activity
                    ->Activityapply
                    ->find()
                    ->where(['user_id' => $this->user->id, 'is_pass'=>1])
                    ->select(['activity_id'])
                    ->hydrate(false)
                    ->toArray();
            $isApply = [];
            foreach ($activityApply as $k => $v) {
                $isApply[] = $v['activity_id'];
            }
        }
        $activityseries = \Cake\Core\Configure::read('activitySeries');
        $isApply = implode(',', $isApply);
        $this->set([
            'pageTitle'=>'活动',
            'user'=>$this->user,
            'isApply'=>$isApply,
            'activityseries'=>$activityseries,
        ]);
    }

    /**
     * 我要推荐
     */
    public function recommend($id) {
        if ($this->request->is('post')) {
            $this->handCheckLogin();
            $data = $this->request->data();
            if($data['description'] == '')
            {
                return $this->Util->ajaxReturn(false, '请输入内容');
            }
            $data['user_id'] = $this->user->id;
            $data['activity_id'] = $id;
            $sponsorTable = \Cake\ORM\TableRegistry::get('sponsor');
            $sponsor = $sponsorTable->newEntity();
            $formdata = $sponsorTable->patchEntity($sponsor, $data);
            $res = $sponsorTable->save($formdata);
            if ($res) {
                return $this->Util->ajaxReturn(true, '推荐成功');
            } else {
                return $this->Util->ajaxReturn(false, '系统错误');
            }
        } else {
            $this->set('pageTitle', '我要推荐');
            $this->set('activity_id', $id);
        }
    }

    /**
     * 我要报名
     */
    public function enroll($id = '') {
        $this->handCheckLogin();
        
        if ($id) {
            $activity = $this->Activity->get($id, [
                'contain' => ['Users'=>function($q){
                            return $q->where(['enabled'=>1]);
                        }],
            ]);
            if ($this->request->is('post')) {
                $UserTable = \Cake\ORM\TableRegistry::get('user');
                $user = $UserTable->get($this->user->id, [
                    'contain' => ['Careers', 'Educations', 'Industries']
                ]);
                //公司、性别、职位、邮箱、行业标签、城市、擅长业务、公司业务、教育经历、工作经历、名片
                $is_complete = $user->company && $user->gender && $user->position && $user->email 
                        && $user->industries && $user->city && $user->goodat && $user->gsyw && $user->card_path;
                if(!$is_complete){
                    return $this->Util->ajaxReturn(false, '请先去完善个人资料');
                }
                $activityApply = $this->Activity->Activityapply->newEntity();
                $data = [
                    'user_id' => $this->user->id,
                    'activity_id' => $id,
                ];
                $activityApply = $this->Activity->Activityapply->patchEntity($activityApply, $data);
                if ($this->Activity->Activityapply->find()->where($data)->first()) { // 查找数据库是否有对应数据，即是否已报名
                    return $this->Util->ajaxReturn(false, '已经报名过了');
                } else {
                    if($activity->must_check){
                        if($activity->apply_fee == 0){
                            $activityApply->is_check = 0;
                            $activityApply->is_pass = 0;
                            if ($this->Activity->Activityapply->save($activityApply)) {
                                return $this->Util->ajaxReturn(['status'=>true, 'msg'=>'提交成功', 'url'=>'/activity/details/'.$id.'/enroll']);
                            } else {
                                return $this->Util->ajaxReturn(false, $activityApply->errors());
                            }
                        } else {
                            $activityApply = $this->Activity->Activityapply->save($activityApply);
                            $activityApply->is_check = 0;
                            $activityApply->is_pass = 0;
                            $OrderTable = \Cake\ORM\TableRegistry::get('order');
                            $applyTable = \Cake\ORM\TableRegistry::get('activityapply');
                            $order = $OrderTable->newEntity([
                                'type' => 2, // 类型为活动报名
                                'relate_id' => $activityApply->id, //预定表的id
                                'user_id' => $this->user->id,
                                'seller_id' => -1,     //活动报名的收入 固定给-1 的用户
                                'order_no' => time() . $activity->user_id . $id . createRandomCode(2, 2),
                                'fee' => 0, // 实际支付的默认值
                                'price' => $activity->apply_fee,
                                'remark' => '活动报名' . $activity->title
                            ]);
                            $transRes = $applyTable->connection()->transactional(function()use($activityApply, $applyTable, $order, $OrderTable) {
                                return $applyTable->save($activityApply) && $OrderTable->save($order);
                            });
                            if($transRes){
                                $order = $OrderTable->find()->where(['relate_id'=>$activityApply->id, 'type'=>2, 'user_id'=>$this->user->id])->first();
    //                            //短信和消息通知
                                $this->loadComponent('Sms');
                                if($activity->must_check){
                                    $msg = "您报名的活动：《" . $activity->title . "》申请已提交，我们会在三个工作日之内审核。";
                                } else {
                                    $msg = "您报名的活动：《" . $activity->title . "》已确认通过，请及时登录平台支付报名费用。";
                                }
                                $this->Sms->sendByQf106($this->user->phone, $msg);
                                $this->loadComponent('Business');
                                $this->Business->usermsg('-1', $this->user->id, '报名通知', $msg, 7, $id);
                                return $this->Util->ajaxReturn(['status'=>true, 'msg'=>'提交成功', 'url'=>'/activity/index']);
                            } else {
                                return $this->Util->ajaxReturn(false, $activityApply->errors());
                            }
                        }
                    } else {
                        if($activity->apply_fee == 0){
                            if($activity->apply_nums <= $activity->scale){
                                $activityApply->is_pass = 1;
                                if ($this->Activity->Activityapply->save($activityApply)) {
                                    $activity->apply_nums += 1;
                                    $this->Activity->save($activity);
                                    return $this->Util->ajaxReturn(['status'=>true, 'msg'=>'提交成功', 'url'=>'/activity/details/'.$id.'/enroll']);
                                } else {
                                    return $this->Util->ajaxReturn(false, $activityApply->errors());
                                }
                            } else {
                                return $this->Util->ajaxReturn(false, '报名人数已满');
                            }
                        } else {
                            $activityApply = $this->Activity->Activityapply->save($activityApply);
                            $activityApply->is_pass = 0;
                            $OrderTable = \Cake\ORM\TableRegistry::get('order');
                            $applyTable = \Cake\ORM\TableRegistry::get('activityapply');
                            $order = $OrderTable->newEntity([
                                'type' => 2, // 类型为活动报名
                                'relate_id' => $activityApply->id, //预定表的id
                                'user_id' => $this->user->id,
                                'seller_id' => $activity->user_id,
                                'order_no' => time() . $activity->user_id . $id . createRandomCode(2, 2),
                                'fee' => 0, // 实际支付的默认值
                                'price' => $activity->apply_fee,
                                'remark' => '活动报名' . $activity->title
                            ]);
                            $transRes = $applyTable->connection()->transactional(function()use($activityApply, $applyTable, $order, $OrderTable) {
                                return $applyTable->save($activityApply) && $OrderTable->save($order);
                            });
                            if($transRes){
                                $order = $OrderTable->find()->where(['relate_id'=>$activityApply->id, 'type'=>2, 'user_id'=>$this->user->id])->first();
    //                            //短信和消息通知
                                $this->loadComponent('Sms');
                                if($activity->must_check){
                                    $msg = "您报名的活动：《" . $activity->title . "》申请已提交，我们会在三个工作日之内审核。";
                                } else {
                                    $msg = "您报名的活动：《" . $activity->title . "》已确认通过，请及时登录平台支付报名费用。";
                                }
                                $this->Sms->sendByQf106($this->user->phone, $msg);
                                $this->loadComponent('Business');
                                $this->Business->usermsg('-1', $this->user->id, '报名通知', $msg, 7, $id);
                                return $this->Util->ajaxReturn(['status'=>true, 'msg'=>'提交成功', 'url'=>'/Wx/meet_pay/2/'.$order->id]);
                            } else {
                                return $this->Util->ajaxReturn(false, $activityApply->errors());
                            }
                        }
                    }
                }
            }
            $this->set('activity', $activity);
            $this->set('user', $this->user);
            $this->set('pageTitle', '我要报名');
        } else {
            return $this->Util->ajaxReturn(false, '传值错误');
        }
    }

    /**
     * 发布活动
     */
    public function release($id=null) {
        $ActivityNeed = \Cake\ORM\TableRegistry::get('activityneed');
        $this->handCheckLogin();
        if ($this->request->is('post')) {
            $this->handCheckLogin();
            $UserTable = \Cake\ORM\TableRegistry::get('user');
            $user = $UserTable->get($this->user->id, [
                'contain' => ['Careers', 'Educations', 'Industries']
            ]);
            $is_complete = $user->company && $user->gender && $user->position && $user->email && $user->industries && $user->city && $user->goodat && $user->gsyw && $user->card_path;
            if(!$is_complete){
                return $this->Util->ajaxReturn(false, '请先去完善个人资料');
            }
            $data = $this->request->data();
            $activityNeed = $ActivityNeed->newEntity();
            $industry = $ActivityNeed->patchEntity($activityNeed, $data);
            $industry->company = $user->company;
            $industry->user_id = $user->id;
            $industry->truename = $user->truename;
            $industry->position = $user->position;
            if ($ActivityNeed->save($industry)) {
                return $this->Util->ajaxReturn(true, '提交成功');
            } else {
                return $this->Util->ajaxReturn(false, '提交失败');
            }
        } else {
            $activity = [];
            if($id){
                $activity = $ActivityNeed->get($id);
            }
            $this->set('activity', $activity);
            $this->set('pageTitle', '提交需求');
        }
    }

    /**
     * 评论点赞
     * @param int $id 评论id
     */
    public function comLike($id) {
        $this->handCheckLogin();
        $this->loadComponent('Business');
        $res = $this->Business->commentPraise($this->user->id, $id, 0);
        if ($res !== false) {
            if ($res !== true) {
                return $this->Util->ajaxReturn(false, $res);
            }
            return $this->Util->ajaxReturn(true, $res);
        } else {
            return $this->Util->ajaxReturn(false, '系统错误');
        }
    }

    /**
     * 文章点赞
     * @param int $id 文章id
     */
    public function artLike($id) {
        $this->handCheckLogin();
        $this->loadComponent('Business');
        $res = $this->Business->praise($this->user->id, $id, 0);
        if($res===true){
            return $this->Util->ajaxReturn(true,'点赞成功');
        } elseif($res == '取消点赞成功'){
            return $this->Util->ajaxReturn(true,'取消点赞成功');
        }else{
            return $this->Util->ajaxReturn(false, $res);
        }
    }

    /**
     * 收藏动作
     * @param int $id 文章id
     */
    public function collect($id) {
        $this->handCheckLogin();
        $this->loadComponent('Business');
        $res = $this->Business->collectIt($this->user->id, $id, 0);
        if ($res !== false) {
            $res['status'] = true;
            return $this->Util->ajaxReturn($res);
        } else {
            return $this->Util->ajaxReturn(false, '系统错误');
        }
    }

    /**
     * 活动搜索
     */
    public function search($id='') {
        $isApply = '';
        if ($this->user) {
            // 用户已报名的活动
            $activityApply = $this
                            ->Activity
                            ->Activityapply
                            ->find()
                            ->where(['user_id' => $this->user->id])
                            ->select(['activity_id'])
                            ->hydrate(false)
                            ->toArray();
            if ($activityApply) {
                foreach ($activityApply as $k => $v) {
                    $isApply[] = $v['activity_id'];
                }
                $isApply = implode(',', $isApply);
            }
        }
        $this->set('isApply', $isApply);
        $region = $this->Activity->Regions->find()->hydrate(false)->all()->toArray();
//        $industries = $this->Activity->Industries->find()->hydrate(false)->all()->toArray();
        $activitySeries = \Cake\Core\Configure::read('activitySeries');
//        $this->set('industries', $industries);
        $this->set([
            'pageTitle'=>'活动搜索',
            'activitySeries'=>$activitySeries,
            'regions'=>$region,
            'sid' => $id,
        ]);
    }
    
    /**
     * 搜索结果
     */
    public function getSearchRes() {
        $data = $this->request->data();
        $series_id = $data['series_id'];
        $isApply = [];
        if ($this->user) {
            // 用户已报名的活动
            $activityApply = $this
                            ->Activity
                            ->Activityapply
                            ->find()
                            ->where(['user_id' => $this->user->id])
                            ->select(['activity_id'])
                            ->hydrate(false)
                            ->toArray();
            foreach ($activityApply as $k => $v) {
                $isApply[] = $v['activity_id'];
            }
            $isApply = implode(',', $isApply);
        }
        $this->set('is_apply', $isApply);
        
        $res = $this
                ->Activity
                ->find()
                ->where(['title LIKE' => '%' . $data['keyword'] . '%'])
                ->orWhere(['body LIKE' => "%" . $data['keyword'] . "%"])
                ->andWhere(['Activity.status'=> 1, 'Activity.is_del' => 0]);
        if ($series_id !== '') {
            $res = $res->andWhere(['series_id'=>$series_id]);
        }
        if($data['region']){
            $res = $res->andWhere(['region_id'=>$data['region']]);
        }
        $res = $res->orderDesc('create_time'); // 默认按时间倒序排列
        $res = $res
                ->limit($this->limit)
                ->toArray();
        if ($res!==false) {
            if($res == []) {
                return $this->Util->ajaxReturn(false, '暂无搜索结果');
            }
            return $this->Util->ajaxReturn(['status' => true, 'data' => $res]);
        } else {
            return $this->Util->ajaxReturn(false, '系统错误');
        }
    }
    
    /**
     * 加载更多搜索结果
     * @param int $page 页数
     */
    public function getMoreSearch($page){
        $data = $this->request->data();
        $series_id = $data['series_id'];
        $isApply = [];
        if ($this->user) {
            // 用户已报名的活动
            $activityApply = $this
                            ->Activity
                            ->Activityapply
                            ->find()
                            ->where(['user_id' => $this->user->id])
                            ->select(['activity_id'])
                            ->hydrate(false)
                            ->toArray();
            foreach ($activityApply as $k => $v) {
                $isApply[] = $v['activity_id'];
            }
            $isApply = implode(',', $isApply);
        }
        $this->set('is_apply', $isApply);
        
        $res = $this->Activity->find()->where(['title LIKE' => '%' . $data['keyword'] . '%', 'series_id' => $series_id, 'Activity.status'=> 1, 'Activity.is_del' => 0]);
        $res = $res->orderDesc('create_time')
                ->page($page, $this->limit)
                ->toArray();
        if ($res) {
            return $this->Util->ajaxReturn(['status' => true, 'data' => $res]);
        } else {
            return $this->Util->ajaxReturn(['status' => false]);
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
     * 发布活动时选择的行业标签
     */
    public function industries() {
        $IndustryTable = \Cake\ORM\TableRegistry::get('industry');
        $industries = $IndustryTable->find('threaded', [
                    'keyField' => 'id',
                    'parentField' => 'pid'
                ])->where("`id` != '3'")->hydrate(false)->toArray();
        $this->set(array(
            'industries' => $industries
        ));
        $this->set('pageTitle', '行业标签');
    }

    /**
     * 评论动作
     * @param int $id 活动id
     * @param int $pid 父id
     */
    public function doComment($id) {
        $this->loadComponent('Business');
        if ($this->request->is('post')) {
            $this->handCheckLogin();
            $data = $this->request->data();
            $data['body'] = trim($data['body']);
            if ($data['body'] == '') {
                return $this->Util->ajaxReturn(false, '内容不能为空');
            } elseif(mb_strlen($data['body']) > 300){
                return $this->Util->ajaxReturn(false, '请控制评论内容300字以下');
            }
            $patt = $this->Util->loadWordPatt();
            if(preg_match($patt, $data['body'])){
                $data['body_origin'] = $data['body'];
                $data['body'] = preg_replace($patt, '**', $data['body']);
            }
            $data['user_id'] = $this->user->id;
            $data['activity_id'] = $id;
            $activitycom = $this->Activity->Activitycom->newEntity();
            $doComment = $this->Activity->Activitycom->patchEntity($activitycom, $data);
            if ($data['pid']) {
                $comment = $this->Activity->Activitycom->get($data['pid']);
                $doComment->reply_id = $comment->user_id;
//                $this->Business->usermsg($this->user->id, '', '', $type, $id);
            } else {
                $user = $this->Activity->get($id);
                $doComment->reply_id = $user->user_id;
//                $this->Business->usermsg();
            }
            $res = $this->Activity->Activitycom->save($doComment);
            $newComment[] = $this->Activity->Activitycom->get($res->id, ['contain'=>["Users"=>function($q){
                            return $q->where(['Users.enabled'=>1]);
                        }, "Replyusers"=>function($q){
                            return $q->where(['Replyusers.enabled'=>1]);
                        }]])->toArray();
            if ($res) {
                if ($data['pid']) {
                    //对评论的回复
                    $this->loadComponent('Business');
                    $jump_url = '/home/comment-view/'.$data['pid'].'?type=2';
                    $this->Business->usermsg($this->user->id, $comment->user_id, '评论回复', '有人回复了你的评论!', 9, $doComment->id, $jump_url);
                }
                $activity = $this->Activity->get($id);
                $activity->comment_nums += 1;
                $this->Activity->save($activity);
                return $this->Util->ajaxReturn(['status' => true, 'msg' => '评论成功', 'data' => $newComment]);
            } else {
                return $this->Util->ajaxReturn(false, '系统错误');
            }
        } else {
            return $this->Util->ajaxReturn(false, '非法操作');
        }
    }

    /**
     * 记录点赞日志
     * @param int $id 活动id
     * @param int $user_id 用户id
     * @return boolean true: 记录成功; false: 记录失败
     */
    public function likeLog($id, $user_id) {
        $activity = $this->Activity->get($id);
        $userTable = \Cake\ORM\TableRegistry::get('user');
        $user = $userTable->find()->where(['id' => $user_id, 'enabled'=>1])->hydrate(false)->first();
        $msg = $user['truename'] . ' 于' . date('Y-m-d H:i:s', time()) . '对 ' . $activity->title . ' 点了赞';
        $data = [
            'relate_id' => $id,
            'user_id' => $user_id,
            'type' => 0,
            'msg' => $msg,
        ];
        $likeLogsTable = \Cake\ORM\TableRegistry::get('LikeLogs');
        $likeLogs = $likeLogsTable->newEntity();
        $like = $likeLogsTable->patchEntity($likeLogs, $data);
        return $likeLogsTable->save($like, ['associated' => false]);
    }

    /**
     * 记录收藏日志
     * @param int $id 活动id
     * @param int $user_id 用户id
     * @return boolean true: 记录成功; false: 记录失败
     */
    public function collectLog($id, $user_id) {
        $activity = $this->Activity->get($id);
        $userTable = \Cake\ORM\TableRegistry::get('user');
        $user = $userTable->find()->where(['id' => $user_id, 'enabled'=>1])->hydrate(false)->first();
        $msg = $user['truename'] . ' 于' . date('Y-m-d H:i:s', time()) . '收藏了 ' . $activity->title;
        $data = [
            'relate_id' => $id,
            'user_id' => $user_id,
            'type' => 0,
            'msg' => $msg,
        ];
        $collectLogsTable = \Cake\ORM\TableRegistry::get('collectlogs');
        $collectLogs = $collectLogsTable->newEntity();
        $collect = $collectLogsTable->patchEntity($collectLogs, $data);
        return $collectLogsTable->save($collect, ['associated' => false]);
    }

    /**
     * ajax获取更多活动内容
     * @param int $page 分页
     */
    public function getMoreActivity($page) {
        $activity = $this->Activity
                        ->find()
                        ->select(['id', 'thumb', 'title', 'address', 'apply_nums', 'time', 'region_id', 'series_id'])
                        ->contain(['Industries'])
                        ->where(['Activity.status' => 1,'Activity.is_del'=>0, 'Activity.from_user >'=>-1])
                        ->page($page, $this->limit)
                        ->order(['Activity.is_top'=>'desc', 'Activity.create_time'=>'desc'])
                        ->toArray();
        foreach($activity as $k=>$v){
            if($v->time){
                $now = \Cake\I18n\Time::now();
                if($v->time < $now){
                    $activity[$k]['pass_time'] = 1;
                } else {
                    $activity[$k]['pass_time'] = 0;
                }
                $v->time = $v->time->format('Y-m-d');
            }
        }
        if ($activity) {
            return $this->Util->ajaxReturn(['status' => true, 'data' => $activity]);
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
        $comment = $this->Activity
                        ->Activitycom
                        ->find()
                        ->where(['activity_id' => $id, 'is_delete' => 0])
                        ->contain(['Users'=>function($q){
                            return $q->where(['Users.enabled'=>1]);
                        }, 'Replyusers'=>function($q){
                            return $q->where(['Replyusers.enabled'=>1]);
                        }])
                        ->page($page, $this->limit)
                        ->orderDesc('Activitycom.create_time')
                        ->toArray();
        if ($comment) {
            return $this->Util->ajaxReturn(['status' => true, 'data' => $comment]);
        } else {
            return $this->Util->ajaxReturn(['status' => false]);
        }
    }
    
    /**
     * 显示全部评论页面
     * @param int $id 活动id
     */
    public function showAllComment($id){
        if($this->user){
            $user_id = $this->user->id;
            // 评论
            $comment = $this
                    ->Activity
                    ->Activitycom
                    ->find()
                    ->contain(['Users'=>function($q){
                            return $q->where(['Users.enabled'=>1]);
                        }, 'Replyusers'=>function($q){
                            return $q->where(['Replyusers.enabled'=>1]);
                        }, 'Likes'=>function($q)use($user_id){
                            return $q->where(['type'=>0,'user_id'=>$user_id]);
                        }])
                    ->where(['activity_id' => $id, 'is_delete'=>0])
                    ->order(['Activitycom.create_time' => 'DESC'])
                    ->limit(10)
                    ->toArray();
        } else {
            $comment = $this
                    ->Activity
                    ->Activitycom
                    ->find()
                    ->contain(['Users'=>function($q){
                            return $q->where(['Users.enabled'=>1]);
                        }, 'Replyusers'=>function($q){
                            return $q->where(['Replyusers.enabled'=>1]);
                        }])
                    ->where(['activity_id' => $id, 'is_delete'=>0])
                    ->order(['Activitycom.create_time' => 'DESC'])
                    ->limit(10)
                    ->toArray();
        }
        if ($comment) {
            return $this->Util->ajaxReturn(['status' => true, 'data' => $comment]);
        } else {
            return $this->Util->ajaxReturn(['status' => false]);
        }
    }
    
    /**
     * 活动签到，用于生成二维码
     * @param int $id
     */
    public function sign($id){
        $this->handCheckLogin();
        $this->set('pageTitle', '活动签到');
        $activity = $this->Activity->get($id);
        if(!$activity)
        {
            $this->set('res', '活动不存在');
            return;
        }
        $is_apply = $this->Activity->Activityapply->find()->where(['user_id'=>$this->user->id, 'activity_id'=>$id])->first();
        if(!$is_apply)
        {
            $this->set('res', '未报名此活动');
            return;
        }
        $apply = $this->Activity->Activityapply->get($is_apply->id);
        if($apply->is_sign == 1)
        {
            $this->set('res', '您已经签到了，请勿重复扫码');
            return;
        }
        $apply->is_sign = 1;
        $res = $this->Activity->Activityapply->save($apply);
        if($res)
        {
            $content = '<a style="color:blue;text-decoration:underline;" href="/activity/details/'. $activity->id .'">' . $activity->title . '</a>签到成功!';
            $this->set('res', $content);
            return;
        }
        else
        {
            $this->set('res', '系统错误');
            return;
        }
    }
    
    /**
     * 查看全部报名的人
     * @param int $id 活动id
     */
    public function allEnroll($id){
        $activityApplyTable = \Cake\ORM\TableRegistry::get('activityapply');
        $user = $activityApplyTable->find()->where(['activity_id' => $id, 'is_pass'=>1])->contain(['Users'=>function($q){
            return $q->where(['Users.enabled'=>1]);
        }])->toArray();
        $activity = $this->Activity->get($id);
        $this->set([
            'pageTitle'=>$activity->title,
            'userjson' => json_encode($user),
        ]);
    }
    
    /**
     * ajax获取banner图
     */
    public function getBanner(){
        // 轮播图
        $bannerTable = \Cake\ORM\TableRegistry::get('banner');
        $banners = $bannerTable
                ->find()
                ->where("`enabled` = '1' and `type` = '2'")
                ->orderDesc('create_time')
                ->limit(3)
                ->toArray();
        return $this->Util->ajaxReturn(['status'=>true, 'data'=>$banners]);
    }
    
    public function delComment($id){
        $ActivitycomTable = \Cake\ORM\TableRegistry::get('activitycom');
        $ActivityTable = \Cake\ORM\TableRegistry::get('activity');
        $activitycom = $ActivitycomTable->get($id);
        $activitycom->is_delete = 1;
        $activity = $ActivityTable->get($activitycom->activity_id);
        $activity->comment_nums -= 1;
        $res = $ActivitycomTable->connection()->transactional(function()use($ActivitycomTable, $activitycom, $ActivityTable, $activity){
            return $ActivitycomTable->save($activitycom) && $ActivityTable->save($activity);
        });
        if($res) {
            return $this->Util->ajaxReturn(true, '删除成功');
        } else {
            return $this->Util->ajaxReturn(false, '删除失败');
        }
    }
    
    /**
     * 获取地区
     */
    public function getRegionAndSeries(){
        $region = $this->Activity->Regions->find()->hydrate(false)->all()->toArray();
        $activitySeries = \Cake\Core\Configure::read('activitySeries');
        $series = [];
        if($activitySeries){
            foreach ($activitySeries as $k=>$v){
                $series[$k]['id'] = $k;
                $series[$k]['name'] = $v;
            }
        }
        return $this->Util->ajaxReturn([
            'status' => true,
            'region' => $region,
            'series' => $series,
        ]);
    }
    
    public function test(){
        $this->loadComponent('Push');
        $data = [
            'url' => 'http://m.chinamatop.com/meet/view/7',
        ];
        $userTable = \Cake\ORM\TableRegistry::get('user');
        $user = $userTable->find()->where(['truename'=>'蔡铧枢'])->first();
//        $res = $this->Push->sendAll('感谢使用并购帮APP', '非常感谢使用并购帮APP，并购帮专注并购人的生活方式', '你有一条推送', false, $data, 'go_activity');
        $res = $this->Push->sendAlias($user->user_token, '感谢使用并购帮APP', '非常感谢使用并购帮APP，并购帮专注并购人的生活方式', '你有一条推送', 'BGB', false, $data, 'go_app');
//        $res = $this->Push->ios_check('us24509146822979010801');
//        $res = $this->Push->android_check('us71005146840261729001');
        debug($res);
//        debug($res1);
        exit();
    }

}
