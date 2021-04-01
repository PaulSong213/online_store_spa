<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ThumbnailImage $thumbnailImage
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Thumbnail Image'), ['action' => 'edit', $thumbnailImage->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Thumbnail Image'), ['action' => 'delete', $thumbnailImage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $thumbnailImage->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Thumbnail Images'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Thumbnail Image'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="thumbnailImages view content">
            <h3><?= h($thumbnailImage->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('File Name') ?></th>
                    <td><?= h($thumbnailImage->file_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('File Path') ?></th>
                    <td><?= h($thumbnailImage->file_path) ?></td>
                </tr>
                <tr>
                    <th><?= __('Thumbnail') ?></th>
                    <td><?= $thumbnailImage->has('thumbnail') ? $this->Html->link($thumbnailImage->thumbnail->name, ['controller' => 'Thumbnails', 'action' => 'view', $thumbnailImage->thumbnail->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($thumbnailImage->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
