<?php

namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Industry cell
 */
class SavantCell extends Cell {

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
    public function display($selIds = null) {
        $UserTable = \Cake\ORM\TableRegistry::get('User');
        $savants = $UserTable->find()->select(['id','truename','company'])->where(['level'=>2,'enabled'=>1])->all()->toArray();
        $this->set(compact('savants', 'selIds'));
    }
    
    public function single($selIds = null) {
        $UserTable = \Cake\ORM\TableRegistry::get('User');
        $savants = $UserTable->find()->select(['id','truename','company'])->where(['level'=>2,'enabled'=>1])->all()->toArray();
        $this->set(compact('savants', 'selIds'));
    }
}
        