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
        $this->belongsTo('Industries', [
            'foreignKey' => 'industry_id',
            'joinType' => 'INNER',
            'className' => 'Industry',
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
                ->notEmpty('time');

        $validator
                ->requirePresence('address', 'create')
                ->notEmpty('address');

        $validator
                ->requirePresence('scale', 'create')
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
                ->allowEmpty('body');

        $validator
                ->allowEmpty('summary');


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
