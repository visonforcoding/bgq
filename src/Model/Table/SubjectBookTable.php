<?php

namespace App\Model\Table;

use App\Model\Entity\SubjectBook;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SubjectBook Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Subjects
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Savants
 */
class SubjectBookTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('subject_book');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasOne('Lmorder',[
            'className'=>'Order',
            'foreignKey'=>'relate_id',
            'joinType'=>'LEFT'
        ]);
        $this->belongsTo('Subjects', [
            'className' => 'MeetSubject',
            'foreignKey' => 'subject_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'className' => 'User',
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Savants', [
            'className' => 'User',
            'foreignKey' => 'savant_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Usermsgs', [
            'className' => 'Usermsg',
            'foreignKey' => 'table_id',
            'joinType' => 'LEFT'
        ]);
        $this->hasMany('BookChats', [
            'className' => 'BookChat',
            'foreignKey' => 'book_id',
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
        $rules->add($rules->existsIn(['subject_id'], 'Subjects'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['savant_id'], 'Savants'));
        return $rules;
    }

}
