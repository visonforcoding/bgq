<?php
namespace App\Model\Table;

use App\Model\Entity\Pushlog;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Pushlog Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Pushes
 * @property \Cake\ORM\Association\BelongsTo $Receives
 */
class PushlogTable extends Table
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

        $this->table('pushlog');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->belongsTo('Pushes', [
            'foreignKey' => 'push_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Receives', [
            'foreignKey' => 'receive_id',
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
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->requirePresence('body', 'create')
            ->notEmpty('body');

        $validator
            ->integer('type')
            ->requirePresence('type', 'create')
            ->notEmpty('type');

//        $validator
//            ->integer('is_success')
//            ->requirePresence('is_success', 'create')
//            ->notEmpty('is_success');

//        $validator
//            ->dateTime('create_time')
//            ->requirePresence('create_time', 'create')
//            ->notEmpty('create_time');

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
//        $rules->add($rules->existsIn(['push_id'], 'Users'));
//        $rules->add($rules->existsIn(['receive_id'], 'Users'));
        return $rules;
    }
}
