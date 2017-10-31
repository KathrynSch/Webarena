<div class="row content">

    <div class="col-md-2">
      PANELS
    <!--   <?= $this->Html->link(__('Guild options'), ['action' => 'guild' ]) ?>
    
        <div class="panel panel-info">
            <div class="panel-heading"><?= $this->Html->link(__('Messages'), ['action' => 'messages' ]) ?></div>
            <div class="panel-body">
                trop dar ton experience !!
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Write..." aria-describedby="basic-addon2">
                </div>
            </div>
        </div>

      <div class="panel panel-warning">
          <div class="panel-heading"><?= $this->Html->link(__('Diary'), ['action' => 'diary', $activeFighter['id'] ]) ?></div>
          <div class="panel-body">
              Machin s'est fait tué par truc truc  
          </div>
      </div>

      <div class="panel panel-success">
          <div class="panel-heading"><?= $this->Html->link(__('Fighter status'), ['controller' => 'Fighters', 'action' => 'view', $activeFighter['player_id'] ]) ?></div>
          <div class="panel-body">
              Level truc truc expereience truc truc 
          </div>
      </div> -->
    </div>
  
  <div class="col-md-8">
  <table class=" table table-bordered" >
    	<?php 
      for($y=0; $y<10; $y++) //rows
      {
        echo('<tr>'); 
        for($x=0; $x<15; $x++) //columns 
        {   // SI DANS CHAMPS DE VISION
          /*if((abs($activeFighter['coordinate_x']-$x) + abs($activeFighter['coordinate_y']-$y)) <= $activeFighter->skill_sight)
          {*/ ?>
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
                        echo('Brise suspecte');                  
                      }
                    if ( (($monster->coordinate_x == $x) && ($monster->coordinate_y == $y+1)) // down
                        || (($monster->coordinate_x == $x) && ($monster->coordinate_y == $y-1)) //up
                        || (($monster->coordinate_x == $x+1) && ($monster->coordinate_y == $y)) // right
                        || (($monster->coordinate_x == $x-1) && ($monster->coordinate_y == $y)) //left
                      )
                    {
                      echo('Puanteur');
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
                  echo('P');
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
              if( ($monster->coordinate_x == $x)&&($monster->coordinate_y == $y) )
              {
                //dd($decor);
                echo('W');
              }

              echo('</td>');
            /*}
            else  // SI PAS DANS CHAMPS DE VISION
            { ?>
              <td class="bg-primary" style="width:50px; height: 50px;">
              <?php 
            }*/
          }
          echo('</tr>'); 
        } ?>
  </table>
</div>

  <div class="col-md-2">
   
        MOVE
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

        FIGHT
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
        SHOUT
        <div class="row">
          <div class="col-md-4"></div>
          <div class="col-md-4">
            <?php echo $this->Form->postButton('<span style="color: green;" class="glyphicon glyphicon-volume-up"></span>', array('action'=>'shout', $activeFighter['id']), ['class' => 'btn btn-default']); ?>
          </div>
          <div class="col-md-4"></div>
        </div>

        SURROUNDINGS
        <div class="row">
          <div class="col-md-4"></div>
          <div class="col-md-4">
            <?php echo $this->Form->postButton('<span style="color: orange;" class="glyphicon glyphicon-refresh"></span>', array('action'=>'generateSurroundings'), ['class' => 'btn btn-default']); ?>
          </div>
          <div class="col-md-4"></div>
        </div>

          

            
    

<!-- 
    echo $this->Form->postButton('Shout', array('action'=>'shout', $activeFighter['id']));
    echo $this->Form->postButton('Change Surroundings', c);

    
  


        ?> -->
    </div>

</div>

