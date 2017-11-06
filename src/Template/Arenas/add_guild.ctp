<?php $this->assign('title', 'Guild'); ?>

<div class="row" style="padding-top: 10px;">
    <div class="col-md-4"></div>
    <div class="col-md-4 pagination-centered">
    <?= $this->Form->create('Upload',array('enctype'=>'multipart/form-data')); ?> 
    
        <legend><?= __('Creat a new guild') ?></legend>
        <?php
             echo $this->Form->input('name',array('label'=>'Guild name','type'=>'text'));
        ?>
    
    <?= $this->Form->button(__('Submit'),['class'=>'btn btn-default']) ?>
    <?= $this->Form->end() ?>
        </div>
    <div class="col-md-4"></div>
</div>

