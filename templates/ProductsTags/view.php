<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProductsTag $productsTag
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Products Tag'), ['action' => 'edit', $productsTag->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Products Tag'), ['action' => 'delete', $productsTag->id], ['confirm' => __('Are you sure you want to delete # {0}?', $productsTag->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Products Tags'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Products Tag'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="productsTags view content">
            <h3><?= h($productsTag->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Product') ?></th>
                    <td><?= $productsTag->has('product') ? $this->Html->link($productsTag->product->name, ['controller' => 'Products', 'action' => 'view', $productsTag->product->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Tag') ?></th>
                    <td><?= $productsTag->has('tag') ? $this->Html->link($productsTag->tag->name, ['controller' => 'Tags', 'action' => 'view', $productsTag->tag->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($productsTag->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
