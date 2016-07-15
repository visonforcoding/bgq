<?php

namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Agency cell 城市cell
 */
class ScaleCell extends Cell {

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
        $IndustryTable = \Cake\ORM\TableRegistry::get('Scale');
        $items = $IndustryTable->find('list')->all()->toArray();
        $this->set(compact('items', 'selId'));
    }

}
