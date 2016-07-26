<?php
namespace App\Model\Table;

use App\Model\Entity\ActivityRecommend;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ActivityRecommend Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Activities
 * @property \Cake\ORM\Association\BelongsTo $ActivityRecommends
 * @property \Cake\ORM\Association\HasMany $ActivityRecommend
 */
class ActivityRecommendTable extends Table
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

        $this->table('activity_recommend');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Activities', [
            'className' => 'Activity',
            'foreignKey' => 'activity_id',
            'joinType' => 'INNER'
        ]);
//        $this->belongsTo('ActivityRecommends', [
//            'foreignKey' => 'activity_recommend_id',
//            'joinType' => 'INNER'
//        ]);
//        $this->hasMany('ActivityRecommend', [
//            'foreignKey' => 'activity_recommend_id'
//        ]);
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
        $rules->add($rules->existsIn(['activity_id'], 'Activities'));
//        $rules->add($rules->existsIn(['activity_recommend_id'], 'ActivityRecommends'));
        return $rules;
    }
}
