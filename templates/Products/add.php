<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Products'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="products form content">
            <?= $this->Form->create($product) ?>
            <fieldset>
                <legend><?= __('Add Product') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('price');
                    echo $this->Form->control('primary_image_url');
                    echo $this->Form->control('secondary_image_urls');
                    echo $this->Form->control('description');
                    echo $this->Form->control('is_available',[
                        'type' => 'checkbox',
                        'required' => 'false'
                    ]);
                    echo $this->Form->control('seller_id', ['options' => $sellers]);
                    echo $this->Form->control('quantity');
                    echo $this->Form->control('sold');
                    echo $this->Form->control('warranty_day');
                    echo $this->Form->control('discount_percentage');
                    echo $this->Form->control('tags._ids', [
                        'options' => $tags,
                        'style' => 'height: min-content; max-height; 10rem;']);?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
