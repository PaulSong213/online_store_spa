<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Seller $seller
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $seller->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $seller->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Sellers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="sellers form content">
            <?= $this->Form->create($seller) ?>
            <fieldset>
                <legend><?= __('Edit Seller') ?></legend>
                <?php
                    echo $this->Form->control('first_name');
                    echo $this->Form->control('middle_name');
                    echo $this->Form->control('last_name');
                    echo $this->Form->control('email');
                    echo $this->Form->control('gender');
                    echo $this->Form->control('address');
                    echo $this->Form->control('password');
                    echo $this->Form->control('account_type_id', ['options' => $accountTypes]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
