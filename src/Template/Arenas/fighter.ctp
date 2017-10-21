Bienvenue dans fighter.
Photo fighter
caractéristiques
jouer
ajouter fighter
<?php 
$this->assign('title', 'fighter');
pr($fighter);


?>
<form method="post" action="webarena/fighter/addFighterPicture/"+ $fighter["id"]>
	<input type="file" name="picture">
	<button type="submit">Save</button>
</form>
