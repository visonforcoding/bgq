<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ActivityRecommend Entity.
 *
 * @property int $id
 * @property int $activity_id
 * @property \App\Model\Entity\Activity $activity
 * @property int $activity_recommend_id
 * @property \App\Model\Entity\ActivityRecommend[] $activity_recommend
 */
class ActivityRecommend extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
