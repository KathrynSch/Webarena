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


  <div class="panel-heading">All messsages</div>
  <table class="table">
  	<tr>
  		<th>Date</th>
  		<th>From</th>
      <th>To</th>
  		<th>Title</th>
  		<th>Message</th>
  	</tr>
  		<?php foreach($messages as $message): ?>
  		<tr>
  			<td><?= h($message->date->nice()) ?></td>
  			<td><?php 
          foreach ($fighters as $fighter) {
            if($message->fighter_id_from == $fighter->id){
              echo($fighter->name);
            }
          }
        ?></td>
        <td><?php 
          foreach ($fighters as $fighter) {
            if($message->fighter_id == $fighter->id){
              echo($fighter->name);
            }
          }
        ?></td>
  			<td><?= h($message->title) ?></td>
  			<td><?= h($message->message) ?></td>
  		</tr> 
  		<?php endforeach; ?>
  </table>
</div>

<div class="panel panel-default">
  <div class="panel-heading">Send message</div>
  <?php echo $this->Form->create(); ?>
      <span class="input-group-addon" id="sizing-addon1">@</span>
      <?php 
      echo $this->Form->input('to', ['type'=>'select', 'options'=>$fightersNames, 'empty'=>'Choose a fighter']);
      echo $this->Form->input('title',array('label'=>'title','type'=>'text'));
      echo $this->Form->input('message',array('label'=>'message','type'=>'text'));
      echo $this->Form->submit('Send', array('class' => 'button')) ;
      echo $this->Form->end();
    ?>
</div>