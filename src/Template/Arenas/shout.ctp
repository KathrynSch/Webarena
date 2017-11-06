<?php $this->assign('title', 'Shout'); ?>

<div class="row" style="padding-top: 10px;">
    <div class="col-md-4"></div>
    <div class="col-md-4 pagination-centered">  
  <?php echo $this->Form->create();?>
  <legend class="pagination-centered"><?= __('Shout it all out !') ?></legend>
  <?php
      echo $this->Form->input('name',array('label'=>'Say:','type'=>'text'));
      echo $this->Form->button(__('Submit'), ['class'=>'btn btn-default']) ;
      echo $this->Form->end();
    ?>
    </div>
    <div class="col-md-4"></div>
</div>

