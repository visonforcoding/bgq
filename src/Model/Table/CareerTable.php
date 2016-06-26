<?php

namespace App\Model\Table;

use App\Model\Entity\Career;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Career Model 工作经历
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 */
class CareerTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('career');
        $this->displayField('id');
        $this->primaryKey('id');
//        $this->aliasField('desc');

        $this->belongsTo('Users', [
            'className' => 'User',
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
    public function validationDefault(Validator $validator) {
        $validator
                ->integer('id')
                ->allowEmpty('id', 'create');

        $validator
                ->requirePresence('company', 'create', '公司名称必填')
                ->notEmpty('company', '公司名称不可为空');

        $validator
                ->requirePresence('position', 'create', '职位必填')
                ->notEmpty('position', '职位不可为空');

        $validator
                ->date('start_date')
                ->requirePresence('start_date', 'create', '起始时间不可为空')
                ->notEmpty('start_date', '起始时间不可为空');

        $validator
                ->date('end_date')
                ->requirePresence('end_date', 'create', '结束时间不可为空')
                ->notEmpty('end_date', '结束时间不可为空');

        $validator
                ->requirePresence('descb', 'create', '描述不可为空')
                ->notEmpty('descb', '描述不可为空');


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
        return $rules;
    }

}
