<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ThumbnailImage Entity
 *
 * @property int $id
 * @property string $file_name
 * @property string $file_path
 * @property int $thumbnail_id
 *
 * @property \App\Model\Entity\Thumbnail $thumbnail
 */
class ThumbnailImage extends Entity
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
        'file_path' => true,
        'thumbnail_id' => true,
        'thumbnail' => true,
    ];
}
