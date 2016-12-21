<?php
namespace App\Model\Table;

use App\Model\Entity\Course;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Course Model
 *
 * @property \Cake\ORM\Association\HasMany $Class
 */
class CourseTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('course');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->hasMany('Classes', [
            'foreignKey' => 'course_id',
            'className' => 'Class'
        ]);
        
        $this->hasOne('CourseApplies', [
            'foreignKey' => 'course_id',
            'className' => 'CourseApply'
        ]);
        
        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave'=>[
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
    public function validationDefault(Validator $validator)
    {
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
            ->numeric('fee')
            ->allowEmpty('fee');

        $validator
            ->numeric('bonus_fee')
            ->allowEmpty('bonus_fee');

        $validator
            ->dateTime('bonus_start_time')
            ->allowEmpty('bonus_start_time');

        $validator
            ->dateTime('bonus_end_time')
            ->allowEmpty('bonus_end_time');

        $validator
            ->integer('is_online')
            ->allowEmpty('is_online');

        return $validator;
    }
}
