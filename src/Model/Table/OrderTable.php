<?php

namespace App\Model\Table;

use App\Model\Entity\Order;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Order Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Relates
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Sellers
 */
class OrderTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('`order`');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->alias('Lmorder');  //因为使用了系统关键字

        $this->belongsTo('SubjectBook', [
            'className'=>'SubjectBook',
            'foreignKey' => 'relate_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Activityapplys', [
            'className'=>'Activityapply',
            'foreignKey' => 'relate_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('InvoiceOrders', [
            'className'=>'InvoiceOrder',
            'foreignKey' => 'order_id',
            'joinType' => 'INNER'
        ]);
        
        $this->belongsTo('Users', [
            'className' => 'User',
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Sellers', [
            'className' => 'User',
            'foreignKey' => 'seller_id',
            'joinType' => 'INNER'
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
                ->integer('type')
                ->requirePresence('type', 'create')
                ->notEmpty('type');

        $validator
                ->requirePresence('order_no', 'create')
                ->notEmpty('order_no');

        $validator
                ->decimal('price')
                ->requirePresence('price', 'create')
                ->notEmpty('price');


        $validator
                ->requirePresence('remark', 'create')
                ->notEmpty('remark');

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
        $rules->add($rules->existsIn(['seller_id'], 'Sellers'));
        return $rules;
    }

}
