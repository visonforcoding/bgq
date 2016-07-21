<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Candidate Entity.
 *
 * @property int $id
 * @property int $job_id
 * @property \App\Model\Entity\Job $job
 * @property string $truename
 * @property \Cake\I18n\Time $birthday
 * @property string $phone
 * @property string $email
 * @property string $address
 * @property string $career
 * @property string $education
 * @property string $salary
 * @property \Cake\I18n\Time $create_time
 * @property \Cake\I18n\Time $update_time
 */
class Candidate extends Entity
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
