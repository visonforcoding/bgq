<?php

namespace App\Model\Table;

use App\Model\Entity\Withdraw;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Withdraw Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 */
class WithdrawTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('withdraw');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Users', [
            'className'=>'user',
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Admin', [
            'className'=>'Wpadmin.Admin',
            'foreignKey' => 'admin_id',
            'joinType' => 'LEFT'
        ]);

        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'create_time' => 'new',
                    'update_time' => 'always'
                ]
            ]
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
                ->numeric('amount')
                ->requirePresence('amount', 'create')
                ->notEmpty('amount');

        $validator
                ->requirePresence('cardno', 'create')
                ->notEmpty('cardno');

        $validator
                ->requirePresence('bank', 'create')
                ->notEmpty('bank');

        $validator
                ->requirePresence('truename', 'create')
                ->notEmpty('truename');


        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        return $rules;
    }

}
