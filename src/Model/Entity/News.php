<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * News Entity.
 *
 * @property int $id
 * @property int $admin_id
 * @property \App\Model\Entity\Admin $admin
 * @property string $title
 * @property int $read_nums
 * @property int $praise_nums
 * @property int $comment_nums
 * @property string $cover
 * @property string $body
 * @property string $summary
 * @property \Cake\I18n\Time $create_time
 * @property \Cake\I18n\Time $update_time
 */
class News extends Entity
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
    
     protected $_hidden = [
        '_joinData'
    ];
}
