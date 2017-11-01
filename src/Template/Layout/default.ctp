
<!-- /**
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
 */ -->


<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet"> -->

    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('bootstrap.min') ?>
    <?= $this->Html->css('bootstrap-theme.min') ?>
    <?= $this->Html->css('webarena') ?>

    

    <?= $this->Html->script('bootstrap.min.js') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    
    

</head>
<body>
    <nav class="navbar navbar-inverse" role="navigation">
        <div class="container-fluid">

            <div class="navbar-header" style="background-color: #004D40;">
              <a class="navbar-brand">Webarena</a>
            </div>
            <div class="collapse navbar-collapse" style="background-color: #004D40;" id="myNavbar">
                <ul class="nav navbar-nav" style="background-color: #004D40; color: white;">
                    <li>
                        <a <?php echo $this->Html->link('Home', array('controller' => 'Players', 'action' => 'home'), array('class' => 'text-white')); ?> </a></li>
                    <?php if($loggedIn) : ?>
                    <li>
                        <a <?php echo $this->Html->link('Fighter', ['controller' => 'Fighters', 'action' => 'view']); ?></a></li>
                    <li>
                        <a <?php echo $this->Html->link('Sight', array('controller' => 'Arenas', 'action' => 'sight')); ?></a></li>
                    <li>
                        <a <?php echo $this->Html->link('Diary', array('controller' => 'Arenas', 'action' => 'diary')); ?></a></li>
                    <li>
                        <a <?php echo $this->Html->link('Messages', ['controller' => 'Arenas', 'action' => 'messages']); ?></a></li>
                    <?php endif; ?>
                </ul>

            <ul class="nav navbar-nav navbar-right">
                <?php if($loggedIn) : ?>
                <li>
                    <a <?php echo $this->Html->link('Manage account', array('controller' => 'Players', 'action' => 'edit')); ?></a></li>
                <li>
                    <a <?php echo $this->Html->link('Logout', array('controller' => 'Players', 'action' => 'logout')); ?></a></li>
                <?php else: ?>
                <li>
                    <a <?= $this->Html->link('Login',['controller' => 'Players', 'action' => 'login']); ?></a></li>
                <li>
                    <a <?= $this->Html->link('Register',['controller' => 'Players', 'action' => 'register']); ?></a></li>
                <?php endif; ?>
            </ul>                               
        </div>
    </nav>


    <div class="container-fluid content">    
        <!-- <div class="row content"> -->
            <?= $this->Flash->render() ?>
            <!-- <div class="container text-center clearfix"> -->
                <?= $this->fetch('content') ?>
        <!-- </div> -->
    </div>
    


<footer class="container-fluid text-center bg-lightgray">        
    <p>
        © 
        <span>Web Design By: BRUNETON, DUMONT, GRIERE, SCHUTTE</span><br>
        <span>Options B,F and D - SI05 October 2017</span><br>
        <span><a style="color: white;" href="versions.log">versions.log</a></span>
    </p>
</footer>


</body>
</html>
