
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Fighter'), ['action' => 'edit']) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Fighter'), ['action' => 'delete'], ['confirm' => __('Are you sure you want to delete your fighter?')]) ?> </li>
        <li><?= $this->Html->link(__('List Fighters'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fighter'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Play'), ['controller' => 'Arenas', 'action' => 'sight']) ?> </li>
    </ul>
</nav>



<!-- BOOTSTRAP FEATURE SUPER STYLE <-->

<div class="container">
    <div class="row">       
        <div class="col-md-9 ">

            <div class="panel panel-default">
                <div class="panel-heading">  <h4 >Fighter Profile</h4></div>
                <div class="panel-body">

                    <div class="box box-info">

                        <div class="box-body">
                            <div class="col-sm-6">
                            <div  align="center"> 

                <?php if (file_exists(WWW_ROOT . 'img'.DS.'avatars'.DS.$fighter->id.'.png')){
            echo $this->Html->image('avatars/'.$fighter->id.'.png', array('width' => '200px','alt'=>'fighterAvatar'));
        }else{ ?>
            <img alt="User Pic" src="https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg" id="profile-image1" class="img-circle img-responsive">
            <?php ;} ?>
                                    <input id="profile-image-upload" class="hidden" type="file">
                                    <!--<div style="color:#999;" >click here to change profile image</div>  -->
                                    <li> <?= $this->Html->link(__($levelUpString), ['action' => 'levelup']) ?> </li> 
                                    <!--Upload Image Js And Css-->

                                </div>

                                <br>

                                <!-- /input-group -->
                            </div>
                            <div class="col-sm-6">
                                <h4 style="color:#00b1b1;"><?= h($fighter->name) ?></h4></span>
                            </div>
                            <div class="clearfix"></div>
                            <hr style="margin:5px 0 5px 0;">


                            <div class="col-sm-5 col-xs-6 tital" style="font-weight:bold;" ><?= __('Fighter Name') ?></div><div class="col-sm-7 col-xs-6 "><?= h($fighter->name) ?></div>
                            <div class="clearfix"></div>
                            <div class="bot-border"></div>

                            <div class="col-sm-5 col-xs-6 tital" style="font-weight:bold;" ><?= __('Level') ?></div><div class="col-sm-7"> <?= $this->Number->format($fighter->level) ?></div>
                            <div class="clearfix"></div>
                            <div class="bot-border"></div>

                            <div class="col-sm-5 col-xs-6 tital" style="font-weight:bold;"><?= __('Xp') ?></div><div class="col-sm-7"> <?= $this->Number->format($fighter->xp) ?></div>
                            <div class="clearfix"></div>
                            <div class="bot-border"></div>

                            <div class="col-sm-5 col-xs-6 tital" style="font-weight:bold;" ><?= __('Skill Sight') ?></div><div class="col-sm-7"><?= $this->Number->format($fighter->skill_sight) ?></div>

                            <div class="clearfix"></div>
                            <div class="bot-border"></div>

                            <div class="col-sm-5 col-xs-6 tital" style="font-weight:bold;" ><?= __('Skill Strength') ?></div><div class="col-sm-7"><?= $this->Number->format($fighter->skill_strength) ?></div>

                            <div class="clearfix"></div>
                            <div class="bot-border"></div>

                            <div class="col-sm-5 col-xs-6 tital" style="font-weight:bold;" ><?= __('Skill Health') ?></div><div class="col-sm-7"><?= $this->Number->format($fighter->skill_health) ?></div>

                            <div class="clearfix"></div>
                            <div class="bot-border"></div>

                            <div class="col-sm-5 col-xs-6 tital" style="font-weight:bold;" ><?= __('Current Health') ?></div><div class="col-sm-7"><?= $this->Number->format($fighter->current_health) ?></div>

                            <div class="clearfix"></div>
                            <div class="bot-border"></div>

                            <div class="col-sm-5 col-xs-6 tital" style="font-weight:bold;" ><?= __('Guild') ?></div><div class="col-sm-7">

    <?php if($guild) echo($guild->name);
                    else echo('No guild'); ?></div>

                            <div class="col-sm-5 col-xs-6 tital" style="font-weight:bold;" ><?= __('Guilds Page') ?></div><div class="col-sm-7">

     <?= $this->Html->link(__("Go to Guilds Page"), ['controller'=>'arenas','action' => 'guild']) ?> </div>



                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->

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
</div>




