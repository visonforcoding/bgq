<?php

namespace App\Model\Table;

use App\Model\Entity\BookChat;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BookChat Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Replies
 * @property \Cake\ORM\Association\BelongsTo $Subjects
 */
class BookChatTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('book_chat');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => "User"
        ]);
        $this->belongsTo('ReplyUsers', [
            'foreignKey' => 'reply_id',
            'joinType' => 'INNER',
            'className' => 'User'
        ]);
        $this->belongsTo('SubjectBooks', [
            'foreignKey' => 'book_id',
            'joinType' => 'INNER',
            'className' => 'SubjectBook'
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
    public function validationDefault(Validator $validator) {
        $validator
                ->integer('id')
                ->allowEmpty('id', 'create');
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
        $rules->add($rules->existsIn(['reply_id'], 'ReplyUsers'));
        $rules->add($rules->existsIn(['book_id'], 'SubjectBooks'));
        return $rules;
    }

}
