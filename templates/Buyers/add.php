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
            <?= $this->Html->link(__('List Buyers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="buyers form content">
            <?= $this->Form->create($buyer) ?>
            <fieldset>
                <legend><?= __('Add Buyer') ?></legend>
                <?php
                    echo $this->Form->control('first_name');
                    echo $this->Form->control('middle_name');
                    echo $this->Form->control('last_name');
                    echo $this->Gender->genderSelect('gender');
                    echo $this->Form->control('email');
                    echo $this->Form->control('password');
                    echo $this->Form->control('address_primary');
                    echo $this->Form->control('address_secondary');
                    echo $this->Form->control('account_type_id', ['options' => $accountTypes]);
                    
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
