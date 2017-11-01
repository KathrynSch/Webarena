<div class="row">
  <div class="col-md-2"></div>
  <div class="col-md-8">
      <div class="panel panel-info">
        <div class="panel-heading">Your Guild</div>
              <div class="panel-body">
        <div class="col-md-10">
            	  <table class="table">
            	  	<tr>
              				<th>Id</th>
              				<th>Name</th>
              				<th>Members</th>
              			</tr>
            	  	 <tr>
                    <?php if ($fighterGuild <> null){ ?>
                        <td><?= h($fighterGuild->id) ?></td>
                        <td><?= h($fighterGuild->name) ?></td>
                        <td><?php foreach($fighters as $fighter):
                        	if ( $fighter->guild_id == $fighterGuild->id )
                        		echo h($fighter->name); ?>
               					<br>
               				<?php endforeach ?>
               			</td>
                    <?php } ?>
                    </tr>
                    
                  </table>
            	</div>
              <div class="col-md-2" style="padding-top: 15px;"><?= $this->Form->postButton('Create Guild', array('action'=>'addGuild'),['class'=>'btn btn-default']); ?></div>

        </div>

            
        </div>
        
  </div>
<div class="col-md-2"></div>
</div>

<div class="row">
  <div class="col-md-2"></div>
  <div class="col-md-8">
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
   			<td>
   				<?php if(($fighterGuild <> null) && ($guild->id == $fighterGuild->id)) echo ('Your Guild'); 
   					else echo $this->Form->postButton('Join', array('action'=>'joinGuild', $guild->id), ['class'=>'btn btn-default']); ?>
   			</td>
        </tr>
<?php endforeach; ?>
	</table>
</div>
</div>
<div class="col-md-2"></div>
</div>
