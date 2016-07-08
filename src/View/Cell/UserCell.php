<?php

namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Industry cell
 */
class UserCell extends Cell {

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
        $UserTable = \Cake\ORM\TableRegistry::get('user');
        $users = $UserTable->find()->where(['enabled'=>1])->all()->toArray();
        $this->set(compact('users','selIds'));
    }

}
