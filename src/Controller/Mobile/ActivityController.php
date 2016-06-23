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
 */
class ActivityController extends AppController {

    protected $limit = '5'; // 分页条数

    /**
     * 活动详情
     */

    public function details($id = '') {
        if ($id) {
            $isLike = '';
            $isCollect = '';
            $savant = '';
            // 已报名的人
            $allApply = $this
                    ->Activity
                    ->Activityapply
                    ->find()
                    ->contain(['Users'])
                    ->where(['activity_id' => $id])
                    ->order([
                        'is_top' => 'DESC',
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

            // 评论
            $comment = $this
                    ->Activity
                    ->Activitycom
                    ->find()
                    ->contain(['Users', 'Replyusers'])
                    ->where(['activity_id' => $id])
                    ->order(['Activitycom.create_time' => 'DESC'])
                    ->limit($this->limit)
                    ->hydrate(false)
                    ->toArray();
            $this->set('comjson', json_encode($comment));

            // 活动详情
            $activity = $this->Activity->get($id, [
                'contain' => [
                    'Admins',
                    'Industries',
                    'Regions',
                    'Savants' => function($q){
                        return $q->contain(['Users']);
                    },
                ],
            ]);
//            debug($activity);die;
            $activity->read_nums += 1; // 阅读加1
            $this->Activity->save($activity);
            $this->set('activity', $activity);

            if ($this->user) {
                // 是否已报名
                $activityApply = $this
                        ->Activity
                        ->Activityapply
                        ->find()
                        ->contain(['Users'])
                        ->where(['user_id' => $this->user->id])
                        ->hydrate(false)
                        ->toArray();
                $isApply = [];
                foreach ($activityApply as $k => $v) {
                    $isApply[] = $v['activity_id'];
                }
                $this->set('isApply', $isApply);

                // 是否已赞
                $isLike = $this
                        ->Activity
                        ->Likelogs
                        ->find()
                        ->where(['user_id' => $this->user->id, 'relate_id' => $id])
                        ->first();
                // 是否已收藏
                $isCollect = $this
                        ->Activity
                        ->Collect
                        ->find()
                        ->where(['user_id' => $this->user->id, 'relate_id' => $id])
                        ->first();
                if ($isCollect) {
                    $isCollect = !$isCollect['is_delete'];
                } else {
                    $isCollect = 0;
                }

                $this->set('user', $this->user->id);
            } else {
                $this->set('user', '');
                $isApply = [];
                $this->set('isApply', $isApply);
            }
            $this->set('isLike', $isLike);
            $this->set('isCollect', $isCollect);

            $this->set('pageTitle', '活动详情');
        } else {
            return $this->Util->ajaxReturn(false, '传值错误');
        }
    }

    /**
     * 活动列表
     */
    public function index() {
        $act = $this
                ->Activity
                ->find()
                ->contain(['Users', 'Industries', 'Regions'])
                ->limit($this->limit)
                ->where(['is_check' => 1])
                ->orderDesc('Activity.create_time', 'Activity.is_top')
                ->toArray();
        $this->set('actjson', json_encode($act));

        // 轮播图
        $bannerTable = \Cake\ORM\TableRegistry::get('banner');
        $banners = $bannerTable
                ->find()
                ->where("`enabled` = '1' and `type` = '2'")
                ->orderDesc('create_time')
                ->limit(3)
                ->toArray();
        $this->set(compact('banners'));

        $this->paginate = [
            'contain' => ['Admins', 'Industries', 'Regions'],
            'order' => ['is_top' => 'DESC', 'create_time' => 'DESC'],
        ];
        $activity = $this->paginate($this->Activity->find()->where(['is_check' => 1]));
        $this->set(compact('activity'));
        $this->set('_serialize', ['activity']);
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
            $isApply = [];
            foreach ($activityApply as $k => $v) {
                $isApply[] = $v['activity_id'];
            }
        }
        $isApply = implode(',', $isApply);
        $this->set('isApply', $isApply);
        $this->set('user', $this->user);
        $this->set('pageTitle', '活动');
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
                'contain' => ['Admins'],
            ]);
            if ($this->request->is('post')) {
                $activityApply = $this->Activity->Activityapply->newEntity();
                $data = [
                    'user_id' => $this->user->id,
                    'activity_id' => $id,
                ];
                $activityApply = $this->Activity->Activityapply->patchEntity($activityApply, $data);
                if ($this->Activity->Activityapply->find()->where($data)->first()) { // 查找数据库是否有对应数据，即是否已报名
                    return $this->Util->ajaxReturn(false, '已经报名过了');
                } else {
                    if ($this->Activity->Activityapply->save($activityApply)) {
                        $activity->apply_nums += 1;
                        $this->Activity->save($activity);
                        return $this->Util->ajaxReturn(true, '提交成功');
                    } else {
                        return $this->Util->ajaxReturn(false, $activityApply->errors());
                    }
                }
            } else {
                $this->set('activity', $activity);
                $this->set('user', $this->user);
                $this->set('pageTitle', '我要报名');
            }
        } else {
            return $this->Util->ajaxReturn(false, '传值错误');
        }
    }

    /**
     * 发布活动
     */
    public function release() {
        $industries = '';
        if ($this->request->param('pass')) {

            $data = $this->request->param('pass');
            $industry = \Cake\ORM\TableRegistry::get('industry');
            foreach ($data as $k => $v) {
                $industries[] = $industry->get($v);
            }
            $this->set('industries', $industries);
        }
        if ($this->request->is('post')) {
            $this->handCheckLogin();
            $users = \Cake\ORM\TableRegistry::get('user');
            $user = $users->get($this->user->id);
            $data = $this->request->data();
            $industries = $this->Activity->newEntity();
            $industry = $this->Activity->patchEntity($industries, $data);
            $industry->company = $user->company;
            $industry->user_id = $user->id;
            if ($data['pay']) {
                $industry->is_crowdfunding = 1;
            } else {
                $industry->is_crowdfunding = 0;
            }
            if ($this->Activity->save($industry)) {
                return $this->Util->ajaxReturn(true, '提交成功');
            } else {
                return $this->Util->ajaxReturn(false, '提交失败');
            }
        } else {
            $this->set('industries', $industries);
            $this->set('pageTitle', '发布活动');
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
        if ($res !== false) {
            if (is_string($res)) {
                return $this->Util->ajaxReturn(false, $res);
            } else {
                return $this->Util->ajaxReturn(true, '点赞成功');
            }
        } else {
            return $this->Util->ajaxReturn(false, '系统错误');
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
    public function search() {
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
        $industries = $this->Activity->Industries->find()->hydrate(false)->all()->toArray();
        $industries = $this->tree($industries);
        $this->set('regions', $region);
        $this->set('industries', $industries);
        $this->set('pageTitle', '搜索');
    }
    
    /**
     * 搜索结果
     */
    public function getSearchRes() {
        $data = $this->request->data();
        $industry_id = $data['industry_id'];
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
                ->andWhere(['is_check'=>'1']);
        if ($industry_id) {
            $res = $res->matching(
                'Industries', function($q)use($industry_id) {
                    return $q->where(['Industries.id' => $industry_id]);
                }
            );
        } else {
            $res = $res->contain(['Industries']);
        }
        if($data['region']){
            $res = $res->andWhere(['region_id'=>$data['region']]);
        }
        if ($data['sort']) {
            $res->orderDesc($data['sort']);
        } else {
            $res->orderDesc('create_time'); // 默认按时间倒序排列
        }
        $res = $res
                ->limit($this->limit)
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
     * 加载更多搜索结果
     * @param int $page 页数
     */
    public function getMoreSearch($page){
        $data = $this->request->data();
        $industry_id = $data['industry_id'];
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
        
        $res = $this->Activity->find()->where(['title LIKE' => '%' . $data['keyword'] . '%']);
        if ($industry_id) {
            $res = $res->matching(
                'Industries', function($q)use($industry_id) {
                    return $q->where(['Industries.id' => $industry_id]);
                }
            );
        } else {
            $res = $res->contain(['Industries']);
        }
        if ($data['sort']) {
            $res = $res->orderDesc($data['sort']);
        } else {
            $res = $res->orderDesc('create_time');
        }
        $res = $res
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
            $newComment[] = $this->Activity->Activitycom->get($res->id, ['contain'=>["Users", "Replyusers"]])->toArray();
            if ($res) {
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
        $user = $userTable->find()->where(['id' => $user_id])->hydrate(false)->first();
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
        $user = $userTable->find()->where(['id' => $user_id])->hydrate(false)->first();
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
        $isApply = [];
        // 是否已报名
        if ($this->user) {
            $activityApply = $this->Activity
                            ->Activityapply
                            ->find()
                            ->contain(['Users'])
                            ->where(['user_id' => $this->user->id])
                            ->hydrate(false)
                            ->toArray();
            foreach ($activityApply as $k => $v) {
                $isApply[] = $v['activity_id'];
            }
            $isApply = implode(',', $isApply);
        }
        $this->set('isApply', $isApply);
        
        $activity = $this->Activity
                        ->find()
                        ->where(['is_check' => 1])
                        ->contain(['Users', 'Industries'])
                        ->page($page, $this->limit)
                        ->orderDesc('Activity.create_time')
                        ->toArray();
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
                        ->where(['activity_id' => $id])
                        ->contain(['Users', 'Replyusers'])
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
        // 评论
        $comment = $this
                ->Activity
                ->Activitycom
                ->find()
                ->contain(['Users', 'Replyusers'])
                ->where(['activity_id' => $id])
                ->order(['Activitycom.create_time' => 'DESC'])
                ->limit(10)
                ->toArray();
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
        $activity = $this->Activity->get($id);
        if(!$activity)
        {
            $this->set('res', '活动不存在');
        }
        $is_apply = $this->Activity->Activityapply->find()->where(['user_id'=>$this->user->id, 'activity_id'=>$id, 'is_pass'=>1])->first();
        if(!$is_apply)
        {
            $this->set('res', '未报名或者未通过审核');
        }
        $apply = $this->Activity->Activityapply->get($is_apply->id);
        debug($apply);die;
        if($apply->is_sign == 1)
        {
            $this->set('res', '您已经签到了，请勿重复扫码');
        }
        $apply->is_sign = 1;
        $res = $this->Activity->Activityapply->save($apply);
        if($res)
        {
            $this->set('res', $activity->title . ' 活动签到成功!');
        }
        else
        {
            $this->set('res', '系统错误');
        }
        $this->set('pageTitle', '活动签到');
    }
    
    public function test(){
        $a = $this->request->env('HTTP_HOST');
        debug($a);die;
    }

}
