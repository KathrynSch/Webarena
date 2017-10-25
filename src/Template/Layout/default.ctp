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
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><a href=""><?= $this->fetch('title') ?></a></h1></li>
              <li> <?php echo $this->Html->link('home', array('controller' => 'Arenas', 'action' => '/')); ?> </li>
                <?php echo $this->Html->link('sight', array('controller' => 'Arenas', 'action' => 'sight')); ?>
                <?php echo $this->Html->link('diary', array('controller' => 'Arenas', 'action' => 'diary')); ?>
                <?php echo $this->Html->link('fighter', array('controller' => 'fighter', 'action' => 'view')); ?>
                <?php echo $this->Html->link('login', array('controller' => 'Arenas', 'action' => 'login')); ?>
            
        </ul>
        <div class="top-bar-section">
            <ul class="right">
                <?php if($loggedIn) : ?>
                <li><?= $this->Html->link('Logout',['controller' => 'players', 'action' => 'logout']); ?></li>

                <?php else: ?>
                <li><?= $this->Html->link('Register',['controller' => 'players', 'action' => 'register']); ?></li>

            <?php endif; ?>

            </ul>
        </div>
    </nav>
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
        <p>Groupe n°5</p>
        <p>Autors: SCHUTTE, GRIERE, DUMONT, BRUNETON</p>
        <p>Options: BF</p>
    </footer>
</body>
</html>
