<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Thumbnail $thumbnail
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Thumbnail'), ['action' => 'edit', $thumbnail->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Thumbnail'), ['action' => 'delete', $thumbnail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $thumbnail->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Thumbnails'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Thumbnail'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="thumbnails view content">
            <h3><?= h($thumbnail->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($thumbnail->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Description') ?></th>
                    <td><?= h($thumbnail->description) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($thumbnail->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Displayed') ?></th>
                    <td><?= $this->Number->format($thumbnail->is_displayed) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Thumbnail Image') ?></h4>
                <?php if (!empty($thumbnail->thumbnail_image)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('File Name') ?></th>
                            <th><?= __('File Path') ?></th>
                            <th><?= __('Thumbnail Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($thumbnail->thumbnail_image as $thumbnailImage) : ?>
                        <tr>
                            <td><?= h($thumbnailImage->id) ?></td>
                            <td><?= h($thumbnailImage->file_name) ?></td>
                            <td><?= h($thumbnailImage->file_path) ?></td>
                            <td><?= h($thumbnailImage->thumbnail_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'ThumbnailImage', 'action' => 'view', $thumbnailImage->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'ThumbnailImage', 'action' => 'edit', $thumbnailImage->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'ThumbnailImage', 'action' => 'delete', $thumbnailImage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $thumbnailImage->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
