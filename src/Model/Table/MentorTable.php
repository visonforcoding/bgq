<?php

namespace App\Model\Table;

use App\Model\Entity\Mentor;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Mentor Model
 *
 * @property \Cake\ORM\Association\HasMany $Class
 * @property \Cake\ORM\Association\HasMany $MentorSubscribe
 */
class MentorTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('mentor');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->hasMany('Classes', [
            'foreignKey' => 'mentor_id',
            'className' => 'Class'
        ]);
        $this->hasMany('MentorSubscribes', [
            'foreignKey' => 'mentor_id',
            'className' => 'MentorSubscribe'
        ]);
        $this->hasOne('MentorSubscribe', [
            'foreignKey' => 'mentor_id',
            'className' => 'MentorSubscribe'
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
                ->requirePresence('name', 'create')
                ->notEmpty('name');

        $validator
                ->requirePresence('company', 'create')
                ->notEmpty('company');

        $validator
                ->requirePresence('position', 'create')
                ->notEmpty('position');

        $validator
                ->requirePresence('introduce', 'create')
                ->notEmpty('introduce');

        return $validator;
    }

}
