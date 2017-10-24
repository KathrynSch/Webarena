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
<div class="btn-toolbar" role="toolbar">
<?php

	echo $this->Form->postButton('Left', array('action'=>'moveFighter', 'l', $fighterId));
	echo $this->Form->postButton('Right', array('action'=>'moveFighter', 'r', $fighterId));
	echo $this->Form->postButton('Down', array('action'=>'moveFighter', 'd', $fighterId));
	echo $this->Form->postButton('Up', array('action'=>'moveFighter', 'u', $fighterId));
?>
</div>
