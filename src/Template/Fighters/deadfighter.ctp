
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Fighter'), ['action' => 'edit', $fighter->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Fighter'), ['action' => 'delete', $fighter->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fighter->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Fighters'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fighter'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Play'), ['controller' => 'Arenas', 'action' => 'sight']) ?> </li>
    </ul>
</nav>
<div class="fighters view large-9 medium-8 columns content">
    <h3><?= h($fighter->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($fighter->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Level') ?></th>
            <td><?= $this->Number->format($fighter->level) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Xp') ?></th>
            <td><?= $this->Number->format($fighter->xp) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Skill Sight') ?></th>
            <td><?= $this->Number->format($fighter->skill_sight) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Skill Strength') ?></th>
            <td><?= $this->Number->format($fighter->skill_strength) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Skill Health') ?></th>
            <td><?= $this->Number->format($fighter->skill_health) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Current Health') ?></th>
            <td><?= $this->Number->format($fighter->current_health) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Guild') ?></th>
            <td><?php if($guild) echo($guild->name);
                    else echo('No guild'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Image') ?></h4>

        <?php 
        
        if (file_exists(WWW_ROOT . 'img\avatars'.DS.$fighter->id.'.jpg')){
            echo $this->Html->image('avatars/'.$fighter->id.'.jpg', array('max-height' => '200px','alt'=>'fighterAvatar'));
        }
        if (file_exists(WWW_ROOT . 'img\avatars'.DS.$fighter->id.'.jpeg')){
            echo $this->Html->image('avatars/'.$fighter->id.'.jpeg', array('max-height' => '200px','alt'=>'fighterAvatar'));
        }
        if (file_exists(WWW_ROOT . 'img\avatars'.DS.$fighter->id.'.png')){

            echo $this->Html->image('avatars/'.$fighter->id.'.png', array('max-height' => '200px','alt'=>'fighterAvatar'));
        }
        if (file_exists(WWW_ROOT . 'img\avatars'.DS.$fighter->id.'.gif')){
            echo $this->Html->image('avatars/'.$fighter->id.'.gif', array('max-height' => '200px','alt'=>'fighterAvatar'));
        }
         ?>
    </div>
    <span>Your fighter got killed !</span>
    <?= $this->Html->link(__('Create new fighter'), ['controller' => 'Fighters', 'action' => 'add', $fighter->player_id]) ?>
</div>
