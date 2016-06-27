<?php
namespace App\Model\Table;

use App\Model\Entity\Education;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Education Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 */
class EducationTable extends Table
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

        $this->table('education');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Users', [
            'className'=>'User',
            'foreignKey' => 'user_id',
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
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('school', 'create')
            ->notEmpty('school','学校不可为空');

        $validator
            ->requirePresence('major', 'create')
            ->notEmpty('major','专业不可为空');

        $validator
            ->integer('education')
            ->requirePresence('education', 'create')
            ->notEmpty('education','学历不可为空');

        $validator
            ->requirePresence('start_date', 'create')
            ->notEmpty('start_date','开始时间不可为空');

        $validator
            ->requirePresence('end_date', 'create')
            ->notEmpty('end_date','结束时间不可为空');


        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        return $rules;
    }
}
