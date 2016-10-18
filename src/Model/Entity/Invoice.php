<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Invoice Entity.
 *
 * @property int $id
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property int $is_VAT
 * @property string $company
 * @property float $sum
 * @property string $recipient
 * @property string $recipient_phone
 * @property string $recipient_address
 * @property string $registration_num
 * @property string $company_address
 * @property string $company_phone
 * @property string $back
 * @property string $back_account
 * @property int $is_shipment
 * @property string $shipment_express
 * @property string $shipment_number
 * @property \Cake\I18n\Time $create_time
 * @property \Cake\I18n\Time $update_time
 * @property \App\Model\Entity\Order[] $order
 */
class Invoice extends Entity
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
