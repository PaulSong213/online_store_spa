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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $productImage->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $productImage->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Product Images'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="productImages form content">
            <?= $this->Form->create($productImage) ?>
            <fieldset>
                <legend><?= __('Edit Product Image') ?></legend>
                <?php
                    echo $this->Form->control('file_name');
                    echo $this->Form->control('file_root');
                    echo $this->Form->control('file_size_kb');
                    echo $this->Form->control('file_type');
                    echo $this->Form->control('product_id', ['options' => $products]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
