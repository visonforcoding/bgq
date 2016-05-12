<?php

namespace App\Controller\Mobile;

use App\Controller\Mobile\AppController;

/**
 * Meet Controller  专家约见栏目
 *
 * @property \App\Model\Table\UserTable $User Description
 */
class MeetController extends AppController {
    
    
    public function initialize() {
        parent::initialize();
        $this->loadModel('User');
    }

    /**
     * Index method  专家约见首页
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {

    }
    
    /**
     * 大咖推荐
     */
    public function meetReco(){
        $dakas = $this->User->find()
                ->hydrate(false)
                ->select(['id','truename','company','position','meet_nums','avatar'])
                ->where("`level`= '2' and `enabled` = '1'")
                ->orderDesc('meet_nums')
                ->toArray();
        $this->set([
            'dakas'=>  json_encode($dakas)
        ]);
    }

    
    /**
     * 专家类别查看  eg:互联网、大消费
     */
    public function meetCat(){
        
    }
  

}
