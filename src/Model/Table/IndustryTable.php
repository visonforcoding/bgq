<?php

namespace App\Model\Table;

use App\Model\Entity\Industry;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Industry Model
 *
 * @property \Cake\ORM\Association\HasMany $User
 */
class IndustryTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('industry');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->hasMany('User', [
            'foreignKey' => 'industry_id'
        ]);
        $this->belongsTo('Industries', [
            'className' => 'industry',
            'foreignKey' => 'pid',
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
                ->integer('pid')
                ->requirePresence('pid', 'create')
                ->notEmpty('pid');

        $validator
                ->requirePresence('name', 'create')
                ->notEmpty('name');

        return $validator;
    }

}
