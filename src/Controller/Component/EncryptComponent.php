<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Utility\Security;

/**
 * 加解密
 * Encrypt component 
 */
class EncryptComponent extends Component {

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /**
     *
     * @var type 
     */
    protected $key;

    public function initialize(array $config) {
        parent::initialize($config);
        $config = \Cake\Core\Configure::read('encrypt');
        $this->key = $config['key'];
        if(empty($this->key)){
            throw new \Cake\Core\Exception\Exception('KEY未配置');
        }
    }
    
    
    public function encrypt($plain){
        return base64_encode(Security::encrypt($plain, $this->key));
    }
    
    public function decrypt($cipher){
        return Security::decrypt(base64_decode($cipher), $this->key);
    }

}
