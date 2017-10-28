<div class="table-responsive" style="margin-top:20px">
    <table class="table table-bordered table-responsive" style="margin:auto; width:750px; length:500px">
  	<?php for($x=0; $x<10; $x++) {
    	echo('<tr>'); 
    	for($y=0; $y<15; $y++) { ?>
        <td  style="width:50px; height: 50px;">

         <?php    if((abs($activeFighter['coordinate_x']-$x) + abs($activeFighter['coordinate_y']-$y)) <= $activeFighter->skill_sight){
         foreach($tabFighters as $fighter){

              if(($fighter['coordinate_x'] == $x)&&($fighter['coordinate_y']== $y)){
                  echo $this->Html->image('avatars/'.$fighter->id.'.png', array('width' => '40px','alt'=>'fighterAvatar'));
              }
    		}
      echo('</td>');
        }
        
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

	echo $this->Form->postButton('Left', array('action'=>'moveFighter', 'l', $activeFighter['id']));
	echo $this->Form->postButton('Right', array('action'=>'moveFighter', 'r', $activeFighter['id']));
	echo $this->Form->postButton('Down', array('action'=>'moveFighter', 'd', $activeFighter['id']));
	echo $this->Form->postButton('Up', array('action'=>'moveFighter', 'u', $activeFighter['id']));
  echo $this->Form->postButton('Shout', array('action'=>'shout', $activeFighter['id']));

  
  echo $this->Form->postButton('FightR', array('action'=>'fight', 'r', $activeFighter['id']));
  echo $this->Form->postButton('FightL', array('action'=>'fight', 'l', $activeFighter['id']));
  echo $this->Form->postButton('FightU', array('action'=>'fight', 'u', $activeFighter['id']));
  echo $this->Form->postButton('FightD', array('action'=>'fight', 'd', $activeFighter['id']));


?>
    </div>
<?= $this->Html->link(__('Guild options'), ['action' => 'guild' ]) ?>
    <div>
        <div class="panel panel-info">
            <div class="panel-heading"><?= $this->Html->link(__('Messages'), ['action' => 'messages' ]) ?></div>
            <div class="panel-body">
                trop dar ton experience !!
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Write..." aria-describedby="basic-addon2">
                </div>

            </div>
        </div>

    </div>
    <div class="panel panel-warning">
        <div class="panel-heading"><?= $this->Html->link(__('Diary'), ['action' => 'diary', $activeFighter['id'] ]) ?></div>
        <div class="panel-body">
            Machin s'est fait tué par truc truc  
        </div>
    </div>
</div>
<div class="panel panel-success">
    <div class="panel-heading"><?= $this->Html->link(__('Fighter status'), ['controller' => 'Fighters', 'action' => 'view', $activeFighter['player_id'] ]) ?></div>
    <div class="panel-body">
        Level truc truc expereience truc truc 
    </div>
</div>
</div>
</div>