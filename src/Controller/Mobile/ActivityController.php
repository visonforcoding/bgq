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
		$this->paginate = [
			'contain' => ['Admins','Industries'],
			'order' => ['is_top' => '1', 'create_time' => 'DESC'],
			'limit' => '2',
		];
		$activity = $this->paginate($this->Activity);
		$this->set(compact('activity'));
		$this->set('_serialize', ['activity']);
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
			$this->Util->ajaxReturn('0', '传值错误');
		}
	}
}