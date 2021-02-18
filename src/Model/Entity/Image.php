<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Image Entity
 *
 * @property int $id
 * @property string $file_name
 * @property string $file_root
 * @property int $product_id
 * @property int $file_size_kb
 * @property string $file_type
 *
 * @property \App\Model\Entity\Product $product
 */
class Image extends Entity
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
        'file_name' => true,
        'file_root' => true,
        'product_id' => true,
        'file_size_kb' => true,
        'file_type' => true,
        'product' => true,
    ];
}
