<?php

namespace App\Controller\Mobile;

use App\Controller\Mobile\AppController;

/**
 * Industry Controller
 *
 * @property \App\Model\Table\IndustryTable $Industry
 */
class IndustryController extends AppController {
    

    /**
     * 
     * @param type $type 1行业投资 2资金业务 3其他
     */
    public function getIndustryItem($type) {
        if (!in_array($type, ['1', '2', '3'])) {
            throw new Exception('参数不合法');
        }
        $items = $this->Industry->find('all', [
                    'conditions' => [
                        'pid' => $type
                    ]
                ])->toArray();
        $this->Util->ajaxReturn($items);
    }

}
