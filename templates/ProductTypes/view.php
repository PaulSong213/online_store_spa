<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProductType $productType
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Product Type'), ['action' => 'edit', $productType->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Product Type'), ['action' => 'delete', $productType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $productType->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Product Types'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Product Type'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="productTypes view content">
            <h3><?= h($productType->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($productType->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Description') ?></th>
                    <td><?= h($productType->description) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($productType->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Products') ?></h4>
                <?php if (!empty($productType->products)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Price') ?></th>
                            <th><?= __('Primary Image Url') ?></th>
                            <th><?= __('Secondary Image Urls') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Is Available') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Seller Id') ?></th>
                            <th><?= __('Quantity') ?></th>
                            <th><?= __('Sold') ?></th>
                            <th><?= __('Warranty Day') ?></th>
                            <th><?= __('Discount Percentage') ?></th>
                            <th><?= __('Product Type Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($productType->products as $products) : ?>
                        <tr>
                            <td><?= h($products->id) ?></td>
                            <td><?= h($products->name) ?></td>
                            <td><?= h($products->price) ?></td>
                            <td><?= h($products->primary_image_url) ?></td>
                            <td><?= h($products->secondary_image_urls) ?></td>
                            <td><?= h($products->description) ?></td>
                            <td><?= h($products->is_available) ?></td>
                            <td><?= h($products->created) ?></td>
                            <td><?= h($products->modified) ?></td>
                            <td><?= h($products->seller_id) ?></td>
                            <td><?= h($products->quantity) ?></td>
                            <td><?= h($products->sold) ?></td>
                            <td><?= h($products->warranty_day) ?></td>
                            <td><?= h($products->discount_percentage) ?></td>
                            <td><?= h($products->product_type_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Products', 'action' => 'view', $products->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Products', 'action' => 'edit', $products->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Products', 'action' => 'delete', $products->id], ['confirm' => __('Are you sure you want to delete # {0}?', $products->id)]) ?>
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
