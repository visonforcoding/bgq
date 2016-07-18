<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Projneed Entity.
 *
 * @property int $id
 * @property string $title
 * @property string $body
 * @property string $needer
 * @property string $follower
 * @property string $stage_remark
 * @property \Cake\I18n\Time $create_time
 * @property \Cake\I18n\Time $update_time
 * @property \App\Model\Entity\Industry[] $industry
 */
class Projneed extends Entity
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
