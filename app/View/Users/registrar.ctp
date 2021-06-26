<html lang="en">

<head>
    <?php echo $this->Html->script('register'); ?>
    <?php echo $this->Html->css('register'); ?>
    <title>Register</title>

</head>

<body>
    <div class='form users'>

        <?php echo $this->Form->create('User'); ?>

        <fieldset style=" background-color: gray;border-color:#e74c3c; border-radius: 10px;">
            <h2 style="color:white">
                <span class=" fa fa-plus-circle" class></span> Register
            </h2>

            <?php
            echo $this->Form->input('username');
            echo $this->Form->input('password');
            echo $this->Form->input('first_name');
            echo $this->Form->input('family_name');
            echo $this->Form->input('age');
            echo $this->Form->input('national');
            echo $this->Form->input('email');
            echo $this->Form->input('latitude', ['type' => 'hidden']);
            echo $this->Form->input('longitude', ['type' => 'hidden']);
            echo $this->Form->input('city', ['type' => 'hidden']);
            echo $this->Form->input('neighbourhood', ['type' => 'hidden']);
            echo $this->Form->input('postcode', ['type' => 'hidden']);
            echo $this->Form->input('suburb', ['type' => 'hidden']);
            ?>
            <div class="input select required">
                <?php echo $this->Form->input('role_id', [
                    'options' => [
                        1 => 'user',
                        3 => 'healthcare manager'
                    ],
                    'class' => 'input dropbtn required',
                    'style' => 'color:black',
                    'label' => 'Role<br><br>',
                ]); ?>
            </div>
            <br>
            <div class="input select required">
                <?php echo $this->Form->input('safe_question', [
                    'options' => [
                        0 => 'What Is your favorite book?',
                        1 => 'What is the name of the road you grew up on?',
                        2 => 'What is your mother’s maiden name?',
                        3 => 'What was the name of your first/current/favorite pet?',
                        4 => 'Where is your favorite place to vacation?'
                    ],
                    'class' => 'input dropbtn required',
                    'style' => 'color:black',
                    'label' => 'Security Question<br><br>',
                ]); ?>
            </div>
            <br>
            <?php echo $this->Form->input('answer_safe_question', ['label' => 'Security Question Answer']); ?>
            <br>
            <div class="submit"><input id="location" type="submit" value="Get Loction Info" /></div>
        </fieldset>
        <div class="submit" style="margin-left: 16px; ">
            <?php echo $this->Form->submit('Registrar', array('type' => 'submit', 'style' => 'background-color:#e74c3c;')); ?>
        </div>


    </div>
</body>
<script>
    $('#location').click(function(e) {
        e.preventDefault();
        console.log("im here");
        getCoordintes();
    });
</script>

</html>