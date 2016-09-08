<?php

namespace App\Model\Table;

use App\Model\Entity\Pvlog;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Pvlog Model
 *
 */
class PvlogTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('pvlog');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->belongsTo('Pvtag', [
            'bindingKey'=>'ptag',
            'foreignKey' => 'ptag',
            'className' => 'Pvtag',
            'joinType'=>'LEFT'
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
                ->requirePresence('ip', 'create')
                ->notEmpty('ip');

        $validator
                ->requirePresence('screen', 'create')
                ->notEmpty('screen');

        $validator
                ->requirePresence('refer', 'create')
                ->notEmpty('refer');

        $validator
                ->requirePresence('act', 'create')
                ->notEmpty('act');

        $validator
                ->requirePresence('useragent', 'create')
                ->notEmpty('useragent');


        return $validator;
    }

}
