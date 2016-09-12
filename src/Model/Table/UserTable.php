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
 * @property \Cake\ORM\Association\HasOne $Savant  专家信息
 * @property \Cake\ORM\Association\HasOne $Secret 隐私设置
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

        $this->hasOne('Savant', [
            'className' => 'Savant',
            'dependent' => true, //删了用户同时会删掉专家信息记录
        ]);

        $this->hasMany('Subjects', [
            'className' => 'MeetSubject',
        ]);

        $this->belongsToMany('Industries', [
            'className' => 'Industry',
            'joinTable' => 'user_industry',
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'industry_id'
        ]);
        
        $this->hasMany('UserIndustries', [
            'className' => 'user_industry',
            'foreignKey' => 'user_id',
            'joinType' => 'LEFT'
        ]);

        $this->hasOne('Savants', [
            'foreignKey' => 'user_id',
            'joinType' => 'LEFT',
            'className' => 'Savant',
        ]);

        $this->belongsTo('Agencies', [
            'className' => 'Agency'
        ]);

        $this->hasMany('Educations', [
            'className' => 'Education',
            'foreignKey' => 'user_id'
        ]);

        $this->hasMany('Careers', [
            'className' => 'Career',
            'foreignKey' => 'user_id'
        ]);

        $this->belongsToMany('Activity', [
            'className' => 'Activity',
            'joinTable' => 'activity_savant',
            'foreignKey' => 'savant_id',
            'targetForeignKey' => 'activity_id'
        ]);


        $this->hasOne('UserFans', [
            'className' => 'UserFans',
        ]);
        $this->hasMany('Focus', [
            'className' => 'UserFans',
            'foreignKey' => 'user_id'
        ]);
        //粉丝
        $this->hasMany('Followers', [
            'className' => 'UserFans',
            'foreignKey' => 'following_id'
        ]);
        //资讯评论
        $this->hasMany('Newscoms', [
            'className' => 'Newscom',
            'foreignKey' => 'user_id'
        ]);

        //活动评论
        $this->hasMany('Activitycoms', [
            'className' => 'Activitycom',
            'foreignKey' => 'user_id'
        ]);

        $this->hasOne('CardBoxes', [
            'className' => 'CardBox',
            'foreignKey' => 'ownerid',
        ]);

        $this->belongsTo('Collect', [
            'foreignKey' => 'relate_id',
            'joinType' => 'INNER',
            'className' => 'Collect',
        ]);

        $this->hasMany('RecoUsers', [
            'foreignKey' => 'savant_id',
            'joinType' => 'LEFT',
            'className' => 'SavantReco'
        ]);
        $this->hasOne('Secret', [
            'foreignKey' => 'user_id',
            'joinType' => 'LEFT',
            'className' => 'Secret'
        ]);
        
        $this->hasMany('Activityapply', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'Activityapply'
        ]);
        $this->hasMany('UserIndustry', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'user_industry'
        ]);
        //联络人
        $this->belongsTo('Customer', [
            'className' => 'Wpadmin.Admin',
            'joinType' => 'LEFT',
            'foreignKey' => 'admin_id'
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
                ->requirePresence('phone', 'create', '手机号不可为空')
                ->notEmpty('phone', '手机号不能为空');

        $validator
                ->notBlank('truename', '姓名不可为空')
                ->requirePresence('truename', 'create', '姓名不可为空')
                ->notEmpty('truename', '姓名不可为空');

        $validator
                ->allowEmpty('company');

        $validator
                ->allowEmpty('position');

        $validator
                ->email('email', false, '邮箱输入不正确')
                ->notEmpty('email', '请输入邮箱');
        $validator
                ->allowEmpty('goodat');

//        $validator
//                ->requirePresence('card_path', 'create', '请上传名片')
//                ->notEmpty('card_path', '请上传名片');


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
        $rules->add($rules->existsIn(['industry_id'], 'Industries'));
        return $rules;
    }

}
