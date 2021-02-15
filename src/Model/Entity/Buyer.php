<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Buyer Entity
 *
 * @property int $id
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property int $gender
 * @property string $email
 * @property string $password
 * @property string $address_primary
 * @property string|null $address_secondary
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int $account_type_id
 *
 * @property \App\Model\Entity\AccountType $account_type
 * @property \App\Model\Entity\Cart[] $carts
 */
class Buyer extends Entity
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
        'first_name' => true,
        'middle_name' => true,
        'last_name' => true,
        'gender' => true,
        'email' => true,
        'password' => true,
        'address_primary' => true,
        'address_secondary' => true,
        'created' => true,
        'modified' => true,
        'account_type_id' => true,
        'account_type' => true,
        'carts' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];
}
