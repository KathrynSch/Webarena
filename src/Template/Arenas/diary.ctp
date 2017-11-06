<?php $this->assign('title', 'diary');?>

<div class="row">
  <div class="col-md-2"></div>
  <div class="col-md-8">
<div class="panel panel-default">
	<div class="panel-heading">All Events</div>
  	<div class="panel-body">
  		<table class="table">
		  	<?php
		  	foreach ($events as $event) 
		  	{
		        if((abs($activeFighter['coordinate_x']-$event->coordinate_x) + abs($activeFighter['coordinate_y']-$event->coordinate_y)) <= $activeFighter->skill_sight)
		        { 
		  			echo('<tr><td>');
				  	echo($event->date->nice());
				  	echo('</td><td>');
				  	echo($event->name);
				  	echo('</td></tr>');
		  		}
			}
		?>
		</table>
	</div>
</div>
</div>
<div class="col-md-2"></div>
</div>