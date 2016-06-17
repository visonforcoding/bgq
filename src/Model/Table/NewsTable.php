<?php

namespace App\Model\Table;

use App\Model\Entity\News;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * News Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Admins
 * @property \Cake\ORM\Association\BelongsToMany $Industries
 * @property \Cake\ORM\Association\HasMany $likes
 */
class NewsTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('news');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->belongsTo('Admins', [
            'joinTable' => 'admin',
            'foreignKey' => 'admin_id',
            'joinType' => 'INNER',
            'className' => 'Wpadmin.Admin'
        ]);

        $this->belongsToMany('Industries', [
            'className' => 'Industry',
            'joinTable' => 'news_industry',
            'foreignKey' => 'news_id',
            'targetForeignKey' => 'industry_id'
        ]);
        
        $this->belongsToMany('Savants', [
            'className' => 'Savant',
            'joinTable' => 'news_savant',
            'foreignKey' => 'news_id',
            'targetForeignKey' => 'savant_id'
        ]);

        $this->hasMany('Praises', [
            'className' => 'LikeLogs',
            'joinTable' => 'like_logs',
            'joinType' => 'LEFT',
            'foreignKey' => 'relate_id',
        ]);

        $this->hasMany('Comments', [
            'className' => 'Newscom',
        ]);
        
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'User',
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
                ->requirePresence('title', 'create')
                ->notEmpty('title');

        $validator
                ->integer('read_nums')
                ->allowEmpty('read_nums');

        $validator
                ->integer('praise_nums')
                ->allowEmpty('praise_nums');

        $validator
                ->integer('comment_nums')
                ->allowEmpty('comment_nums');

        $validator
                ->allowEmpty('cover');

        $validator
                ->allowEmpty('body');

        $validator
                ->allowEmpty('summary');


        $validator
                ->dateTime('update_time')
                ->allowEmpty('update_time');

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
        $rules->add($rules->existsIn(['admin_id'], 'Admins'));
        return $rules;
    }

}
