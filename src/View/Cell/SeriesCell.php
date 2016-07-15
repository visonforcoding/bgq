<?php

namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Industry cell
 */
class SeriesCell extends Cell {

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
        $activitySeries = \Cake\Core\Configure::read('activitySeries');
        $this->set([
            'items'=>$activitySeries
        ]);
        $this->set(compact('selIds'));
    }
    

}
