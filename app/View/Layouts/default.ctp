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
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



    <?php
    // echo $this->Html->css("loginstyle", null, array("inline"=>true));
    echo $this->Html->css('navbar');
    echo $this->Html->script('navbar');
    //echo $this->Html->css('footer');
    //echo $this->Html->css('cake.generic');
    // echo $this->fetch('meta');
    // //echo $this->fetch('css');
    // echo $this->fetch('script');
    ?>
    <style>
        .container {
            display: flex;
            justify-content: center;
        }

        .message {
            color: white;
            text-align: center;
            font-size: 25px;
            background-color: black;
            margin-left: 600px;
            margin-right: 600px;
            align-items: center;
        }
    </style>
</head>

<body style="background-image: url('https://images.pexels.com/photos/6366444/pexels-photo-6366444.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260');">


    <div class="topnav" id="myTopnav">
        <?php if (!isset($_SESSION['Auth']['User']['id'])) : ?>
            <a href="/users/login" class="fa fa-sign-in" id="loginLink"> Login</a>
            <a href="/users/registrar" class="fa fa-plus-circle" id="registerLink"> Register</a>
        <?php endif ?>
        <?php if (isset($_SESSION['Auth']['User']['id'])) : ?>

            <a href="/users/logout" class="fa fa-sign-out" id="loginLink"> Logout</a>
            <a href="/home/index" class="fa fa-home" style="float:left"> Home</a>
        <?php endif ?>
        <?php if (isset($_SESSION['Auth']['User']['id']) && $_SESSION['Auth']['User']['role_id'] == 3) : ?>
            <a href="/Patients/delete" id="loginLink" class="fa fa-edit"> Update Patient</a>
            <a href="/Patients/add" id="registerLink" class="entypo-plus"> Add Patient</a>

        <?php endif ?>

        <?php if (isset($_SESSION['Auth']['User']['id'])) : ?>
            <a href="/home/profile" style="float:left" class="fa fa-user-o"> Welcome <?php echo $_SESSION['Auth']['User']['first_name'] . " " . $_SESSION['Auth']['User']['family_name']; ?></a>
        <?php endif ?>

        <?php if (isset($_SESSION['Auth']['User']['id']) && $_SESSION['Auth']['User']['role_id'] == 2) : ?>
            <a href="/Approves/add" class="fa fa-user-circle" id="registerLink"> Admin</a>
        <?php endif ?>
        <a href="/home/aboutus" class="fa fa-info-circle" style="float:left"> About us</a>
        <div class="container">
            <a>Jordan Covid 19 Heatmap</a>
        </div>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
    <?php echo $this->Flash->render(); ?>
    <?php echo $this->fetch('content'); ?>
</body>


</html>