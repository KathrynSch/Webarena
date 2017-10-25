<div class="panel panel-info">
	<div class="panel-heading">Your Guild</div>
	<div class="panel-body">
	  <table class="table">
	  	 <tr>
            <td><?= h($fighterGuild->id) ?></td>
            <td><?= h($fighterGuild->name) ?></td>
            <td><?php foreach($fighters as $fighter):
            	if ( $fighter->guild_id == $fighterGuild->id )
            		echo h($fighter->name); ?>
   					<br>
   				<?php endforeach ?>
   			</td>
        </tr>
      </table>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">Guilds</div>
  	<div class="panel-body">
  		<table class="table">
  			<tr>
  				<th>Id</th>
  				<th>Name</th>
  				<th>Members</th>
  				<th>Join</th>
  			</tr>
<?php foreach ($guilds as $guild): ?>
        <tr>
            <td><?= h($guild->id) ?></td>
            <td><?= h($guild->name) ?></td>
            <td><?php foreach($fighters as $fighter):
            	if ( $fighter->guild_id == $guild->id )
            		echo h($fighter->name); ?>
   					<br>
   				<?php endforeach ?>	
   			</td>
   			<td><?php echo $this->Form->postButton('Join', array('action'=>'joinGuild', $guild->id)); ?></td>
        </tr>
<?php endforeach; ?>
	</table>
</div>


