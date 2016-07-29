<?php

namespace App\Model\Table;

use App\Model\Entity\Activitycom;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Activitycom Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Activities
 * @property \Cake\ORM\Association\BelongsTo $Users
 */
class ActivitycomTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('activitycom');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Activities', [
            'foreignKey' => 'activity_id',
            'joinType' => 'INNER',
            'className' => 'Activity'
        ]);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'User'
        ]);

        $this->belongsTo('Replyusers', [
            'foreignKey' => 'reply_id',
            'joinType' => 'INNER',
            'className' => 'User'
        ]);
        $this->hasMany('Likes', [
            'className' => 'CommentLike',
            'joinType' => 'LEFT',
            'foreignKey' => 'relate_id',
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
    public function validationDefault(Validator $validator) {
        $validator
                ->integer('id')
                ->allowEmpty('id', 'create');

        $validator
                ->integer('pid')
                ->requirePresence('pid', 'create')
                ->notEmpty('pid');

        $validator
                ->requirePresence('body', 'create')
                ->notEmpty('body');

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
        $rules->add($rules->existsIn(['activity_id'], 'Activities'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['reply_id'], 'Users'));
        return $rules;
    }
    
        /**
     * 删除后事件
     * @param type $event
     * @param type $entity
     * @param type $options
     */
    public function afterDelete($event, $entity, $options) {
        $this->deleteChildren($entity->id);
    }

    private function deleteChildren($parentId) {
        $children = $this->findByPid($parentId)->toArray();
        if (!empty($children)) {
            foreach ($children as $child) {
                $this->delete($child);
            }
        }
    }

}
