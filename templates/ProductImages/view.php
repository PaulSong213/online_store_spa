<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProductImage $productImage
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Product Image'), ['action' => 'edit', $productImage->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Product Image'), ['action' => 'delete', $productImage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $productImage->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Product Images'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Product Image'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="productImages view content">
            <h3><?= h($productImage->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('File Name') ?></th>
                    <td><?= h($productImage->file_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('File Root') ?></th>
                    <td><?= h($productImage->file_root) ?></td>
                </tr>
                <tr>
                    <th><?= __('File Type') ?></th>
                    <td><?= h($productImage->file_type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Product') ?></th>
                    <td><?= $productImage->has('product') ? $this->Html->link($productImage->product->name, ['controller' => 'Products', 'action' => 'view', $productImage->product->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($productImage->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('File Size Kb') ?></th>
                    <td><?= $this->Number->format($productImage->file_size_kb) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
