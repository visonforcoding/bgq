<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BookChat Entity.
 *
 * @property int $id
 * @property int $pid
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property int $reply_id
 * @property \App\Model\Entity\Reply $reply
 * @property int $subject_id
 * @property \App\Model\Entity\Subject $subject
 * @property \Cake\I18n\Time $create_time
 */
class BookChat extends Entity
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
