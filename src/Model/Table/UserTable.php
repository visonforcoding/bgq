<?php

namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * User Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Industries
 * @property \Cake\ORM\Association\BelongsTo $Agencies
 * @property \Cake\ORM\Association\HasOne $Savant
 * @property \Cake\ORM\Association\HasMany $Subject
 */
class UserTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('user');
        $this->displayField('truename');
        $this->primaryKey('id');
        
        $this->hasOne('Savant',[
            'className' => 'Savant',
            'dependent' => true,  //删了用户同时会删掉专家信息记录
        ]);

        $this->hasMany('Subjects',[
            'className'=>'MeetSubject',
            ''
        ]);
        $this->belongsToMany('Industries', [
            'className' => 'Industry',
            'joinTable' => 'user_industry',
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'industry_id'
        ]);
        
        $this->belongsTo('Agencies');

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
                ->requirePresence('phone', 'create', '手机号不可为空')
                ->notEmpty('phone');

        $validator
                ->requirePresence('truename', 'create', '姓名不可为空')
                ->notEmpty('truename');

        $validator
                ->allowEmpty('company');

        $validator
                ->allowEmpty('position');

        $validator
                ->email('email')
                ->allowEmpty('email');


        $validator
                ->allowEmpty('goodat');

        $validator
                ->requirePresence('card_path', 'create', '请上传名片')
                ->notEmpty('card_path');


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
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->isUnique(['phone']));
        $rules->add($rules->existsIn(['industry_id'], 'Industries'));
        return $rules;
    }

}
