<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ThumbnailImage[]|\Cake\Collection\CollectionInterface $thumbnailImages
 */
?>
<div class="thumbnailImages index content">
    <?= $this->Html->link(__('New Thumbnail Image'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Thumbnail Images') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('file_name') ?></th>
                    <th><?= $this->Paginator->sort('file_path') ?></th>
                    <th><?= $this->Paginator->sort('thumbnail_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($thumbnailImages as $thumbnailImage): ?>
                <tr>
                    <td><?= $this->Number->format($thumbnailImage->id) ?></td>
                    <td><?= h($thumbnailImage->file_name) ?></td>
                    <td><?= h($thumbnailImage->file_path) ?></td>
                    <td><?= $thumbnailImage->has('thumbnail') ? $this->Html->link($thumbnailImage->thumbnail->name, ['controller' => 'Thumbnails', 'action' => 'view', $thumbnailImage->thumbnail->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $thumbnailImage->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $thumbnailImage->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $thumbnailImage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $thumbnailImage->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
