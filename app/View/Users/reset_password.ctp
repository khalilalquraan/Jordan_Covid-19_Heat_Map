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
            color: darkred;
            text-align: center;
            font-size: 25px;
        }
    </style>
</head>

<body>
    <div class='center'>
        <?php echo $this->Form->create('User'); ?>
        <div class="Dcenter">
            <fieldset style=" background-color: gray;border-color:#e74c3c; border-radius: 10px;margin:auto;">
                <h2 style="color:white">
                    <span class="fa fa-refresh" class></span> Reset Password
                </h2>
                <?php
                echo $this->Form->input('national_id', array('type' => 'text', 'placeholder' => 'National ID', 'value' => '', 'label' => false));
                echo $this->Form->submit('Request Reset', array('id' => 'requestReset', 'type' => 'submit', 'style' => 'background-color:#e74c3c;'));
                ?>
                <div id="Answer" style="color:white;text-align: center;"></div>
                <?php
                echo $this->Form->input('Question Answer', array('value' => '', 'required' => true, 'type' => 'text', 'placeholder' => 'question answer', 'style' => 'display:none', 'label' => false));
                echo $this->Form->input('username', array('value' => '', 'type' => 'text', 'placeholder' => 'New Username', 'style' => 'display:none', 'label' => false));
                echo $this->Form->input('password', array('value' => '', 'type' => 'password', 'placeholder' => 'New Password', 'style' => 'display:none', 'label' => false));
                echo $this->Form->submit('Submit Request', array('value' => '', 'id' => 'submitRequest', 'type' => 'submit', 'style' => 'background-color:#e74c3c;display:none'));
                ?>
            </fieldset>
        </div>

    </div>
</body>
<script>
    requestReset
    $(document).ready(function() {
        $('#requestReset').on('click', function(e) {
            e.preventDefault();
            $.ajax({
                method: 'POST',
                url: '<?php echo $this->Html->url(['controller' => 'users', 'action' => 'ajax_get_info_reset_pass']); ?>',
                data: {
                    national_id: $('#UserNationalId').val()
                },
                evalScripts: true,
                dataType: 'JSON',
                success: function(response) {
                    console.log(response['User']['safe_question']);
                    if (response['User']['safe_question'] == -1) {
                        alert("The National ID does not exsit");
                        window.location.reload();
                    } else {
                        var questions = [
                            "What Is your favorite book?",
                            "What is the name of the road you grew up on?",
                            "What is your mother’s maiden name?",
                            "What was the name of your first/current/favorite pet?",
                            "Where is your favorite place to vacation?"
                        ];
                        $('#Answer').text(questions[response['User']['safe_question']]);
                        $('#Answer').show();
                        $('#UserUsername').show();
                        $('#UserPassword').show();
                        $('#submitRequest').show();
                        $('#UserQuestionAnswer').show();
                    }
                },
                error: function(request, status, error) {
                    console.log("hi");
                    alert(error);
                }
            });
        });
    });
</script>

</html>