<?php
namespace App\Model\Table;

use App\Model\Entity\RechargeGift;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RechargeGift Model
 *
 */
class RechargeGiftTable extends Table
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

        $this->table('recharge_gift');
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
            ->integer('recharge_money')
            ->requirePresence('recharge_money', 'create')
            ->notEmpty('recharge_money');

        $validator
            ->integer('gift')
            ->requirePresence('gift', 'create')
            ->notEmpty('gift');

        return $validator;
    }
}
