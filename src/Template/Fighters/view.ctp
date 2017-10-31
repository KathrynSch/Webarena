
    <div class="row content">
        <div class="col-md-2 sidenav">
            <p><?= $this->Html->link(__('Edit My Fighter'), ['action' => 'edit']) ?></p>
            <p><?= $this->Html->link(__('Hall of Fame'), ['action' => 'index']) ?></p>
            <p><?= $this->Html->link(__('Guilds'), ['controller'=>'Arenas','action' => 'guilds']) ?></p>
            <p><?= $this->Html->link(__('New Fighter'), ['action' => 'add']) ?></p>
            <p><?= $this->Html->link(__('Enter Arena'), ['controller' => 'Arenas', 'action' => 'sight']) ?></p>
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
                        { ?>
                            <img alt="User Pic" src="https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg" id="profile-image1" class="img-circle img-responsive">
                        <?php ;} ?>
                            <input id="profile-image-upload" class="hidden" type="file">

                    
                   </div>
                   <div class="col-md-6 ">
                        
                       
                            
                            
                            <!-- Level up to 20 -->
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="<?= h($fighter->level) ?>" aria-valuemin="0" aria-valuemax="20" style="width: <?= h($fighter->level)*100/20 ?>%">
                                    Level <?= h($fighter->level)?>
                                </div>
                            </div>
                            <!-- Experience up to 20  -->
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="<?= h($fighter->xp) ?>" aria-valuemin="0" aria-valuemax="20" style="width: <?= h($fighter->xp)*100/20 ?>%">
                                    XP <?= h($fighter->xp)?>
                                </div>
                            </div>
                            <!-- Sight up to 7  -->
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="<?= h($fighter->skill_sight) ?>" aria-valuemin="0" aria-valuemax="20" style="width: <?= h($fighter->skill_sight)*100/7 ?>%">
                                    Sight <?= h($fighter->skill_sight)?>
                                </div>
                            </div>
                            <!-- Strength up to 10  -->
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="<?= h($fighter->skill_strength) ?>" aria-valuemin="0" aria-valuemax="20" style="width: <?= h($fighter->skill_strength)*100/10 ?>%">
                                    Strength <?= h($fighter->skill_strength)?>
                                </div>
                            </div>
                            <!-- current Health up to skill health =11  -->
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="<?= h($fighter->current_health) ?>" aria-valuemin="0" aria-valuemax="20" style="width: <?= h($fighter->current_health)*100/11 ?>%">
                                    Health <?= h($fighter->current_health)?>
                                </div>
                            </div>
                            <?= __('Guild :') ?>
                            <?php if($guild) echo($guild->name);
                            else echo('No guild'); ?>
                        </div>
                        <div class="col-md-3 list-group">

                            <?= $this->Html->link(__($levelUpString), ['action' => 'levelup'], ['class'=>'list-group-item text-center']) ?>
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





