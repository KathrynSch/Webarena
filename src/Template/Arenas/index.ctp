<?php //$this->assign('title', 'index');

echo $this->Form->create($contact);
echo $this->Form->control('name');
echo $this->Form->control('email');
echo $this->Form->control('body');
echo $this->Form->input('upload', array('type'=>'file'));
echo $this->Form->button('Submit');
echo $this->Form->end();