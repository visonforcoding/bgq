<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Sponsor Entity.
 *
 * @property int $id
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property int $activity_id
 * @property \App\Model\Entity\Activity $activity
 * @property \Cake\I18n\Time $create_time
 * @property int $type
 * @property string $description
 * @property string $name
 * @property string $company
 * @property string $department
 * @property string $position
 * @property string $address
 * @property int $people
 */
class Sponsor extends Entity
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
