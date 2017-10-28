 <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav nav-pills nav-stacked">
        <?php 
          foreach ($fighters as $fighter) {
              echo('<li role="presentation">');
              echo $this->Html->link($fighter->name, ['action'=>'chat', $fighter->id]);
              echo('</li>');
          }
        ?>
      </ul>
  </div>


  <div class="panel-heading">All messsages</div>
  <table class="table">
  	<tr>
  		<th>Date</th>
  		<th>Title</th>
  		<th>Message</th>
  	</tr>
  		<?php foreach($messages as $message): 
          if($message->fighter_id == $activeFighter->id && $message->fighter_id_from == $fighter->id)
          { // message envoyé par contact à activeFigther
        ?>
  		<tr class="table-light">
  			<td><?= h($message->date) ?></td>
  			<td><?= h($message->title) ?></td>
  			<td><?= h($message->message) ?></td>
  		</tr> 
      <?php } else {
      if($message->fighter_id == $fighter->id && $message->fighter_id_from == $activeFighter->id)
      { // message envoyé par activeFighter à contact
        ?>
        <tr class="table-info">
        <td><?= h($message->date) ?></td>
        <td><?= h($message->title) ?></td>
        <td><?= h($message->message) ?></td>
      </tr>
      <?php } }
      endforeach; ?>
  </table>
</div>
  <?php echo $this->Form->create(); ?>
      <span class="input-group-addon" id="sizing-addon1">@</span>
      <?php 
      echo $this->Form->input('title',array('label'=>'title','type'=>'text'));
      echo $this->Form->input('message',array('label'=>'message','type'=>'text'));
      echo $this->Form->submit('Send', array('class' => 'button')) ;
      echo $this->Form->end();
    ?>
</div>