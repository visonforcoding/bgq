<?php

namespace App\Model\Table;

use App\Model\Entity\LikeLog;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LikeLogs Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Relates
 * @property \Cake\ORM\Association\BelongsTo $News
 */
class LikeLogsTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('like_logs');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Users', [
            'className' => 'User',
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'User'
        ]);
        $this->belongsTo('News', [
            'className' => 'News',
            'joinType' => 'INNER',
            'foreignKey' => 'relate_id',
        ]);
        $this->belongsTo('Activities', [
            'foreignKey' => 'relate_id',
            'joinType' => 'INNER',
            'className' => 'Activity'
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
                ->requirePresence('msg', 'create')
                ->notEmpty('msg');

        $validator
                ->integer('type')
                ->requirePresence('type', 'create')
                ->notEmpty('type');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
//         $rules->add($rules->existsIn(['relate_id'], 'Relates'));
        return $rules;
    }

}
