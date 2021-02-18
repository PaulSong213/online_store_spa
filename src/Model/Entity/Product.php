<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property int $id
 * @property string $name
 * @property string $price
 * @property string|null $description
 * @property int $is_available
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $seller_id
 * @property int $quantity
 * @property int $sold
 * @property int $warranty_day
 * @property string $discount_percentage
 * @property int $product_type_id
 *
 * @property \App\Model\Entity\Seller $seller
 * @property \App\Model\Entity\ProductType $product_type
 * @property \App\Model\Entity\Cart[] $carts
 * @property \App\Model\Entity\Tag[] $tags
 */
class Product extends Entity
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
        'name' => true,
        'price' => true,
        'description' => true,
        'is_available' => true,
        'created' => true,
        'modified' => true,
        'seller_id' => true,
        'quantity' => true,
        'sold' => true,
        'warranty_day' => true,
        'discount_percentage' => true,
        'product_type_id' => true,
        'seller' => true,
        'product_type' => true,
        'carts' => true,
        'tags' => true,
    ];
}
