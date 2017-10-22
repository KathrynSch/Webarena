Bienvenue dans fighter.
Photo fighter
caractéristiques
jouer
ajouter fighter
<?php 
$this->assign('title', 'fighter');
pr($fighter);


?>
<form method="post" action="./addFighterPicture/<?php echo $fighter[0]['id'] ?>" enctype="multipart/form-data">
	<input type="file" name="picture">
	<input type="submit" name="submit">
</form>
