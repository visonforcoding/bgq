<?php

namespace App\Model\Table;

use App\Model\Entity\SavantReco;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SavantReco Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Savants
 * @property \Cake\ORM\Association\BelongsTo $Users
 */
class SavantRecoTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('savant_reco');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Savants', [
            'className' => 'User',
            'foreignKey' => 'savant_id'
        ]);
        $this->belongsTo('Users', [
            'className' => 'User',
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);

        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'create_time' => 'new',
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
        $rules->add($rules->isUnique(['savant_id','user_id'], '您已经推荐过了!'));
        $rules->add($rules->existsIn(['savant_id'], 'Savants'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        return $rules;
    }

}
