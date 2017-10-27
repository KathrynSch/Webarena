<?php

/**
 * @var \App\View\AppView $this
 */
?>



<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Fighters'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="fighters form large-9 medium-8 columns content">
    <?= $this->Form->create('Upload',array('enctype'=>'multipart/form-data')); ?> 
    <fieldset>
        <legend><?= __('Which upgrade for your fighter?') ?></legend>
        <?=
             $this->Form->radio('upgrade', ['+1 Sight','+1 Force','+3 Max. Life']);

        ?>
    </fieldset>
    <?= $this->Form->button(__('Level UP')) ?>
    <?= $this->Form->end() ?>
</div>



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
                            <div  align="center"> <!-- <img alt="User Pic" src="https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg" id="profile-image1" class="img-circle img-responsive">--> 
                <?php if (file_exists(WWW_ROOT . 'img\avatars'.DS.$fighter->id.'.png')){
            echo $this->Html->image('avatars/'.$fighter->id.'.png', array('width' => '200px','alt'=>'fighterAvatar'));
        }else{
            echo "No picture available.";
        } ?>







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
















<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="well well-sm">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <img src="http://placehold.it/380x500" alt="" class="img-rounded img-responsive" />
                    </div>
                    <div class="col-sm-6 col-md-8">
                        <h4>
                            Bhaumik Patel</h4>
                        <small><cite title="San Francisco, USA">San Francisco, USA <i class="glyphicon glyphicon-map-marker">
                                </i></cite></small>
                        <p>
                            <i class="glyphicon glyphicon-envelope"></i>email@example.com
                            <br />
                            <i class="glyphicon glyphicon-globe"></i><a href="http://www.jquery2dotnet.com">www.jquery2dotnet.com</a>
                            <br />
                            <i class="glyphicon glyphicon-gift"></i>June 02, 1988</p>
                        <!-- Split button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary">
                                Social</button>
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span><span class="sr-only">Social</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Twitter</a></li>
                                <li><a href="https://plus.google.com/+Jquery2dotnet/posts">Google +</a></li>
                                <li><a href="https://www.facebook.com/jquery2dotnet">Facebook</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Github</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

