<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Seller Entity
 *
 * @property int $id
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $email
 * @property int $gender
 * @property string $address
 * @property string $password
 * @property int $account_type_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\AccountType $account_type
 * @property \App\Model\Entity\Product[] $products
 */
class Seller extends Entity
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
        'email' => true,
        'gender' => true,
        'address' => true,
        'password' => true,
        'account_type_id' => true,
        'created' => true,
        'modified' => true,
        'account_type' => true,
        'products' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];
    
    protected function getMiddleInitial()
    {
        return $middleInitial = substr($this->middle_name,0,1);
         
    }
    
    protected function _getFullNameEmail()
    {
        $middleInitial = strtoupper($this->getMiddleInitial()).'.';
        return $this->first_name.' '.$middleInitial.'  '.$this->last_name.' | '.$this->email;
    }
    
}
