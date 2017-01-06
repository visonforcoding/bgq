<?php

namespace App\Model\Table;

use App\Model\Entity\Smsmsg;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Smsmsg Model
 *
 */
class SmsmsgTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('smsmsg');
        $this->displayField('id');
        $this->primaryKey('id');
        
        $this->belongsTo('Users', [
            'foreignKey' => 'phone',
            'bindingKey' => 'phone',
            'className' => 'User',
            'joinType' => 'LEFT'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator) {
        $validator
                ->integer('id')
                ->allowEmpty('id', 'create');

        $validator
                ->requirePresence('phone', 'create')
                ->notEmpty('phone');

        $validator
                ->allowEmpty('code');

        $validator
                ->allowEmpty('content');

        return $validator;
    }

}
