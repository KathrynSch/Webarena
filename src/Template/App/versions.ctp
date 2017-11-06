<?php $this->assign('title', 'Versionning'); ?>

<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">

<?php
$myfile = fopen('..'.DS.'versions.log', "r") or die("Unable to open file!");
// Output one line until end-of-file
while(!feof($myfile)) {
  echo fgets($myfile) . "<br>";
}
fclose($myfile);
?>
</div>
<div class="col-md-2"></div>
</div>