<?php

namespace Admin\Model\Table;

use Admin\Model\Entity\Movie;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CwpMovie Model
 *
 */
class MovieTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('cwp_movie');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'ctime' => 'new',
                    'utime' => 'always'
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
                ->add('id', 'valid', ['rule' => 'numeric'])
                ->allowEmpty('id', 'create');

        $validator
                ->requirePresence('pic', 'create')
                ->notEmpty('pic');

        $validator
                ->requirePresence('movie', 'create')
                ->notEmpty('movie');

        $validator
                ->requirePresence('url', 'create')
                ->notEmpty('url');

        $validator
                ->add('ctime', 'valid', ['rule' => 'datetime'])
                ->allowEmpty('ctime');

        $validator
                ->add('hits', 'valid', ['rule' => 'numeric'])
                ->requirePresence('hits', 'create')
                ->notEmpty('hits');

        $validator
                ->add('utime', 'valid', ['rule' => 'datetime'])
                ->allowEmpty('utime');

        return $validator;
    }

}
