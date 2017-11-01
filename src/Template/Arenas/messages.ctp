<div class="row content">

  <div class="col-md-2">
      <div class="list-group" style="padding-top: 10px;">
        <?php 
          foreach ($fighters as $fighter) {
            if($fighter->id != $activeFighter->id){
              echo $this->Html->link($fighter->name, ['action'=>'chat', $fighter->id], ['class'=>'list-group-item']);
            }
          }
        ?>
      </div>
  </div>


  <div class="col-md-6">
  <div class="panel panel-default">
  <div class="panel-heading">All Messages</div>
    <div class="panel-body">
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
</div>
</div>

<div class="col-md-4 pagination-centered">
<div class="panel panel-default">
  <div class="panel-heading">Send message</div>
  <?php echo $this->Form->create(); ?>
      <?php 
      echo $this->Form->input('to', ['type'=>'select', 'options'=>$fightersNames, 'empty'=>'Choose a fighter'], ['style'=>'font-size: 8px;']);
      echo $this->Form->input('title',array('label'=>'title','type'=>'text'));
      echo $this->Form->input('message',array('label'=>'message','type'=>'text'));
      echo $this->Form->button(__('Send'),['class'=>'btn btn-default']);
      echo $this->Form->end();
    ?>
</div>
</div>

</div>
