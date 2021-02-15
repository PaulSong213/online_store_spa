<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Seller[]|\Cake\Collection\CollectionInterface $sellers
 */
?>
<div class="sellers index content">
    <?= $this->Html->link(__('New Seller'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Sellers') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('first_name') ?></th>
                    <th><?= $this->Paginator->sort('middle_name') ?></th>
                    <th><?= $this->Paginator->sort('last_name') ?></th>
                    <th><?= $this->Paginator->sort('email') ?></th>
                    <th><?= $this->Paginator->sort('gender') ?></th>
                    <th><?= $this->Paginator->sort('password') ?></th>
                    <th><?= $this->Paginator->sort('account_type_id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sellers as $seller): ?>
                <tr>
                    <td><?= $this->Number->format($seller->id) ?></td>
                    <td><?= h($seller->first_name) ?></td>
                    <td><?= h($seller->middle_name) ?></td>
                    <td><?= h($seller->last_name) ?></td>
                    <td><?= h($seller->email) ?></td>
                    <td><?= $this->Number->format($seller->gender) ?></td>
                    <td><?= h($seller->password) ?></td>
                    <td><?= $seller->has('account_type') ? $this->Html->link($seller->account_type->name, ['controller' => 'AccountTypes', 'action' => 'view', $seller->account_type->id]) : '' ?></td>
                    <td><?= h($seller->created) ?></td>
                    <td><?= h($seller->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $seller->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $seller->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $seller->id], ['confirm' => __('Are you sure you want to delete # {0}?', $seller->id)]) ?>
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
