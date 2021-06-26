<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php echo $this->Html->css('loginstyle'); ?>
    <?php echo $this->Html->script('login'); ?>
    <style>
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

<body>
    <div class='center'>
        <script type="text/javascript">
            alert("<?php print $message; ?>");
        </script>
        <?php echo $this->Form->create('User'); ?>
        <div class="Dcenter">
            <fieldset style=" background-color: gray;border-color:#e74c3c; border-radius: 10px;margin:auto;">
                <h2 style="color:white">
                    <span class="entypo-login" class></span> Login
                </h2>
                <?php
                echo $this->Form->input('username', array('type' => 'username', 'placeholder' => 'username', 'label' => false));
                echo $this->Form->input('password', array('type' => 'password', 'placeholder' => 'password', 'label' => false));
                echo $this->Form->submit('Login', array('type' => 'submit', 'style' => 'background-color:#e74c3c;'));
                ?>
                <h4 style="text-align: center;"><a style="color:white; text-decoration: none;" href="/users/reset_password">Forget Password ?</a></h4>
            </fieldset>
        </div>

    </div>
</body>

</html>