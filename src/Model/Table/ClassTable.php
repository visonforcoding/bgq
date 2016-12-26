<?php

namespace App\Model\Table;

use App\Model\Entity\Clas;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Class Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Mentors
 * @property \Cake\ORM\Association\BelongsTo $Courses
 */
class ClassTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('class');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->belongsTo('Mentors', [
            'foreignKey' => 'mentor_id',
            'joinType' => 'INNER',
            'className' => 'Mentor'
        ]);
        $this->belongsTo('Courses', [
            'foreignKey' => 'course_id',
            'joinType' => 'INNER',
            'className' => 'Course'
        ]);
        
        $this->hasOne('ClassLearns', [
            'foreignKey' => 'class_id',
            'className' => 'ClassLearn'
        ]);
        $this->hasMany('ClassPics', [
            'foreignKey' => 'class_id',
            'joinType' => 'LEFT',
            'className' => 'ClassPic'
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
                ->requirePresence('abstract', 'create')
                ->notEmpty('abstract');

        $validator
                ->allowEmpty('audio');

        $validator
                ->allowEmpty('zip');

        $validator
                ->integer('is_free')
                ->allowEmpty('is_free');

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
        $rules->add($rules->existsIn(['mentor_id'], 'Mentors'));
        $rules->add($rules->existsIn(['course_id'], 'Courses'));
        return $rules;
    }

}
