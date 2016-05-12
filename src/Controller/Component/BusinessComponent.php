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
    
    
    public function like($id, $method, $likeType, $entity){
    	$data = $this->request->data();
		if($data['status'] == 1)
		{
			$data['status'] = 0;
		}
		else
		{
			$data['status'] = 1;
		}
		$data['user_id'] = $this->user->id;
		$like = $this->Activity->Like->patchEntity($entity, $data);
    }
    
    
    
    public function collect(){
    	
    }
}
