<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SavantReco Entity.
 *
 * @property int $id
 * @property int $savant_id
 * @property \App\Model\Entity\Savant $savant
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property int $create_time
 */
class SavantReco extends Entity
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
