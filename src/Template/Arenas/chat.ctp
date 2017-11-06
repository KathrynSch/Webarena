<?php $this->assign('title', 'Chat'); ?>

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
  <div class="panel-heading">Chat with <?= h($chatFighter->name)?></div>
    <div class="panel-body">
  <table class="table">
  	<tr>
  		<th>Date</th>
  		<th>Title</th>
  		<th>Message</th>
  	</tr>
  		<?php 
      foreach($messages as $message): 
        if($message->fighter_id_from == $chatFighter->id)
          { // message  reçu
        ?>
  		<tr>
  			<td><?= h($message->date->nice()) ?></td>
  			<td><?= h($message->title) ?></td>
  			<td><?= h($message->message) ?></td>
  		</tr> 
      <?php }
      if($message->fighter_id == $chatFighter->id)
      { // message envoyé 
        ?>
        <tr style="background-color: #B2DFDB;">
        <td><?= h($message->date->nice()) ?></td>
        <td><?= h($message->title) ?></td>
        <td><?= h($message->message) ?></td>
      </tr>
      <?php } 
      endforeach; ?>
  </table>
</div>
</div>
</div>

<div class="col-md-4 pagination-centered">
<div class="panel panel-default">
  <div class="panel-heading">Send message</div>
  <?php echo $this->Form->create(); ?>
      <?php 
      echo $this->Form->input('title',array('label'=>'title','type'=>'text'));
      echo $this->Form->input('message',array('label'=>'message','type'=>'text'));
      echo $this->Form->button(__('Send'),['class'=>'btn btn-default']);      
      echo $this->Form->end();
    ?>
</div>
</div>

</div>
