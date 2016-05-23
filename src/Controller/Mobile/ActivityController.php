<?php

/**
 * @date : 2016-5-5
 * @author : Wash Cai <1020183302@qq.com>
 */

namespace App\Controller\Mobile;

use Wpadmin\Utils\Util;
use PhpParser\Node\Stmt\Switch_;
use App\Controller\Mobile\AppController;

class ActivityController extends AppController {

    protected $limit = '5';

    /**
     * 活动详情
     */
    public function details($id = '') {
        if ($id) {
            $activity = $this->Activity->get($id, [
                'contain' => ['Admins', 'Industries'],
            ]);
            $activity->read_nums += 1; // 阅读加1
            $this->Activity->save($activity);
            $this->set('activity', $activity);

            // 是否已报名
            if ($this->user) {
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
            } else {
                $isApply = [];
                $this->set('isApply', $isApply);
            }


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

            // 是否已赞
            $isLike = $this
                    ->Activity
                    ->Articlelike
                    ->find()
                    ->where(['user_id' => $this->user->id, 'relate_id' => $id])
                    ->first();
            $this->set('isLike', $isLike);

            // 是否已收藏
            $isCollect = $this
                    ->Activity
                    ->Collect
                    ->find()
                    ->where(['user_id' => $this->user->id, 'relate_id' => $id])
                    ->first();
            $this->set('isCollect', $isCollect);

            $this->set('pagetitle', '活动详情');
        } else {
            $this->Util->ajaxReturn('0', '传值错误');
        }
    }

    /**
     * 活动列表
     */
    public function index() {
        $act = $this
                ->Activity
                ->find()
                ->contain(['Users', 'Industries'])
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
            'contain' => ['Admins', 'Industries'],
            'order' => ['is_top' => 'DESC', 'create_time' => 'DESC'],
        ];
        $activity = $this->paginate($this->Activity->find()->where(['is_check' => 1]));
// 			debug($activity);die;
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
        $this->set('pagetitle', '活动');
    }

    /**
     * 我要推荐
     */
    public function recommend($id) {
        if ($this->request->is('post')) {
            if ($this->user) {
                $data = $this->request->data();
                $data['user_id'] = $this->user->id;
                $data['activity_id'] = $id;
                $sponsorTable = \Cake\ORM\TableRegistry::get('sponsor');
                $sponsor = $sponsorTable->newEntity();
                $formdata = $sponsorTable->patchEntity($sponsor, $data);
                $res = $sponsorTable->save($formdata);
                if ($res) {
                    $this->Util->ajaxReturn(true, '推荐成功');
                } else {
                    $this->Util->ajaxReturn(false, '系统错误');
                }
            } else {
                $this->Util->ajaxReturn(false, '请先登录');
            }
        } else {
            $this->set('pagetitle', '我要推荐');
        }
    }

    /**
     * 我要报名
     */
    public function enroll($id = '') {
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
                    $this->Util->ajaxReturn(false, '已经报名过了！');
                } else {
                    if ($this->Activity->Activityapply->save($activityApply)) {
                        $activity->apply_nums += 1;
                        $this->Activity->save($activity);
                        $this->Util->ajaxReturn(true, '提交成功！');
                    } else {
                        $this->Util->ajaxReturn(false, $activityApply->errors());
                    }
                }
            } else {
                $this->set('activity', $activity);
                $this->set('user', $this->user);
                $this->set('pagetitle', '我要报名');
            }
        } else {
            $this->Util->ajaxReturn(false, '传值错误');
        }
    }

    /**
     * 发布活动
     */
    public function release() {

        if ($this->request->param('pass')) {

            $data = $this->request->param('pass');
            $industry = \Cake\ORM\TableRegistry::get('industry');
            foreach ($data as $k => $v) {
                $industries[] = $industry->get($v);
            }
// 			debug($industries);die;
            $this->set('industries', $industries);
        }
        if ($this->request->is('post')) {
            if ($this->user) {
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
                    $this->Util->ajaxReturn(true, '发布成功');
                } else {
                    $this->Util->ajaxReturn(false, '发布失败');
                }
            } else {
                $this->Util->ajaxReturn(false, '请先登录');
            }
        } else {
            $this->set('industries', $industries);
            $this->set('pagetitle', '发布活动');
        }
    }

    /**
     * 评论点赞
     * @param int $id
     */
    public function comLike($id) {
        $this->loadComponent('Business');
        $code = $this->Business->comLike($id, 'commentlike');
        if ($code == 'success') {
            $this->Util->ajaxReturn(true, '点赞成功！');
        } else {
            $this->Util->ajaxReturn(false, $this->showError($code));
        }
    }

    /**
     * 文章点赞
     * @param int $id 文章id
     */
    public function artLike($id) {
        $this->loadComponent('Business');
        $code = $this->Business->artLike($id, 'articlelike');
        if ($code == 'success') {
            $res = $this->likeLog($id, $this->user->id);
            if ($res) {
                $this->Util->ajaxReturn(true, '点赞成功！');
            } else {
                $this->Util->ajaxReturn(false, '系统错误');
            }
        } else {
            $this->Util->ajaxReturn(false, $this->showError($code));
        }
    }

    /**
     * 收藏动作
     * @param int $id 文章id
     */
    public function collect($id) {
        $this->loadComponent('Business');
        $code = $this->Business->collect($id);
        if ($code == 'success') {
            $res = $this->collectLog($id, $this->user->id);
            if ($res) {
                $this->Util->ajaxReturn(true, '收藏成功！');
            } else {
                $this->Util->ajaxReturn(false, '系统错误');
            }
        } else {
            $this->Util->ajaxReturn(false, $this->showError($code));
        }
    }

    /**
     * 活动搜索
     */
    public function search() {
        $res = [];
        $alert = [];
        if ($this->request->is('post')) {
            $data = $this->request->data();
            $res = $this
                    ->Activity
                    ->find()
                    ->where(['title LIKE' => '%' . $data['keyword'] . '%']);
            if ($data['industry_id']) {
                $res = $res->andWhere(['industry_id' => $data['industry_id']]);
            }
            if ($data['sort']) {
                $res = $res->orderDesc($data['sort']);
            } else {
                $res = $res->orderDesc('create_time');
            }
            $res = $res
                    ->hydrate(false)
                    ->all()
                    ->toArray();
            if ($res == false || empty($res)) {
                $alert = '暂无搜索结果';
            }
        }
        $this->set('alert', $alert);
        $this->set('search', $res);

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
        $this->set('isApply', $isApply);
        $industries = $this->Activity->Industries->find()->hydrate(false)->all()->toArray();
        $industries = $this->tree($industries);
        $this->set('industries', $industries);
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
    }

    /**
     * 评论动作
     * @param int $id 活动id
     * @param int $pid 父id
     */
    public function doComment($id) {
        if ($this->request->is('post')) {
            if ($this->user) {
                $data = $this->request->data();
                $data['user_id'] = $this->user->id;
                $data['activity_id'] = $id;

                $activitycom = $this->Activity->Activitycom->newEntity();
                $doComment = $this->Activity->Activitycom->patchEntity($activitycom, $data);
                if ($data['pid']) {
                    $comment = $this->Activity->Activitycom->get($data['pid']);
                    $doComment->reply_id = $comment->user_id;
                } else {
                    $user = $this->Activity->get($id);
                    $doComment->reply_id = $user->user_id;
                }
                $res = $this->Activity->Activitycom->save($doComment);
                if ($res) {
                    $activity = $this->Activity->get($id);
                    $activity->comment_nums += 1;
                    $this->Activity->save($activity);
                    $this->Util->ajaxReturn(true, '评论成功');
                } else {
                    $this->Util->ajaxReturn(false, '系统错误');
                }
            } else {
                $this->Util->ajaxReturn(false, '请先登录');
            }
        } else {
            $this->Util->ajaxReturn(false, '非法操作');
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
        // 是否已报名
        if ($this->user) {
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
            $isApply = implode(',', $isApply);
            $this->set('isApply', $isApply);
        } else {
            $isApply = [];
            $this->set('isApply', $isApply);
        }
        $activity = $this->Activity->find()->where(['is_check' => 1])
                        ->contain(['Users', 'Industries'])->page($page, $this->limit)
                        ->orderDesc('Activity.create_time')->toArray();
        if ($activity) {
            $this->Util->ajaxReturn(['status' => true, 'data' => $activity]);
        } else {
            $this->Util->ajaxReturn(['status' => false]);
        }
    }

    /**
     * ajax获取更多评论
     * @param int $page 分页
     * @param int $id 活动id
     */
    public function getMoreComment($page, $id) {
        $comment = $this->Activity->Activitycom->find()->where(['activity_id' => $id])
                        ->contain(['Users', 'Replyusers'])->page($page, $this->limit)
                        ->orderDesc('Activitycom.create_time')->toArray();
        if ($comment) {
            $this->Util->ajaxReturn(['status' => true, 'data' => $comment]);
        } else {
            $this->Util->ajaxReturn(['status' => false]);
        }
    }

    /**
     * 显示错误信息
     * @param int $id 错误码
     * @return string 错误信息
     */
    protected function showError($id) {
        switch ($id) {
            case 1:
                return '已经点过赞了';
                break;
            case 2:
                return '系统错误';
                break;
            case 3:
                return '请先登录！';
                break;
            case 4:
                return '非法操作';
                break;
            case 5:
                return '已经收藏过了';
                break;
        }
    }

}
