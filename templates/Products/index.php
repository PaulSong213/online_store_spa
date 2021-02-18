<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product[]|\Cake\Collection\CollectionInterface $products
 */
?>
<div class="products index content">
    <?= $this->Html->link(__('New Product'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Products') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('price','Base Price') ?></th>
                    <th><?= $this->Paginator->sort('Discounted Price') ?></th>
                    <th><?= $this->Paginator->sort('is_available') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('seller_id') ?></th>
                    <th><?= $this->Paginator->sort('quantity') ?></th>
                    <th><?= $this->Paginator->sort('sold') ?></th>
                    <th><?= $this->Paginator->sort('warranty_day') ?></th>
                    <th><?= $this->Paginator->sort('discount_percentage') ?></th>
                    <th><?= $this->Paginator->sort('produt_type_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $this->Number->format($product->id) ?></td>
                    <td><?= h($product->name) ?></td>
                    <td><?= $this->Number->format($product->price) ?></td>
                    <td><?= $this->Calculate->discountedPrice($this->Number->format($product->price),$this->Number->format($product->discount_percentage)) ?></td>
                    <td><?= $this->Boolean->isAvailable($this->Number->format($product->is_available)) ?></td>
                    <td><?= h($product->created) ?></td>
                    <td><?= h($product->modified) ?></td>
                    <td><?= $product->has('seller') ? $this->Html->link(
                            $product->seller->first_name.' '.substr(strtoupper($product->seller->middle_name),0,1).'. '.$product->seller->last_name.
                            ' | '.$product->seller->email,
                            ['controller' => 'Sellers', 'action' => 'view',
                            $product->seller->id]) : '' ?></td>
                    <td><?= $this->Number->format($product->quantity) ?></td>
                    <td><?= $this->Number->format($product->sold) ?></td>
                    <td><?= $this->Number->format($product->warranty_day).' Days' ?></td>
                    <td><?= $this->Number->format($product->discount_percentage).'%' ?></td>
                    <td><?= $product->has('product_type') ? $this->Html->link(
                            $product->product_type->name,
                            ['controller' => 'ProductTypes', 'action' => 'view',
                            $product->product_type->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $product->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $product->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $product->id], ['confirm' => __('Are you sure you want to delete # {0}?', $product->id)]) ?>
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
