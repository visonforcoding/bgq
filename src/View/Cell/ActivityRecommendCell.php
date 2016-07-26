<?php

namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Industry cell
 */
class ActivityRecommendCell extends Cell {

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
        $ActivityTable = \Cake\ORM\TableRegistry::get('Activity');
        $activities = $ActivityTable->find()->all()->toArray();
        $this->set(compact('activities', 'selIds'));
    }
}
        