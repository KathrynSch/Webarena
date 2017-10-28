<?php $this->assign('title', 'diary');?>

<div class="panel-heading">All events</div>
  <table class="table">
  	<?php foreach($events as $event):
  	echo('<tr><td>');
  	echo($event->date->nice());
  	echo('</td><td>');
  	echo($event->name);
  	echo('</td></tr>');
  	endforeach; ?>
  </table>
