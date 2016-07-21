<?php

namespace App\Model\Table;

use App\Model\Entity\Job;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Job Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Admins
 * @property \Cake\ORM\Association\BelongsToMany $Industry
 */
class JobTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('job');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Admins', [
            'className' => 'Wpadmin.Admin',
            'foreignKey' => 'admin_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsToMany('Industries', [
            'className' => 'Industry',
            'foreignKey' => 'job_id',
            'targetForeignKey' => 'industry_id',
            'joinTable' => 'job_industry'
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
                ->requirePresence('company', 'create')
                ->notEmpty('company');

        $validator
                ->requirePresence('contact', 'create')
                ->notEmpty('contact');

        $validator
                ->integer('earnings')
                ->requirePresence('earnings', 'create')
                ->notEmpty('earnings');

        $validator
                ->requirePresence('position', 'create')
                ->notEmpty('position');

        $validator
                ->requirePresence('salary', 'create')
                ->notEmpty('salary');

        $validator
                ->requirePresence('address', 'create')
                ->notEmpty('address');

        $validator
                ->requirePresence('summary', 'create')
                ->notEmpty('summary');


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
        $rules->add($rules->existsIn(['admin_id'], 'Admins'));
        return $rules;
    }

}
