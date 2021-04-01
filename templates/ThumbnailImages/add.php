<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ThumbnailImage $thumbnailImage
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Thumbnail Images'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="thumbnailImages form content">
            <?= $this->Form->create($thumbnailImage) ?>
            <fieldset>
                <legend><?= __('Add Thumbnail Image') ?></legend>
                <?php
                    echo $this->Form->control('file_name',[
                        'value' => 'hero1.jpg'
                    ]);
                    echo $this->Form->control('file_path',[
                        'value' => '/img/thumbnails/'
                    ]);
                    echo $this->Form->control('thumbnail_id', ['options' => $thumbnails]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
