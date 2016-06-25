<?php
namespace App\Model\Table;

use App\Model\Entity\CardBox;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CardBox Model
 *
 */
class CardBoxTable extends Table
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

        $this->table('card_box');
        $this->displayField('id');
        $this->primaryKey('id');
        
        $this->belongsTo('OtherCard', [
            'foreignKey' => 'uid',
            'joinType' => 'INNER',
            'className' => 'User',
        ]);
        
        $this->belongsTo('MyCardCase', [
            'foreignKey' => 'ownerid',
            'joinType' => 'INNER',
            'className' => 'User',
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
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->integer('ownerid')
            ->requirePresence('ownerid', 'create')
            ->notEmpty('ownerid', '名片夹主人id不能为空');

        $validator
            ->integer('uid')
            ->requirePresence('uid', 'create')
            ->notEmpty('uid', '用户id不能为空');

        $validator
            ->integer('resend')
            ->requirePresence('resend', 'create')
            ->notEmpty('resend','是否回赠不能为空');

        return $validator;
    }
}
