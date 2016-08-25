<?php
namespace App\Model\Table;

use App\Model\Entity\Ptag;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ptag Model
 *
 */
class PtagTable extends Table
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

        $this->table('ptag');
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
            ->integer('ptag')
            ->requirePresence('ptag', 'create')
            ->notEmpty('ptag');

        $validator
            ->requirePresence('desc', 'create')
            ->notEmpty('desc');

        $validator
            ->requirePresence('create_time', 'create')
            ->notEmpty('create_time');

        $validator
            ->requirePresence('update_time', 'create')
            ->notEmpty('update_time');

        return $validator;
    }
}
