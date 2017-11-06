<?php $this->assign('title', 'Fighter'); ?>

<?php
 echo $this->Form->create('Upload',array('enctype'=>'multipart/form-data')); ?>

<?= $this->Form->input('avatar_file',array('label'=>'Votre avatar (au format jpg ou png)','type'=>'file')); ?>


<?= $this->Form->button('Ajouter'); ?>
<?= $this->Form->end(); ?>
 