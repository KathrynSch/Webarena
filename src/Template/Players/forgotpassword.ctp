<?php $this->assign('title', 'Forgot Password'); ?>

<?php if(!$showPassword){ ?>

<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4">
	<div class="panel pagination-centered">
		<h2>Forgot password</h2>
			<?= $this->Form->create() ; ?>
				<?= $this->Form->input('email') ; ?>
			<?= $this->Form->button(__('Get new password'), ['class'=>'btn btn-default']) ?>
		<?= $this->Form->end() ; ?>
	</div>
</div>
<div class="col-md-4"></div>
</div>
<?php } ?>
<?php if($showPassword){ ?>
<div class="row" style="margin-top: 10px;">
	<div class="col-md-4"></div>
	<div class="col-md-4">
		<div class="alert alert-info">
  			<strong>Your new password : </strong> <?= h($password) ?>
		</div>
		<div class="alert alert-warning">
  			<strong>Warning! </strong> Change immediately your password. Go to "Manage account" once you're logged in.
		</div>
		<?= $this->Html->link(__('OK, login now'), ['action' => 'login'], ['class'=>'list-group-item']) ?>
	</div>
	<div class="col-md-4"></div>
</div>
<?php } ?>
