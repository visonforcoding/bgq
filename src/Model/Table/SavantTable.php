<?php
namespace App\Model\Table;

use App\Model\Entity\Savant;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Savant Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 */
class SavantTable extends Table
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

        $this->table('savant');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsToMany('News', [
            'className' => 'News',
            'joinTable' => 'news_savant',
            'foreignKey' => 'savant_id',
            'targetForeignKey' => 'news_id'
        ]);
        

        $this->belongsTo('Users', [
            'className'=>'User',
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
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
             ->notEmpty('xmjy','项目经验不可为空', 'create');
        
        $validator
             ->notEmpty('zyys', '擅长话题不可为空', 'create');


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
