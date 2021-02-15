<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AccountType $accountType
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Account Type'), ['action' => 'edit', $accountType->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Account Type'), ['action' => 'delete', $accountType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $accountType->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Account Types'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Account Type'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="accountTypes view content">
            <h3><?= h($accountType->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($accountType->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($accountType->id) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($accountType->description)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Buyers') ?></h4>
                <?php if (!empty($accountType->buyers)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('First Name') ?></th>
                            <th><?= __('Middle Name') ?></th>
                            <th><?= __('Last Name') ?></th>
                            <th><?= __('Gender') ?></th>
                            <th><?= __('Email') ?></th>
                            <th><?= __('Password') ?></th>
                            <th><?= __('Address Primary') ?></th>
                            <th><?= __('Address Secondary') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Account Type Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($accountType->buyers as $buyers) : ?>
                        <tr>
                            <td><?= h($buyers->id) ?></td>
                            <td><?= h($buyers->first_name) ?></td>
                            <td><?= h($buyers->middle_name) ?></td>
                            <td><?= h($buyers->last_name) ?></td>
                            <td><?= h($buyers->gender) ?></td>
                            <td><?= h($buyers->email) ?></td>
                            <td><?= h($buyers->password) ?></td>
                            <td><?= h($buyers->address_primary) ?></td>
                            <td><?= h($buyers->address_secondary) ?></td>
                            <td><?= h($buyers->created) ?></td>
                            <td><?= h($buyers->modified) ?></td>
                            <td><?= h($buyers->account_type_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Buyers', 'action' => 'view', $buyers->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Buyers', 'action' => 'edit', $buyers->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Buyers', 'action' => 'delete', $buyers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $buyers->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Sellers') ?></h4>
                <?php if (!empty($accountType->sellers)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('First Name') ?></th>
                            <th><?= __('Middle Name') ?></th>
                            <th><?= __('Last Name') ?></th>
                            <th><?= __('Email') ?></th>
                            <th><?= __('Gender') ?></th>
                            <th><?= __('Address') ?></th>
                            <th><?= __('Password') ?></th>
                            <th><?= __('Account Type Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($accountType->sellers as $sellers) : ?>
                        <tr>
                            <td><?= h($sellers->id) ?></td>
                            <td><?= h($sellers->first_name) ?></td>
                            <td><?= h($sellers->middle_name) ?></td>
                            <td><?= h($sellers->last_name) ?></td>
                            <td><?= h($sellers->email) ?></td>
                            <td><?= h($sellers->gender) ?></td>
                            <td><?= h($sellers->address) ?></td>
                            <td><?= h($sellers->password) ?></td>
                            <td><?= h($sellers->account_type_id) ?></td>
                            <td><?= h($sellers->created) ?></td>
                            <td><?= h($sellers->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Sellers', 'action' => 'view', $sellers->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Sellers', 'action' => 'edit', $sellers->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Sellers', 'action' => 'delete', $sellers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sellers->id)]) ?>
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
