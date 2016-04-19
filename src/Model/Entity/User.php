<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * User Entity.
 *
 * @property int $id
 * @property string $phone
 * @property string $pwd
 * @property string $truename
 * @property string $level
 * @property string $idcard
 * @property string $company
 * @property string $position
 * @property string $email
 * @property int $gender
 * @property int $industry_id
 * @property \App\Model\Entity\Industry $industry
 * @property string $goodat
 * @property int $city_id
 * @property \App\Model\Entity\City $city
 * @property string $card_path
 * @property string $avatar
 * @property string $ymjy
 * @property string $ywnl
 * @property string $reason
 * @property int $status
 * @property \Cake\I18n\Time $create_time
 * @property \Cake\I18n\Time $update_time
 */
class User extends Entity {

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

    protected function _setPwd($password) {
        return (new DefaultPasswordHasher)->hash($password);
    }

}
