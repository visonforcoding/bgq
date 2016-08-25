<?php

namespace App\Model\Table;

use App\Model\Entity\MeetSubject;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MeetSubject Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 */
class MeetSubjectTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('meet_subject');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->belongsTo('User', [
            'className'=>'User',
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        
        $this->hasOne('SubjectBooks', [
            'className'=>'SubjectBook',
            'foreignKey' => 'subject_id',
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
                ->requirePresence('title', 'create')
                ->notEmpty('title');

        $validator
                ->requirePresence('summary', 'create')
                ->notEmpty('summary');

//        $validator
//                ->integer('type')
//                ->requirePresence('type', 'create')
//                ->notEmpty('type');

//        $validator
//                ->decimal('price')
//                ->requirePresence('price', 'create')
//                ->notEmpty('price');

//        $validator
//                ->requirePresence('address', 'create')
//                ->notEmpty('address');

//        $validator
//                ->integer('last_time')
//                ->requirePresence('last_time', 'create')
//                ->notEmpty('last_time');

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
        $rules->add($rules->existsIn(['user_id'], 'User'));
        return $rules;
    }

}
