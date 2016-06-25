<?php

namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Industry cell
 */
class BiggieCell extends Cell {

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
        $BiggieTable = \Cake\ORM\TableRegistry::get('savant');
        $biggies = $BiggieTable->find()->contain('Users')->all()->toArray();
        $this->set(compact('biggies','selIds'));
    }

}
