<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Buyer $buyer
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Buyer'), ['action' => 'edit', $buyer->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Buyer'), ['action' => 'delete', $buyer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $buyer->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Buyers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Buyer'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="buyers view content">
            <h3><?= h($buyer->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('First Name') ?></th>
                    <td><?= h($buyer->first_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Middle Name') ?></th>
                    <td><?= h($buyer->middle_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Last Name') ?></th>
                    <td><?= h($buyer->last_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($buyer->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Password') ?></th>
                    <td><?= h($buyer->password) ?></td>
                </tr>
                <tr>
                    <th><?= __('Account Type') ?></th>
                    <td><?= $buyer->has('account_type') ? $this->Html->link($buyer->account_type->name, ['controller' => 'AccountTypes', 'action' => 'view', $buyer->account_type->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($buyer->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Gender') ?></th>
                    <td><?= $this->Number->format($buyer->gender) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($buyer->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($buyer->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Address Primary') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($buyer->address_primary)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Address Secondary') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($buyer->address_secondary)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Carts') ?></h4>
                <?php if (!empty($buyer->carts)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Buyer Id') ?></th>
                            <th><?= __('Product Id') ?></th>
                            <th><?= __('Quantity') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($buyer->carts as $carts) : ?>
                        <tr>
                            <td><?= h($carts->id) ?></td>
                            <td><?= h($carts->buyer_id) ?></td>
                            <td><?= h($carts->product_id) ?></td>
                            <td><?= h($carts->quantity) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Carts', 'action' => 'view', $carts->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Carts', 'action' => 'edit', $carts->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Carts', 'action' => 'delete', $carts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $carts->id)]) ?>
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
