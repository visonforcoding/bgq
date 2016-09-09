<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Pushlog Entity.
 *
 * @property int $id
 * @property int $push_id
 * @property \App\Model\Entity\Push $push
 * @property int $receive_id
 * @property \App\Model\Entity\Receife $receife
 * @property string $title
 * @property string $body
 * @property int $type
 * @property int $is_success
 * @property \Cake\I18n\Time $create_time
 */
class Pushlog extends Entity
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
