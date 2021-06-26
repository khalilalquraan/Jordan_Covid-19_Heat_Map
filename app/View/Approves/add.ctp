<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Healthcare</title>
    <?php echo $this->Html->css('table'); ?>
    <?php echo $this->Html->css('register'); ?>

    <?php
    if (isset($_SESSION['Auth']['admin'])) {
        unset($_SESSION['Auth']['admin']);
        echo "<script>alert('The National id was saved successfully')</script>";
    }

    ?>
</head>

<body>
    <?php echo $this->Form->create(); ?>
    <div style="width: 50%;padding: 10px;">
        <fieldset style=" background-color: gray;border-color:#e74c3c; border-radius: 10px;color:white;margin:auto;">
            <br>
            <?php echo $this->Form->input('national_id', ['type' => 'text', 'label' => 'Add National ID']); ?>
            <?php echo $this->Form->submit('Add', ['style' => 'background-color:#e74c3c;']); ?>
            <?php echo $this->Form->create(); ?>
            <?php echo $this->Form->input('national', ['style' => 'color:black', 'type' => 'select', 'class' => 'chosen-select input dropbtn required', 'label' => 'Select National ID<br><br>']); ?>
        </fieldset>
    </div>
    <table style="background-color: gray;display:none; margin-left: -12px; ;" id="UserInfo" class="content-table">
</body>
<script>
    $(document).ready(function() {
        $.ajax({
            method: 'POST',
            url: '<?php echo $this->Html->url(['controller' => 'approves', 'action' => 'ajax_get_national_id']); ?>',
            data: {},
            evalScripts: true,
            dataType: 'JSON',
            success: function(response) {
                console.log(response);
                var users_options = '<option value=""><?php echo __("Please Select One"); ?></option>';

                for (const prop in response) {
                    users_options += '<option value="' + prop + '" > ' + response[prop] + ' </option>';
                }
                $('#ApproveNational').html(users_options);
            },
            error: function(request, status, error) {
                console.log("hi");
                alert(error);
            }
        });
        $('#ApproveNational').on('change', function() {
            $.ajax({
                method: 'POST',
                url: '<?php echo $this->Html->url(['controller' => 'approves', 'action' => 'ajax_get_record_by_national_id']); ?>',
                data: {
                    user_id: $('#ApproveNational').val()
                },
                evalScripts: true,
                dataType: 'JSON',
                success: function(response) {
                    console.log(response);
                    $('#UserInfo').append('');
                    $('#UserInfo').empty();
                    $('#UserInfo').append('<tr><th>National Id</th><th>Action</th><tr>');
                    var str = 'delete';
                    var del = str.link('/approves/delete/' + response['Approve']['id']);
                    $('#UserInfo').append('<tr>' + '<td>' + response['Approve']['national_id'] + '</td>' + '<td>' + del + '</td></tr>');

                    $("#UserInfo").show();
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