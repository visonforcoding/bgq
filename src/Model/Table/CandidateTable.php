<?php

namespace App\Model\Table;

use App\Model\Entity\Candidate;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Candidate Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Jobs
 */
class CandidateTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('candidate');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Job', [
            'className' => 'Job',
            'foreignKey' => 'job_id',
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
                ->requirePresence('truename', 'create')
                ->notEmpty('truename');

        $validator
                ->date('birthday')
                ->requirePresence('birthday', 'create')
                ->notEmpty('birthday');

        $validator
                ->requirePresence('phone', 'create')
                ->notEmpty('phone');

        $validator
                ->email('email')
                ->requirePresence('email', 'create')
                ->notEmpty('email');

        $validator
                ->requirePresence('address', 'create')
                ->notEmpty('address');

        $validator
                ->requirePresence('career', 'create')
                ->notEmpty('career');

        $validator
                ->requirePresence('education', 'create')
                ->notEmpty('education');

        $validator
                ->requirePresence('salary', 'create')
                ->notEmpty('salary');


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
        $rules->add($rules->existsIn(['job_id'], 'Job'));
        return $rules;
    }

}
