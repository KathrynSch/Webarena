
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Fighter'), ['action' => 'edit']) ?> </li>
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
                     <div  align="center"> <img alt="User Pic" src="https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg" id="profile-image1" class="img-circle img-responsive"> 
                
                <input id="profile-image-upload" class="hidden" type="file">
<div style="color:#999;" >click here to change profile image</div>
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


            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
       
            
    </div> 
    </div>
</div>  
    <script>
              $(function() {
    $('#profile-image1').on('click', function() {
        $('#profile-image-upload').click();
    });
});       
              </script> 
       
       
       
       
       
       
       
       
       
   </div>
</div>




         