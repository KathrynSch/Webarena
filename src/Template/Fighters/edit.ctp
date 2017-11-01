<?php
/**
 * @var \App\View\AppView $this
 */
?>

<div class="row" style="padding-top: 10px;">
    <div class="col-md-4"></div>
    <div class="col-md-4 pagination-centered">    
    <?= $this->Form->create('Upload',array('enctype'=>'multipart/form-data')); ?> 
    
        <legend class="pagination-centered"><?= __('Edit Your Fighter') ?></legend>
        <?php
             echo $this->Form->input('name',array('label'=>'Your fighter new name','type'=>'text'));
             echo $this->Form->input('avatar_file',array('label'=>'Fighter avatar (jpg,png,jpeg,gif)','type'=>'file')); 
        ?>
    
    <?= $this->Form->button(__('Submit'),['class'=>'btn btn-default']) ?>
    <?= $this->Form->end() ?>
    </div>
    <div class="col-md-4"></div>
</div>

