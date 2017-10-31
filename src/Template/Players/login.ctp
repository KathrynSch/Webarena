

	<div class="panel pagination-centered">
		<h2>Login</h2>
			<?= $this->Form->create() ; ?>
				<?= $this->Form->input('email') ; ?>
				<?= $this->Form->input('password', array('type' => 'password')) ; ?>
			<?= $this->Form->submit('Login', ['class' => 'btn btn-default']) ; ?>
                        

		<?= $this->Form->end() ; ?>

          <?= $this->Form->postButton('Forget passeword ?',array('action'=>'forgot_password'), ['class' => 'btn btn-default']);?>
	</div>


<!-- <div class="row">
  <div class="col-md-6">.col-md-4</div>
  <div class="col-md-6">.col-md-4</div>
</div> -->