<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('webarena.css') ?>

    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('bootstrap-theme.min.css') ?>
    <?= $this->Html->css('bootstrap.css') ?>

    <?= $this->Html->script('bootstrap.js') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    
    

</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top"  role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand">Webarena</a>
        </div>
                       
                          <ul class="nav navbar-nav">
                            <li>
                                <a <?php echo $this->Html->link('Home', array('controller' => 'Players', 'action' => 'home'), array('class' => 'text-white')); ?> </a></li>
                            <li>
                                <a <?php echo $this->Html->link('Sight', array('controller' => 'Arenas', 'action' => 'sight')); ?></a></li>
                            <li>
                                <a <?php echo $this->Html->link('Diary', array('controller' => 'Arenas', 'action' => 'diary')); ?></a></li>
                            <li>
                                <a <?php echo $this->Html->link('Fighter', ['controller' => 'Fighters', 'action' => 'view']); ?></a></li>
                             </ul>


                                <ul class="nav navbar-nav navbar-right">
                                    <?php if($loggedIn) : ?>
                                    <li>
                                        <a <?php echo $this->Html->link('LogIn/Out', array('controller' => 'Players', 'action' => 'logout')); ?></a></li>
                                    <?php else: ?>
                                    <li>
                                        <a <?= $this->Html->link('Register',['controller' => 'Players', 'action' => 'register']); ?></a></li>
                                    <?php endif; ?>

                                </ul>
                                                
      </div>
    </nav>


 <!-- 
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                
              <h1><a href=""><?= $this->fetch('title') ?></a></h1></li>
              <li> <?php echo $this->Html->link('Home', array('controller' => 'Players', 'action' => 'home')); ?> 
              </li>
                <?php echo $this->Html->link('Sight', array('controller' => 'Arenas', 'action' => 'sight')); ?>
                <?php echo $this->Html->link('Diary', array('controller' => 'Arenas', 'action' => 'diary')); ?>
                <?php echo $this->Html->link('Fighter', ['controller' => 'Fighters', 'action' => 'view']); ?>
                <?php echo $this->Html->link('LogIn/Out', array('controller' => 'Players', 'action' => 'logout')); ?>
            
            
        </ul>
        <div class="top-bar-section">
            <ul class="right">
                <?php if($loggedIn) : ?>
                <li><?= $this->Html->link('Logout',['controller' => 'Players', 'action' => 'logout']); ?></li>

                <?php else: ?>
                <li><?= $this->Html->link('Register',['controller' => 'Players', 'action' => 'register']); ?></li>

            <?php endif; ?>

            </ul>
        </div>
    </nav>  -->
    
    <?= $this->Flash->render() ?>
    <div class="container text-center clearfix">
        <?= $this->fetch('content') ?>
    </div>


<footer class="container-fluid text-center bg-lightgray" style="width:100%; padding:0px; margin-bottom: 0px;">

        <div class="copyrights" >
            <p style="margin-bottom: 0px; font-size:12px; background-color:#00897B; color:white;">
                <br>© 
                <span>Web Design By: BRUNETON, DUMONT, GRIERE, SCHUTTE</span><br>
                <span>Options B,F and D - SI05 October 2017</span>
            </p>
        </div>
</footer>


</body>
</html>
