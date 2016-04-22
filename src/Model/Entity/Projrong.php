<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Projrong Entity.
 *
 * @property int $id
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property string $publisher
 * @property string $company
 * @property string $title
 * @property string $rzjd
 * @property string $address
 * @property string $scale
 * @property string $stock
 * @property int $read_nums
 * @property int $praise_nums
 * @property int $comment_nums
 * @property string $cover
 * @property string $body
 * @property string $summary
 * @property string $comp_desc
 * @property string $team
 * @property string $attach
 * @property \Cake\I18n\Time $create_time
 * @property \Cake\I18n\Time $update_time
 */
class Projrong extends Entity
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
