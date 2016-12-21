<?php
namespace App\Model\Table;

use App\Model\Entity\MentorSubscribe;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MentorSubscribe Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Mentors
 */
class MentorSubscribeTable extends Table
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

        $this->table('mentor_subscribe');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Mentors', [
            'foreignKey' => 'mentor_id',
            'joinType' => 'INNER',
            'className' => 'Mentor'
        ]);
        
        $this->belongsTo('Users', [
            'foreignKey' => 'uid',
            'joinType' => 'INNER',
            'className' => 'User'
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
            ->integer('uid')
            ->requirePresence('uid', 'create')
            ->notEmpty('uid');

        $validator
            ->integer('is_del')
            ->requirePresence('is_del', 'create')
            ->notEmpty('is_del');

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
        $rules->add($rules->existsIn(['mentor_id'], 'Mentors'));
        return $rules;
    }
}
