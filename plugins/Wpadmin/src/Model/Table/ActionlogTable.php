<?php
namespace Wpadmin\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Wpadmin\Model\Entity\Actionlog;

/**
 * Actionlog Model
 *
 */
class ActionlogTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('actionlog');
        $this->displayField('id');
        $this->primaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');


        $validator
            ->requirePresence('url', 'create')
            ->notEmpty('url');

        $validator
            ->requirePresence('type', 'create')
            ->notEmpty('type');

        $validator
            ->requirePresence('ip', 'create')
            ->notEmpty('ip');

        $validator
            ->requirePresence('filename', 'create')
            ->notEmpty('filename');

        $validator
            ->requirePresence('msg', 'create')
            ->notEmpty('msg');

        $validator
            ->requirePresence('param', 'create')
            ->notEmpty('param');

        $validator
            ->requirePresence('user', 'create')
            ->notEmpty('user');

        $validator
            ->dateTime('create_time')
            ->requirePresence('create_time', 'create')
            ->notEmpty('create_time');

        return $validator;
    }
}
