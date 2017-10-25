<div class="panel panel-default">

  <div class="panel-heading">All messsages</div>
  <table class="table">
  	<tr>
  		<th>Date</th>
  		<th>Name</th>
  		<th>Title</th>
  		<th>Message</th>
  	</tr>
  		<?php foreach($messages as $message): ?>
  		<tr>
  			<td><?= h($message->date) ?></td>
  			<?php foreach ($fighters as $fighter) :
  				if($message->fighter_id_from == $fighter->id) ?>
  					<td><?= h($fighter->name) ?></td>
  			<?php endforeach ; ?>
  			<td><?= h($message->title) ?></td>
  			<td><?= h($message->message) ?></td>
  		</tr> 
  		<?php endforeach; ?>
  </table>
</div>