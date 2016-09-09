<?php

namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Agency cell 机构shell
 */
class AgencyCell extends Cell {

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
    public function display($selId=null) {
        $IndustryTable = \Cake\ORM\TableRegistry::get('Agency');
        $agencies = $IndustryTable->find('threaded', [
                    'keyField' => 'id',
                    'parentField' => 'pid'
                ])->all()->toArray();
        $this->set(compact('agencies', 'selId'));
    }
    /**
     * Default display method.
     *
     * @return void
     */
    public function multi($selId=null) {
        $IndustryTable = \Cake\ORM\TableRegistry::get('Agency');
        $agencies = $IndustryTable->find('threaded', [
                    'keyField' => 'id',
                    'parentField' => 'pid'
                ])->all()->toArray();
        $this->set(compact('agencies', 'selId'));
    }

}
