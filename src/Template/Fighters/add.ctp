<?php $this->assign('title', 'Fighter'); ?>


<div class="row" style="padding-top: 10px;">
    <div class="col-md-4"></div>
    <div class="col-md-4 pagination-centered">
    <?= $this->Form->create('Upload',array('enctype'=>'multipart/form-data')); ?> 
    
        <legend class="pagination-centered"><?= __('Create your new fighter !') ?></legend>

        <?php
             echo $this->Form->input('name',array('label'=>'Fighter name','type'=>'text'), ['input'=>['class'=>'form_control']]);
             echo $this->Form->input('avatar_file',array('label'=>'Fighter avatar (jpg,png,jpeg,gif)','type'=>'file')); 
        ?>
    
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-default']) ?>
    <?= $this->Form->end() ?>
    </div>
    <div class="col-md-4"></div>
</div>

