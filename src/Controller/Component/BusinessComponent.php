<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * 处理通用业务
 * Business component
 */
class BusinessComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    
    /**
     * 评论点赞
     * @param int $id 评论id，赞的是哪条评论
     * @param string $table 表名,小写
     */
    public function comLike($id, $table){
    	// 检查是否post
    	if($this->request->is('post'))
		{
			// 检查是否登录
			if($this->request->session()->read('User.mobile'))
			{
				$data = $this->request->data();// 这里传过来的数据为['type'=>'','relate_id'=>'']
				$data['user_id'] = $this->request->session()->read('User.mobile')->id;
				$Table = \Cake\ORM\TableRegistry::get($table);
				$like = $Table->newEntity();
				$like = $Table->patchEntity($like, $data);
				if($Table->find()->where($data)->first())// 查找是否已经赞过了
				{
					return 1;
				}
				else
				{
					if($Table->save($like)) // 插入数据库
					{
						if(!$data['type']) // 不同类型插入不用数据库（活动或者资讯）
						{
							$activitycom = \Cake\ORM\TableRegistry::get('Activitycom');
							$comment = $activitycom->get($id, [
									'contain' => [],
									]);
							$comment->praise_nums += 1;
							$activitycom->save($comment);
						}
						else
						{
							$Newscom = \Cake\ORM\TableRegistry::get('Newscom');
							$comment = $Newscom->get($id, [
									'contain' => [],
									]);
							$comment->praise_nums += 1;
							$Newscom->save($comment);
						}
						return 'success';
					}
					else
					{
						return 2;
					}
				}
			}
			else
			{
				return 3;
			}
		}
		else
		{
			return 4;
		}
    }
    
    /**
     * 文章点赞表
     * @param int $id 评论id，赞的是哪篇文章
     * @param string $table 表名,小写
     */
    public function artLike($id, $table){
    	// 检查是否post
    	if($this->request->is('post'))
    	{
    		// 检查是否登录
    		if($this->request->session()->read('User.mobile'))
    		{
    			$data = $this->request->data();// 这里传过来的数据为['type'=>'','relate_id'=>'']
    			$data['user_id'] = $this->request->session()->read('User.mobile')->id;
    			$Table = \Cake\ORM\TableRegistry::get($table);
    			$like = $Table->newEntity();
    			$like = $Table->patchEntity($like, $data);
    			if($Table->find()->where($data)->first())// 查找是否已经赞过了
    			{
    				return 1;
    			}
    			else
    			{
    				if($Table->save($like)) // 插入数据库
    				{
    					if(!$data['type']) // 不同类型插入不用数据库（活动或者资讯）
    					{
    						$activity = \Cake\ORM\TableRegistry::get('Activity');
    						$comment = $activity->get($id, [
    								'contain' => [],
    								]);
    						$comment->praise_nums += 1;
    						$activity->save($comment);
    					}
    					else
    					{
    						$News = \Cake\ORM\TableRegistry::get('News');
    						$comment = $News->get($id, [
    								'contain' => [],
    								]);
    						$comment->praise_nums += 1;
    						$News->save($comment);
    					}
    					return 'success';
    				}
    				else
    				{
    					return 2;
    				}
    			}
    		}
    		else
    		{
    			return 3;
    		}
    	}
    	else
    	{
    		return 4;
    	}
    }
    
    
    public function collect($id, $table){
    	// 检查是否post
    	if($this->request->is('post'))
    	{
    		// 检查是否登录
    		if($this->request->session()->read('User.mobile'))
    		{
    			$data = $this->request->data();// 这里传过来的数据为['type'=>'','relate_id'=>'']
    			$data['user_id'] = $this->request->session()->read('User.mobile')->id;
    			$Table = \Cake\ORM\TableRegistry::get($table);
    			$collect = $Table->newEntity();
    			$collect = $Table->patchEntity($collect, $data);
    			if($Table->find()->where($data)->first())// 查找是否已经收藏过了
    			{
    				return 5;
    			}
    			else
    			{
    				if($Table->save($collect)) // 插入数据库
    				{
    					return 'success';
    				}
    				else
    				{
    					return 2;
    				}
    			}
    		}
    		else
    		{
    			return 3;
    		}
    	}
    	else
    	{
    		return 4;
    	}
    }
}
