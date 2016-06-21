<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BiggieAd Entity.
 *
 * @property int $id
 * @property int $savant_id
 * @property \App\Model\Entity\Savant $savant
 * @property string $url
 * @property \Cake\I18n\Time $create_time
 */
class BiggieAd extends Entity
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
