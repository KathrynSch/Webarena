<?php
/**
 * @var \App\View\AppView $this
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Guilds'), ['action' => 'guild']) ?></li>
    </ul>
</nav>
<div class="guilds form large-9 medium-8 columns content">
    <?= $this->Form->create('Upload',array('enctype'=>'multipart/form-data')); ?> 
    <fieldset>
        <legend><?= __('Add Guild') ?></legend>
        <?php
             echo $this->Form->input('name',array('label'=>'Guild name','type'=>'text'));
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
