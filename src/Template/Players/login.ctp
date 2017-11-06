<?php $this->assign('title', 'Login'); ?>

<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4">
	<div class="panel pagination-centered">
		<h2>Login</h2>
			<?= $this->Form->create() ; ?>
				<?= $this->Form->input('email') ; ?>
				<?= $this->Form->input('password', array('type' => 'password')) ; ?>
			<?= $this->Form->button(__('Login'), ['class'=>'btn btn-default']) ?>
		<?= $this->Form->end() ; ?>
	</div>
</div>
<div class="col-md-4"></div>
</div>
<div class="row">
	<div class="col-md-5"></div>
	<div class="col-md-2 text-center">
	<?= $this->Html->link(__('Forgot Password ?'), ['action' => 'forgotpassword'], ['class'=>'list-group-item']) ?>
	</div>
	<div class="col-md-5"></div>
</div>


