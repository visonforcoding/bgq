<?php
/**
  * @date : 2016-5-5
  * @author : Wash Cai <1020183302@qq.com>
  */

namespace App\Controller\Mobile;
use PhpParser\Node\Stmt\Switch_;

use App\Controller\Mobile\AppController;
class ActivityController extends AppController{
	
	/**
	 * 活动详情
	 */
	public function details($id=''){
		if($id)
		{
			$activity = $this->Activity->get($id, [
	            'contain' => ['Admins', 'Industries'],
	        ]);
			$activity->read_nums += 1;// 阅读加1
			$this->Activity->save($activity);
			$this->set('activity',$activity);
			
			// 是否已报名
			if($this->user)
			{
				$activityApply = $this
				->Activity
				->Activityapply
				->find()
				->contain(['Users'])
				->where(['user_id' => $this->user->id])
				->hydrate(false)
				->toArray();
				$isApply = [];
				foreach ($activityApply as $k=>$v)
				{
					$isApply[] = $v['activity_id'];
				}
				$this->set('isApply', $isApply);
			}
			else
			{
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
							->order(['is_top' => 'DESC', 'Activityapply.create_time' => 'DESC'])
							->hydrate(false)
							->toArray();
			if($allApply != '')
			{
				$userApply = [];
				foreach ($allApply as $k=>$v)
				{
					$userApply[] = $v['user'];
				}
				$this->set('userApply', $userApply);
			}
			
			// 评论
			$comment = $this
					->Activity
					->Activitycom
					->find()
					->contain(['Users'])
					->where(['activity_id' => $id])
					->order(['Activitycom.create_time' => 'DESC'])
					->hydrate(false)
					->toArray();
// 			debug($comment);die;
			$this->set('comment', $comment);
			
			// 是否已赞
			$isLike = $this->Activity->Articlelike->find()->where(['user_id'=>$this->user->id, 'relate_id'=>$id])->first();
			$this->set('isLike', $isLike);
			
			// 是否已收藏
// 			$isCollect = $this->Activity->ArticleCollect->find()->where(['user_id'=>$this->user->id, 'relate_id'=>$id])->first();
// 			$this->set('isCollect', $isCollect);
			
			$this->set('pagetitle', '活动详情');
		}
		else
		{
			$this->Util->ajaxReturn('0', '传值错误');
		}
	}
	
	/**
	 * 活动列表
	 */
	public function index(){
// 		if($this->request->is('post'))
// 		{
			//获取资讯banner图
			$bannerTable = \Cake\ORM\TableRegistry::get('banner');
			$banners = $bannerTable
					->find()
					->where("`enabled` = '1' and `type` = '2'")
					->orderDesc('create_time')
					->limit(3)
					->toArray();
			$this->set(compact('banners'));
			
			$this->paginate = [
				'contain' => ['Admins','Industries'],
				'order' => ['is_top' => 'DESC', 'create_time' => 'DESC'],
				'limit' => '2',
			];
			$activity = $this->paginate($this->Activity);
			$this->set(compact('activity'));
			$this->set('_serialize', ['activity']);
			if($this->user)
			{
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
				foreach ($activityApply as $k=>$v)
				{
					$isApply[] = $v['activity_id'];
				}
				$this->set('isApply', $isApply);
			}
			else
			{
				$isApply = [];
				$this->set('isApply', $isApply);
			}
			
			$this->set('pagetitle', '活动');
// 		}
// 		else
// 		{
// 			$this->Util->ajaxReturn(false,'非法进入！');
// 		}
	}
	
	/**
	 * 我要推荐
	 */
	public function recommend($id=''){
		$this->set('pagetitle', '我要推荐');
	}
	
	/**
	 * 我要报名
	 */
	public function enroll($id=''){
		if($id)
		{
			$activity = $this->Activity->get($id, [
					'contain' => ['Admins'],
					]);
			if($this->request->is('post'))
			{
				$activityApply = $this->Activity->Activityapply->newEntity();
				$data = [
					'user_id' => $this->user->id,
					'activity_id' => $id,
				];
				$activityApply = $this->Activity->Activityapply->patchEntity($activityApply, $data);
				if($this->Activity->Activityapply->find()->where($data)->first()) // 查找数据库是否有对应数据，即是否已报名
				{
					$this->Util->ajaxReturn(false, '已经报名过了！');
				}
				else
				{
					if($this->Activity->Activityapply->save($activityApply))
					{
						$activity->apply_nums += 1;
						$this->Activity->save($activity);
						$this->Util->ajaxReturn(true, '提交成功！');
					}
					else
					{
						$this->Util->ajaxReturn(false, $activityApply->errors());
					}
				}
			}
			else
			{
				$this->set('activity',$activity);
				$this->set('user',$this->user);
				$this->set('pagetitle', '我要报名');
			}
		}
		else
		{
			$this->Util->ajaxReturn(false, '传值错误');
		}
	}
	
	/**
	 * 发布活动
	 */
	
	public function release(){
		if($this->request->is('post'))
		{
			$a = $this->request->data();
			debug($a);die;
		}
		else
		{
			$industry = 0;
			$this->set('industry',$industry);
			$this->set('pagetitle', '发布活动');
		}
	}
	
	/**
	 * 评论点赞
	 * @param int $id
	 */
	public function comLike($id){
		$this->loadComponent('Business');
		$code = $this->Business->comLike($id, 'commentlike');
		if($code == 'success')
		{
			$this->Util->ajaxReturn(true, '点赞成功！');
		}
		else
		{
			$this->Util->ajaxReturn(false, $this->showError($code));
		}
	}
	
	/**
	 * 文章点赞
	 * @param int $id 文章id
	 */
	public function artLike($id){
		$this->loadComponent('Business');
		$code = $this->Business->artLike($id, 'articlelike');
		if($code == 'success')
		{
			$this->Util->ajaxReturn(true, '点赞成功！');
		}
		else
		{
			$this->Util->ajaxReturn(false, $this->showError($code));
		}
	}
	
	protected function showError($id){
		switch ($id) {
			case 1:
				return '您已经点过赞了！';
				break;
			case 2:
				return '系统错误！';
				break;
			case 3:
				return '请先登录！';
				break;
			case 4:
				return '非法操作';
				break;
			case 4:
				return '您已经收藏过了';
				break;
		}
	}
}