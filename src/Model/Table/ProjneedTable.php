<?php

namespace App\Model\Table;

use App\Model\Entity\Projneed;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Projneed Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Industry
 */
class ProjneedTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('projneed');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->belongsToMany('Industries', [
            'className' => 'Industry',
            'foreignKey' => 'projneed_id',
            'targetForeignKey' => 'industry_id',
            'joinTable' => 'projneed_industry'
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
                ->requirePresence('title', 'create')
                ->notEmpty('title');

        $validator
                ->requirePresence('body', 'create')
                ->notEmpty('body');

        $validator
                ->requirePresence('needer', 'create')
                ->notEmpty('needer');

        $validator
                ->requirePresence('follower', 'create')
                ->notEmpty('follower');

        $validator
                ->requirePresence('stage_remark', 'create')
                ->notEmpty('stage_remark');


        return $validator;
    }

}
