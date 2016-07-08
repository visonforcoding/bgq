<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use App\Utils\umeng\Umeng;

/**
 * Push component  推送组件
 */
class PushComponent extends Component {

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    protected $key;
    protected $secret;
    protected $Umeng; 

    public function initialize(array $config) {
        parent::initialize($config);
        $conf = \Cake\Core\Configure::read('umeng');
        $this->key = $conf['AppKey'];
        $this->secret = $conf['AppMasterSecret'];
        $this->Umeng = new Umeng($this->key,  $this->secret);
    }
    
    public function test(){
        $umngObj = new Umeng($this->key, $this->secret);
        $umngObj->sendAll($title, $content, $ticker);
        $umngObj->sendAlias($alias, $title, $content, $ticker, $alias_type, $production_mode, $extra, $expire_time, $badge, $after_open);
        debug($umngObj);
    }
    

}
