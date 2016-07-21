<?php

namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Industry cell
 */
class JobCell extends Cell {

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
        $ItemTable = \Cake\ORM\TableRegistry::get('Job');
        $items = $ItemTable->find()->all()->toArray();
        $this->set(compact('items','selIds'));
    }

}
