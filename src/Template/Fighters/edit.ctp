<?php
/**
 * @var \App\View\AppView $this
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Fighters'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="fighters form large-9 medium-8 columns content">
    <?= $this->Form->create('Upload',array('enctype'=>'multipart/form-data')); ?> 
    <fieldset>
        <legend><?= __('Edit Fighter') ?></legend>
        <?php
             echo $this->Form->input('name',array('label'=>'Fighter name','type'=>'text'));
             echo $this->Form->input('avatar_file',array('label'=>'Fighter avatar (jpg,png,jpeg,gif)','type'=>'file')); 
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
