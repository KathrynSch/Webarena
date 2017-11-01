<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fighter[]|\Cake\Collection\CollectionInterface $fighters
 */
?>
<div class="row">
<div class="col-md-2">
            <div class="list-group" style="padding-top: 10px;">
                <?= $this->Html->link(__('My Fighter'), ['controller'=>'Fighters','action' => 'view'], ['class'=>'list-group-item']) ?>
              <?= $this->Html->link(__('Guilds'), ['controller'=>'Arenas','action' => 'guild'], ['class'=>'list-group-item']) ?>
              <?= $this->Html->link(__('Enter Arena'), ['controller' => 'Arenas', 'action' => 'sight'], ['class'=>'list-group-item']) ?>
              
            </div>
        </div>
<div class="col-md-8">
    <h3 class="pagination-centered"><?= __('Hall of Fame') ?></h3>
    <table class="table">
        <thead>
            <tr>
                
                <th>Name</th>
                <th>Level</th>
                <th>XP</th>
                <th>Sight</th>
                <th>Stength</th>
                <th>Health</th>
                <th>Guild</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($fighters as $fighter): ?>
            <tr>
                
                <td><?= h($fighter->name) ?></td>
                <td><?= $this->Number->format($fighter->level) ?></td>
                <td><?= $this->Number->format($fighter->xp) ?></td>
                <td><?= $this->Number->format($fighter->skill_sight) ?></td>
                <td><?= $this->Number->format($fighter->skill_strength) ?></td>
                <td><?= $this->Number->format($fighter->current_health) ?></td>
                <td>
                <?php foreach($guilds as $guild) 
                { if($fighter->guild_id == $guild->id)
                    {
                        echo($guild->name);
                    }} ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    </div>
    <div class="col-md-2"></div>
</div>
