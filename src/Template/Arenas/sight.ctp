<div class="row content">

    <div class="col-md-2">
      
       
      <div class="panel panel-success">
          <div class="panel-heading"><?= $this->Html->link(__($activeFighter->name), ['controller' => 'Fighters', 'action' => 'view', $activeFighter['player_id'] ]) ?></div>
          <div class="panel-body" style="padding-left:0; padding-bottom: 0;">
             <ul class="list-group">
                <li class="list-group-item">Level <span class="badge"><?= h($activeFighter['level'])?></span></li>
                <li class="list-group-item">XP <span class="badge"><?= h($activeFighter['xp'])?></span></li> 
                <li class="list-group-item">Sight <span class="badge"><?= h($activeFighter['skill_sight'])?></span></li>
                <li class="list-group-item">Strength <span class="badge"><?= h($activeFighter['skill_strength'])?></span></li>
                <li class="list-group-item">Health <span class="badge"><?= h($activeFighter['current_health'])?>/<?= h($activeFighter['skill_health'])?></span></li> 
              </ul>
                            
          </div>
      </div>
        

      <div class="panel panel-warning">
          <div class="panel-heading"><?= $this->Html->link(__('Latest Events'), ['action' => 'diary', $activeFighter['id'] ]) ?></div>
          <div class="panel-body" style="font-size: 9px;">
            <?php 
                foreach ($events as $event) {
                    if((abs($activeFighter['coordinate_x']-$event->coordinate_x) + abs($activeFighter['coordinate_y']-$event->coordinate_y)) <= $activeFighter->skill_sight)
                    { 
                      echo('<span style="color: green ;" class="glyphicon glyphicon-bullhorn"></span>');
                      echo(' ');
                      echo($event->name);
                      echo('<br>');
                    }
                }
            ?>
          </div>
      </div>

      
    </div>
  
  <div class="col-md-8">
  <table class=" table table-bordered" >
    	<?php 
      for($y=0; $y<10; $y++) //rows
      {
        echo('<tr>'); 
        for($x=0; $x<15; $x++) //columns 
        {   // SI DANS CHAMPS DE VISION
          if((abs($activeFighter['coordinate_x']-$x) + abs($activeFighter['coordinate_y']-$y)) <= $activeFighter->skill_sight)
          { ?>
            <td id="arenaCell">
              <?php
              //affichage fighters
            foreach($tabFighters as $fighter)
            {
              if(($fighter['coordinate_x'] == $x)&&($fighter['coordinate_y']== $y))
              {
                echo $this->Html->image('avatars/'.$fighter->id.'.png', array('width' => '40px','alt'=>'fighterAvatar'));

                if($fighter->id == $activeFighter->id)
                {
                  $istrap=0;
                    foreach ($traps as $trap) 
                    { //if next to trap
                      if ( (($trap->coordinate_x == $x)&&($trap->coordinate_y == $y+1)) // down
                        || (($trap->coordinate_x == $x)&&($trap->coordinate_y == $y-1)) //up
                        || (($trap->coordinate_x == $x+1)&&($trap->coordinate_y == $y)) // right
                        || (($trap->coordinate_x == $x-1)&&($trap->coordinate_y == $y)) //left
                      )
                      {
                        $istrap++;
                      }
                    }
                    if($istrap != 0)
                      {
                        echo('<br>Brise suspecte');                  
                      }
                      if($monster)
                      {
                        if ( (($monster->coordinate_x == $x) && ($monster->coordinate_y == $y+1)) // down
                        || (($monster->coordinate_x == $x) && ($monster->coordinate_y == $y-1)) //up
                        || (($monster->coordinate_x == $x+1) && ($monster->coordinate_y == $y)) // right
                        || (($monster->coordinate_x == $x-1) && ($monster->coordinate_y == $y)) //left
                      )
                    {
                      echo('<br>Puanteur');
                    }
                      }
                    
                  }
                }

    		      }
                //affichage décor
              foreach($pillars as $pillar)
              {
                //dd($pillars->toArray());
                //affichage colonnes
                if( ($pillar->coordinate_x == $x)&&($pillar->coordinate_y == $y) )
                {
                  //dd($decor);
                  echo $this->Html->image('wall.jpg', array('alt'=>'wall') );
                }
              }
              foreach($traps as $trap)
              {
                //affichage colonnes
                if( ($trap->coordinate_x == $x)&&($trap->coordinate_y == $y) )
                {
                  //dd($decor);
                  echo('T');
                }
              }
              if($monster){
                if( ($monster->coordinate_x == $x)&&($monster->coordinate_y == $y) )
              {
                //dd($decor);
                echo('W');
              }
              }
              

              echo('</td>');
            }
            else  // SI PAS DANS CHAMPS DE VISION
            { ?>
              <td style="width:50px; height: 50px; background-color: #80CBC4">
              <?php 
            }
          }
          echo('</tr>'); 
        } ?>
  </table>
</div>


  <div class="col-md-2">
   <?php if($activeFighter->current_health != 0)
      { ?>
        
        <div class="panel panel-info" style="padding: 0;">
          <div class="panel-heading">Move</div>
          <div class="panel-body">
            <div class="row"> <!-- UP -->
          <div class="col-md-4"></div>
          <div class="col-md-4">
            <?php echo $this->Form->postButton('<span style="color: blue;" class="glyphicon glyphicon-arrow-up"></span>', array('action'=>'moveFighter', 'u', $activeFighter['id']), ['class' => 'btn btn-default']); ?>
          </div>
          <div class="col-md-4"></div>
        </div>
        <div class="row"> <!-- LEFT RIGHT -->
          <div class="col-md-4">
            <?php echo $this->Form->postButton('<span style="color: blue;" class="glyphicon glyphicon-arrow-left"></span>', array('action'=>'moveFighter', 'l', $activeFighter['id']), ['class' => 'btn btn-default']);?>
          </div>
          <div class="col-md-4"></div>
          <div class="col-md-4">
            <?php echo $this->Form->postButton('<span style="color: blue;" class="glyphicon glyphicon-arrow-right"></span>', array('action'=>'moveFighter', 'r', $activeFighter['id']), ['class' => 'btn btn-default']); ?>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="col-md-4">
            <?php echo $this->Form->postButton('<span style="color: blue;" class="glyphicon glyphicon-arrow-down"></span>', array('action'=>'moveFighter', 'd', $activeFighter['id']), ['class' => 'btn btn-default']); ?>
          </div>
          <div class="col-md-4"></div>
        </div>
          </div>
        </div>
        

        <div class="panel panel-info " style="padding: 0;">
          <div class="panel-heading">Fight</div>
          <div class="panel-body">
        <div class="row"> <!-- UP -->
          <div class="col-md-4"></div>
          <div class="col-md-4">
            <?php echo $this->Form->postButton('<span style="color: red;" class="glyphicon glyphicon-arrow-up"></span>', array('action'=>'fight', 'u', $activeFighter['id']), ['class' => 'btn btn-default']); ?>
          </div>
          <div class="col-md-4"></div>
        </div>
        <div class="row"> <!-- LEFT RIGHT -->
          <div class="col-md-4">
            <?php echo $this->Form->postButton('<span style="color: red;" class="glyphicon glyphicon-arrow-left"></span>', array('action'=>'fight', 'l', $activeFighter['id']), ['class' => 'btn btn-default']);?>
          </div>
          <div class="col-md-4"></div>
          <div class="col-md-4">
            <?php echo $this->Form->postButton('<span style="color: red;" class="glyphicon glyphicon-arrow-right"></span>', array('action'=>'fight', 'r', $activeFighter['id']), ['class' => 'btn btn-default']); ?>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="col-md-4">
            <?php echo $this->Form->postButton('<span style="color: red;" class="glyphicon glyphicon-arrow-down"></span>', array('action'=>'fight', 'd', $activeFighter['id']), ['class' => 'btn btn-default']); ?>
          </div>
          <div class="col-md-4"></div>
        </div>
      </div>
    </div>
        <div class="panel panel-info" style="padding: 0;">
          
          <div class="panel-body">
        <div class="row">
          <div class="col-md-6 pagination-centered">
            <?php echo $this->Form->postButton('<span style="color: green;" class="glyphicon glyphicon-volume-up"></span>', array('action'=>'shout', $activeFighter['id']), ['class' => 'btn btn-default']); ?>
          </div>
          <div class="col-md-6 pagination-centered">
            <?php echo $this->Form->postButton('<span style="color: orange;" class="glyphicon glyphicon-tower"></span>', array('action'=>'generateSurroundings'), ['class' => 'btn btn-default']); ?>
          </div>
        </div>
      </div>
    </div>
    
    <?php }
      else
    { ?>
        <div class="alert alert-danger">
          <strong>You have just died!</strong> You have to start with a new fighter
        </div>
    <?php } ?>
    
    </div>


</div>

