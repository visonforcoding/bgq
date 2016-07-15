<?php

namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Industry cell
 */
class IndustryCell extends Cell {

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Default display method.
     *
     * @return void
     */
    public function display($selIds=null) {
        $IndustryTable = \Cake\ORM\TableRegistry::get('Industry');
        $industries = $IndustryTable->find('threaded', [
                    'keyField' => 'id',
                    'parentField' => 'pid'
                ])->all()->toArray();
        $this->set(compact('industries','selIds'));
    }
    
    /**
     *  资讯的标签只有行业投资 pid =1 的记录
     * @param type $selIds
     */
    public function news($selIds=null){
        $IndustryTable = \Cake\ORM\TableRegistry::get('Industry');
        $industries = $IndustryTable->find('threaded', [
                    'keyField' => 'id',
                    'parentField' => 'pid'
                ])->where(['pid'=>1])->all()->toArray();
        $this->set(compact('industries','selIds'));
    }

}
