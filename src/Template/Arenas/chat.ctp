 <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav nav-pills nav-stacked">
        <?php 
          foreach ($fighters as $fighter) {
            if($fighter->id != $activeFighter->id){
              echo('<li role="presentation">');
              echo $this->Html->link($fighter->name, ['action'=>'chat', $fighter->id]);
              echo('</li>');
            }
          }
        ?>
      </ul>
  </div>

  <div class="panel-heading"><?= h($chatFighter->name);?></div>
  <table class="table">
  	<tr>
  		<th>Date</th>
      <th>From</th>
      <th>To</th>
  		<th>Title</th>
  		<th>Message</th>
  	</tr>
  		<?php 
      foreach($messages as $message): 
        if($message->fighter_id_from == $chatFighter->id)
          { // message  reçu
        ?>
  		<tr>
  			<td><?= h($message->date) ?></td>
        <td><?= h($message->fighter_id_from) ?></td>
        <td><?= h($message->fighter_id) ?></td>
  			<td><?= h($message->title) ?></td>
  			<td><?= h($message->message) ?></td>
  		</tr> 
      <?php }
      if($message->fighter_id == $chatFighter->id)
      { // message envoyé 
        ?>
        <tr style="background-color: #607D8B;">
        <td><?= h($message->date) ?></td>
        <td><?= h($message->fighter_id_from) ?></td>
        <td><?= h($message->fighter_id) ?></td>
        <td><?= h($message->title) ?></td>
        <td><?= h($message->message) ?></td>
      </tr>
      <?php } 
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