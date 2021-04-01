<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Thumbnail Entity
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $is_displayed
 *
 * @property \App\Model\Entity\ThumbnailImage[] $thumbnail_image
 */
class Thumbnail extends Entity
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
        'description' => true,
        'is_displayed' => true,
        'thumbnail_images' => true,
    ];
}
