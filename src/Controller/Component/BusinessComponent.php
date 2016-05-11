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
    
    
    public function like($id, $method, $likeType){
    	$this->Like->newEntity();
    	$this->Like->get($id, [
    			'contain' => [],
    		]);
    	
    }
    
    
    
    public function collect(){
    	
    }
}
