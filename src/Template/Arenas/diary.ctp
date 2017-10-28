<?php $this->assign('title', 'diary');?>

<div class="panel-heading">All events</div>
  <table class="table">
  	<?php
  	for($x=0; $x<10; $x++) {
    	for($y=0; $y<15; $y++) { 
		  	if( (abs($activeFighter['coordinate_x']-$x) + abs($activeFighter['coordinate_y']-$y)) <= $activeFighter->skill_sight)
		  	{
		  		foreach($events as $event)
		  		{
              		if(($event->coordinate_x == $x)&&($event->coordinate_y== $y))
              		{
              			echo('<tr><td>');
					  	echo($event->date->nice());
					  	echo('</td><td>');
					  	echo($event->name);
					  	echo('</td></tr>');
              		}
		  		}
		  	}
		}
	} ?> 
  </table>
