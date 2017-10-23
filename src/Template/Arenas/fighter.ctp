Bienvenue dans fighter.
Photo fighter
caractéristiques
jouer
ajouter fighter
<?php 
$this->assign('title', 'fighter');
pr($fighter);

echo $this->Form->create(null, ['url' => ['action' => 'addFighterPicture' ]]);
echo $this->Form->control('picture', ['type' => 'file']);
echo $this->Form->submit('Click here');
echo $this->Form->end();


?>
<!-- <form method="post" action="./addFighterPicture/<?php echo $fighter['id'] ?>">
	<input type="file" name="picture">
	<input type="submit" name="submit">
</form> -->
