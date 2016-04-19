<?php

namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * User Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Industries
 * @property \Cake\ORM\Association\BelongsTo $Cities
 */
class UserTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('user');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Industries', [
            'foreignKey' => 'industry_id',
            'className' => 'Industry',
            'joinTable' => 'industry',
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
                ->requirePresence('phone', 'create')
                ->notEmpty('phone');

        $validator
                ->requirePresence('pwd', 'create')
                ->notEmpty('pwd');

        $validator
                ->requirePresence('truename', 'create')
                ->notEmpty('truename');

        $validator
                ->allowEmpty('company');

        $validator
                ->allowEmpty('position');

        $validator
                ->email('email')
                ->allowEmpty('email');


        $validator
                ->allowEmpty('goodat');

        $validator
                ->requirePresence('card_path', 'create')
                ->notEmpty('card_path');


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
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->isUnique(['phone']));
        $rules->add($rules->existsIn(['industry_id'], 'Industries'));
        return $rules;
    }

}
