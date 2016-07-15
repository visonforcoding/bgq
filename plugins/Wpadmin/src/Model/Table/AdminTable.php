<?php

namespace Wpadmin\Model\Table;

use Wpadmin\Model\Entity\Admin;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CwpAdmin Model
 *
 */
class AdminTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('admin');
        $this->displayField('username');
        $this->primaryKey('id');
        $this->belongsToMany('g', [
            'className' => 'Wpadmin.Group',
            'joinTable' => 'admin_group',
            'foreignKey' => 'admin_id',
            'targetForeignKey' => 'group_id'
        ]);
        $this->belongsToMany('Menus', [
            'className' => 'Wpadmin.Menu',
            'joinTable' => 'admin_menu',
            'foreignKey' => 'admin_id',
            'targetForeignKey' => 'menu_id'
        ]);


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
                ->requirePresence('username', 'create')
                ->notEmpty('username')
                ->add('username', 'unique', ['rule' => 'validateUnique', 'provider' => 'table', 'message' => '该用户名已存在']);

        $validator
                ->requirePresence('password', 'create')
                ->notEmpty('password');

        $validator
                ->add('enabled', 'valid', ['rule' => 'boolean'])
                ->requirePresence('enabled', 'create')
                ->notEmpty('enabled');

        $validator
                ->add('ctime', 'valid', ['rule' => 'datetime'])
                ->allowEmpty('ctime');

        $validator
                ->add('utime', 'valid', ['rule' => 'datetime'])
                ->allowEmpty('utime');

        $validator
                ->add('login_time', 'valid', ['rule' => 'datetime'])
                ->allowEmpty('login_time');

        $validator
                ->allowEmpty('login_ip');

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
        $rules->add($rules->isUnique(['username']));
        return $rules;
    }

}
