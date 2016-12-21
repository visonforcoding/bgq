<?php

namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Industry cell
 */
class MentorCell extends Cell {

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
        $MentorTable = \Cake\ORM\TableRegistry::get('Mentor');
        $mentors = $MentorTable->find()->where(['is_del'=>0])->all()->toArray();
        $this->set(compact('mentors', 'selIds'));
    }

    /**
     * 非专家用户
     */
    public function not($selIds = null) {
        $UserTable = \Cake\ORM\TableRegistry::get('User');
        $users = $UserTable->find()->where(['enabled' => 1,'level'=>1])->all()->toArray();
        $this->set(compact('users', 'selIds'));
    }

}
