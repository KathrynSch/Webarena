<div class="panel panel-default">
  <div class="panel-heading">Shout it all out !</div>
  <?php echo $this->Form->create();
      echo $this->Form->input('name',array('label'=>'Say:','type'=>'text'));
      echo $this->Form->submit('Send', array('class' => 'button')) ;
      echo $this->Form->end();
    ?>
</div>