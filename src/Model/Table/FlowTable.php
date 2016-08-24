<?php

namespace App\Model\Table;

use App\Model\Entity\Flow;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Flow Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 */
class FlowTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('flow');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Users', [
            'className'=>'User',
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        
        $this->belongsTo('Buyer', [
            'className'=>'User',
            'foreignKey' => 'buyer_id',
            'joinType' => 'INNER'
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
                ->integer('type')
                ->requirePresence('type', 'create')
                ->notEmpty('type');

        $validator
                ->requirePresence('type_msg', 'create')
                ->notEmpty('type_msg');


        $validator
                ->decimal('amount')
                ->requirePresence('amount', 'create')
                ->notEmpty('amount');

        $validator
                ->decimal('pre_amount')
                ->requirePresence('pre_amount', 'create')
                ->notEmpty('pre_amount');

        $validator
                ->decimal('after_amount')
                ->requirePresence('after_amount', 'create')
                ->notEmpty('after_amount');

        $validator
                ->integer('status')
                ->requirePresence('status', 'create')
                ->notEmpty('status');

        $validator
                ->requirePresence('remark', 'create')
                ->notEmpty('remark');

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
