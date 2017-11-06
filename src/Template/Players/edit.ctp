<?php $this->assign('title', 'Account'); ?>


<div class="row" style="padding-top: 10px;">
    <div class="col-md-4"></div>
    <div class="col-md-4 pagination-centered"> 
    <?= $this->Form->create($player) ?>

        <legend><?= __('Change your account settings') ?></legend>
        <?php
            echo $this->Form->control('email');
            echo $this->Form->control('password');
        ?>

    <?= $this->Form->button(__('Submit'),['class'=>'btn btn-default']) ?>
    <?= $this->Form->end() ?>
</div>
<div class="col-md-4"></div>
</div>

