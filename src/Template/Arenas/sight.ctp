<div class="table-responsive">
  <table class="table table-bordered">
  	<?php for($y=0; $y<15; $y++) {
    	echo('<tr>'); 
    	for($x=0; $x<10; $x++) {
         echo ('<td>');
        foreach($tabFighters as $fighter){

              if(($fighter['coordinate_x'] == $x)&&($fighter['coordinate_y']== $y)){
                  echo ('FF');
              }
    		}
      echo('</td>');
      	}
    echo('</tr>'); 
    }?>
  </table>
 	<!-- <div class="btn-group">
	  <button class="btn btn-default"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></button>
	  <button class="btn btn-default"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></button>
	  <button class="btn btn-default"><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span></button>
	  <button class="btn btn-default"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span></button>
	</div> -->
<div class="btn-group" role="group">
<?php

	echo $this->Form->postButton('Left', array('action'=>'moveFighter', 'l', $fighterId));
	echo $this->Form->postButton('Right', array('action'=>'moveFighter', 'r', $fighterId));
	echo $this->Form->postButton('Down', array('action'=>'moveFighter', 'd', $fighterId));
	echo $this->Form->postButton('Up', array('action'=>'moveFighter', 'u', $fighterId));
  echo $this->Form->postButton('Shout', array('action'=>'shout'));
  echo $this->Form->postButton('Fight', array('action'=>'fights'));
?>
</div>
<div>
  <div class="panel panel-info">
    <div class="panel-heading"><?= $this->Html->link(__('Messages from your guild'), ['action' => 'messages']) ?></div>
    <div class="panel-body">
      trop dar ton experience !!
      <div class="input-group">
          <input type="text" class="form-control" placeholder="Write..." aria-describedby="basic-addon2">
      </div>
      <?= $this->Html->link(__('Manage guilds'), ['action' => 'guilds']) ?>
    </div>
  </div>

  </div>
   <div class="panel panel-warning">
    <div class="panel-heading"><?= $this->Html->link(__('Diary'), ['action' => 'diary']) ?></div>
      <div class="panel-body">
        Machin s'est fait tué par truc truc  
      </div>
    </div>
  </div>
  <div class="panel panel-success">
    <div class="panel-heading"><?= $this->Html->link(__('Fighter status'), ['controller' => 'Fighters', 'action' => 'view', $fighter['player_id']]) ?></div>
      <div class="panel-body">
        Level truc truc expereience truc truc 
      </div>
    </div>
  </div>
</div>
