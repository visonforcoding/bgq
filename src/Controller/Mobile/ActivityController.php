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
		}
		else
		{
			$this->Util->ajaxReturn('0', '传值错误');
		}
	}
	
	/**
	 * 活动列表
	 */
	public function activity(){
// 		if($this->request->is('post'))
// 		{
			$this->paginate = [
				'contain' => ['Admins','Industries'],
				'order' => ['is_top' => '1', 'create_time' => 'DESC'],
				'limit' => '2',
			];
			$activity = $this->paginate($this->Activity);
			$this->set(compact('activity'));
			$this->set('_serialize', ['activity']);
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
		
	}
	
	/**
	 * 我要报名
	 */
	public function enroll($id=''){
		if($id)
		{
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
				$activity = $this->Activity->get($id, [
						'contain' => ['Admins'],
						]);
				$this->set('activity',$activity);
				$this->set('user',$this->user);
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
		
	}
	
}