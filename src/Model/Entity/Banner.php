<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Banner Entity.
 *
 * @property int $id
 * @property int $type
 * @property string $img
 * @property string $url
 * @property string $remark
 * @property \Cake\I18n\Time $create_time
 */
class Banner extends Entity
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
