
	<div class="panel pagination-centered">
		<h2>Please Register</h2>
		<?= $this->Form->create($player) ; ?>
		<div class= "form-group">
			<?= $this->Form->input('email' ) ; ?>
			<?= $this->Form->input('password', array('type' => 'password') ); ?>
			<?= $this->Form->submit('Register', array('class' => 'btn btn-default')) ; ?>

		<?= $this->Form->end() ; ?>
		</div>
	</div>
