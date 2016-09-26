<?php

namespace App\Model\Table;

use App\Model\Entity\Activity;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Activity Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Admins
 * @property \Cake\ORM\Association\BelongsTo $Industries
 */
class ActivityTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('activity');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->belongsTo('Admins', [
            'foreignKey' => 'admin_id',
            'joinType' => 'INNER',
            'joinTable' => 'admin',
            'className' => 'Wpadmin.Admin',
        ]);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'User',
        ]);
        
        

        $this->belongsToMany('Industries', [
            'className' => 'Industry',
            'joinTable' => 'activity_industry',
            'foreignKey' => 'activity_id',
            'targetForeignKey' => 'industry_id'
        ]);
        
        $this->belongsToMany('Activity_recommends', [
            'className' => 'Activity',
            'joinTable' => 'Activity_recommend',
            'foreignKey' => 'activity_id',
            'targetForeignKey' => 'activity_recommend_id'
        ]);
        
        $this->belongsToMany('Savants', [
            'className' => 'User',
            'joinTable' => 'activity_savant',
            'foreignKey' => 'activity_id',
            'targetForeignKey' => 'savant_id'
        ]);
        
        $this->belongsTo('Regions', [
            'foreignKey' => 'region_id',
            'joinType' => 'INNER',
            'className' => 'Region',
        ]);

        $this->belongsTo('Collect', [
            'foreignKey' => 'relate_id',
            'joinType' => 'INNER',
            'className' => 'Collect',
        ]);

        $this->hasMany('Activitycom', [
            'foreignKey' => 'activity_id',
            'joinType' => 'INNER',
            'className' => 'Activitycom',
        ]);

        $this->belongsTo('Commentlike', [
            'foreignKey' => 'relate_id',
            'joinType' => 'INNER',
            'className' => 'Commentlike',
        ]);

        $this->HasMany('Activityapply', [
            'foreignKey' => 'activity_id',
            'joinType' => 'INNER',
            'className' => 'Activityapply',
        ]);

        $this->belongsTo('Likelogs', [
            'foreignKey' => 'relate_id',
            'joinType' => 'INNER',
            'className' => 'like_logs',
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
                ->requirePresence('company', 'create')
                ->notEmpty('company');

        $validator
                ->requirePresence('title', 'create')
                ->notEmpty('title');

         $validator
                 ->requirePresence('time', 'create')
                 ->notEmpty('time', '过期时间不可为空');
//         $validator
//                 ->requirePresence('address', 'create')
//                 ->notEmpty('address');
         $validator
                 ->integer('scale','活动规模必须填数字')
                 ->notEmpty('scale');

        $validator
                ->integer('read_nums')
                ->allowEmpty('read_nums');

        $validator
                ->integer('praise_nums')
                ->allowEmpty('praise_nums');

        $validator
                ->integer('comment_nums')
                ->allowEmpty('comment_nums');

        $validator
                ->allowEmpty('cover');

        $validator
                ->notEmpty('body', '流程介绍不可为空');
        $validator
                ->notEmpty('activity_time', '活动时间不可为空');
        $validator
                ->notEmpty('company', '主办单位不可为空');
        $validator
                ->notEmpty('region_id', '地区不可为空');

        $validator
                ->notEmpty('summary', '摘要（活动介绍）不可为空');


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
        $rules->add($rules->existsIn(['admin_id'], 'Admins'));
        $rules->add($rules->existsIn(['industry_id'], 'Industries'));
        return $rules;
    }

}
