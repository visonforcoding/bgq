<?php
/**
  * @date : 2016-5-5
  * @author : Wash Cai <1020183302@qq.com>
  */

namespace App\Controller\Mobile;
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
			$activityApply = $this
							->Activity
							->Activityapply
							->find()
							->contain(['Users'])
							->where(['user_id' => $this->user->id])
							->hydrate(false)
							->toArray();
			if($activityApply != '')
			{
				foreach ($activityApply as $k=>$v)
				{
					$isApply[] = $v['activity_id'];
				}
				$this->set(compact('isApply'));
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
			if($comment)
			{
				$this->set(compact('comment'));
			}
			
			
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
			$this->paginate = [
				'contain' => ['Admins','Industries'],
				'order' => ['is_top' => 'DESC', 'create_time' => 'DESC'],
				'limit' => '2',
			];
			$activity = $this->paginate($this->Activity);
			$this->set(compact('activity'));
			$this->set('_serialize', ['activity']);
			// 用户已报名的活动
			$activityApply = $this
				->Activity
				->Activityapply
				->find()
				->where(['user_id' => $this->user->id])
				->select(['activity_id'])
				->hydrate(false)
				->toArray();
			foreach ($activityApply as $k=>$v)
			{
				$isApply[] = $v['activity_id'];
			}
			$this->set('isApply', $isApply);
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
	
// 	public function like($id){
// 		$a = $this->request->data();
// 		$this->
// 	}
}