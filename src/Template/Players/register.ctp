<?php $this->assign('title', 'Register'); ?>

<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4">
	<div class="panel pagination-centered">
		<h2>Please Register</h2>
		<?= $this->Form->create($player) ; ?>
		<div class= "form-group">
			<?= $this->Form->input('email' ) ; ?>
			<?= $this->Form->input('password', array('type' => 'password') ); ?>
			<?= $this->Form->button(__('Register'), ['class'=>'btn btn-default']) ?>

		<?= $this->Form->end() ; ?>
		</div>
</div>
</div>
<div class="col-md-4"></div>