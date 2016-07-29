<?php

namespace App\Model\Table;

use App\Model\Entity\Newscom;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Newscom Model
 *
 * @property \Cake\ORM\Association\BelongsTo $News
 * @property \Cake\ORM\Association\BelongsTo $Users
 */
class NewscomTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('newscom');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('News', [
            'className' => 'News',
            'foreignKey' => 'news_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'className' => 'User',
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Reply', [
            'className' => 'User',
            'foreignKey' => 'reply_user',
            'joinType' => 'LEFT'
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
                ->requirePresence('body', 'create', '评论内容不可为空')
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
        $rules->add($rules->existsIn(['news_id'], 'News'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
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
        \Cake\Log\Log::debug($children,'devlog');
        if (!empty($children)) {
            foreach ($children as $child) {
                $this->delete($child);
            }
        }
    }

}
