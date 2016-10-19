<?php
namespace App\Model\Table;

use App\Model\Entity\Invoice;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Invoice Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsToMany $Order
 */
class InvoiceTable extends Table
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

        $this->table('invoice');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'user',
        ]);
        $this->belongsToMany('InvoiceOrders', [
            'foreignKey' => 'invoice_id',
            'targetForeignKey' => 'order_id',
            'joinTable' => 'invoice_order',
            'className' => 'Order',
            'dependent' => true,
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
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('is_VAT')
            ->requirePresence('is_VAT', 'create')
            ->notEmpty('is_VAT');

        $validator
            ->requirePresence('company', 'create')
            ->notEmpty('company');

        $validator
            ->decimal('sum')
            ->requirePresence('sum', 'create')
            ->notEmpty('sum');

        $validator
            ->requirePresence('recipient', 'create')
            ->notEmpty('recipient');

        $validator
            ->requirePresence('recipient_phone', 'create')
            ->notEmpty('recipient_phone');

        $validator
            ->requirePresence('recipient_address', 'create')
            ->notEmpty('recipient_address');

        $validator
            ->allowEmpty('registration_num');

        $validator
            ->allowEmpty('company_address');

        $validator
            ->allowEmpty('company_phone');

        $validator
            ->allowEmpty('back');

        $validator
            ->allowEmpty('back_account');

        $validator
            ->integer('is_shipment')
            ->allowEmpty('is_shipment');

        $validator
            ->allowEmpty('shipment_express');

        $validator
            ->allowEmpty('shipment_number');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        return $rules;
    }
}
