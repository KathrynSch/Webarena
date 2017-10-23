<?= $this->Form->create('User'); ?>

<?= $this->Form->input('avatar_file',array('label'=>'Votre avatar (au format jpg ou png)','type'=>'file')); ?>


<?= $this->Form->button('Ajouter'); ?>
<?= $this->Form->end(); ?>