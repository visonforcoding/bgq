<?php

namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Industry cell
 */
class NewstagCell extends Cell {

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
        $TagTable = \Cake\ORM\TableRegistry::get('Newstag');
        $tags = $TagTable->find()->hydrate(true)->all()->toArray();
        $this->set(compact('tags', 'selIds'));
    }
    
    public function single($selIds = null) {
        $TagTable = \Cake\ORM\TableRegistry::get('Newstag');
        $tags = $TagTable->find()->hydrate(true)->all()->toArray();
        $this->set(compact('tags', 'selIds'));
    }
    

}
