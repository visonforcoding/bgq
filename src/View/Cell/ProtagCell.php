<?php

namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Protag cell 城市cell
 */
class ProtagCell extends Cell {

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
        $ProfiletagTable = \Cake\ORM\TableRegistry::get('Profiletag');
        $items = $ProfiletagTable->find('list')->all()->toArray();
        $this->set(compact('items', 'selId'));
    }
    
    

}
