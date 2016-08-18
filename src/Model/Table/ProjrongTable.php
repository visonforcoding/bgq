<?php

namespace App\Model\Table;

use App\Model\Entity\Projrong;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Projrong Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 */
class ProjrongTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('projrong');
        $this->displayField('title');
        $this->primaryKey('id');
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'LEFT',
            'className' => 'User'
        ]);
        $this->belongsToMany('Industries', [
            'className' => 'Industry',
            'joinTable' => 'rong_tag',
            'foreignKey' => 'project_id',
            'targetForeignKey' => 'industry_id'
        ]);
        $this->belongsTo('Stage', [
            'className' => 'Stage',
        ]);
        $this->belongsTo('Scale', [
            'className' => 'Scale',
        ]);
        $this->hasMany('Attachs', [
            'className' => 'Attach',
            'joinTable' => 'attach',
            'joinType' => 'LEFT',
            'foreignKey' => 'proj_id',
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
                ->requirePresence('publisher', 'create')
                ->notEmpty('publisher');

        $validator
                ->requirePresence('company', 'create')
                ->notEmpty('company');

        $validator
                ->requirePresence('title', 'create')
                ->notEmpty('title');


        $validator
                ->requirePresence('address', 'create')
                ->notEmpty('address');


        $validator
                ->requirePresence('stock', 'create')
                ->notEmpty('stock');

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

        $validator
                ->allowEmpty('comp_desc');

        $validator
                ->allowEmpty('team');

        $validator
                ->allowEmpty('attach');


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
