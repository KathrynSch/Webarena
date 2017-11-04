    <div class="row content">

        <div class="col-md-2">
            <div class="list-group" style="padding-top: 10px;">
              <?= $this->Html->link(__('Hall of Fame'), ['action' => 'index'], ['class'=>'list-group-item']) ?>
              <?= $this->Html->link(__('Guilds'), ['controller'=>'Arenas','action' => 'guild'], ['class'=>'list-group-item']) ?>
              <?php if($fighter->current_health ==0) { ?>
              <?= $this->Html->link(__('New Fighter'), ['action' => 'add'], ['class'=>'list-group-item']) ?>
              <?php } ?>
              <?php if($fighter) { ?>
              <?= $this->Html->link(__('Edit My Fighter'), ['action' => 'edit'], ['class'=>'list-group-item']) ?>
              <?= $this->Html->link(__('Enter Arena'), ['controller' => 'Arenas', 'action' => 'sight'], ['class'=>'list-group-item']) ?>
              <?php } ?>
            </div>
        </div>

      
    <div class="col-md-10 ">
        <div class="panel panel-default">
            <div class="panel-heading">  <h4><?= h($fighter->name) ?></h4></div>
            <div class="panel-body">
                <div class="col-md-3 ">

                        <?php if (file_exists(WWW_ROOT . 'img'.DS.'avatars'.DS.$fighter->id.'.png'))
                        {
                            echo $this->Html->image('avatars/'.$fighter->id.'.png', array('width' => '200px','alt'=>'fighterAvatar'));
                        }else
                        { 
                            echo $this->Html->image('avatars/default.png', array('width' => '200px','alt'=>'fighterDefaultAvatar'), ['class'=>'img-circle img-responsive']);
                        }    
                        ?>
                </div>
                <div class="col-md-6 ">

                            <!-- Level up to 20 -->
                            Level
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="<?= h($fighter->level) ?>" aria-valuemin="0" aria-valuemax="20" style="width: <?= h($fighter->level*100/20) ?>%">
                                    <?= h($fighter->level)?>
                                </div>
                            </div>
                            XP
                            <!-- Experience up to 20  -->
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="<?= h($fighter->xp) ?>" aria-valuemin="0" aria-valuemax="20" style="width: <?= h($fighter->xp*100/20) ?>%">
                                    <?= h($fighter->xp)?>
                                </div>
                            </div>
                            Sight
                            <!-- Sight up to 7  -->
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="<?= h($fighter->skill_sight) ?>" aria-valuemin="0" aria-valuemax="20" style="width: <?= h($fighter->skill_sight*100/7) ?>%">
                                    <?= h($fighter->skill_sight)?>
                                </div>
                            </div>
                            Strength
                            <!-- Strength up to 10  -->
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="<?= h($fighter->skill_strength) ?>" aria-valuemin="0" aria-valuemax="20" style="width: <?= h($fighter->skill_strength*100/10) ?>%">
                                    <?= h($fighter->skill_strength)?>
                                </div>
                            </div>
                            Health - your max health is <?= h($fighter->skill_health); ?>
                            <!-- current Health up to skill health =11  -->
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="<?= h($fighter->current_health) ?>" aria-valuemin="0" aria-valuemax="<?= h($fighter->skill_health) ?>" style="width: <?= h($fighter->current_health/$fighter->skill_health*100) ?>%">
                                    <?= h($fighter->current_health)?>
                                </div>
                            </div>
                            <?= __('Guild :') ?>
                            <?php if($guild) echo($guild->name);
                            else echo('No guild'); ?>
                        </div>


                        <div class="col-md-3">
                            <?php
                            if($fighter->current_health == 0)
                            {
                                ?>
                                <div class="alert alert-danger">
                                  <strong>You have just died!</strong> You have to start with a new fighter
                                </div>
                                <?php 
                            } 
                            else {
                                if($isUpgradable == true) 
                                { ?>
                                    <div class="alert alert-success">
                                      <strong>Success!</strong><?= h($levelUpString)?>
                                    </div>
                                    <div class="list-group">
                                    <?= $this->Html->link(__('+1 Sight'), ['action' => 'levelup', 'sight'], ['class'=>'list-group-item text-center']) ?>
                                    <?= $this->Html->link(__('+1 Strength'), ['action' => 'levelup', 'strength'], ['class'=>'list-group-item text-center']) ?>
                                    <?= $this->Html->link(__('+3 Max health'), ['action' => 'levelup', 'health'], ['class'=>'list-group-item text-center']) ?>
                                    </div>

                            <?php } else
                                { ?>
                                    <div class="alert alert-info">
                                      You don't have enough XP to upgrade level !
                                    </div>
                                <?php }
                            }
                            ?>
                        </div>

                            
                        </div>
                        
                    </div>
                </div>

                </div> 
            </div>
        </div>
        <script>
            $(function () {
                $('#profile-image1').on('click', function () {
                    $('#profile-image-upload').click();
                });
            });
        </script> 









    </div>





