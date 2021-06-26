<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
    <?php echo $this->Html->css('register'); ?>
    <?php echo $this->Html->css('table'); ?>
</head>

<body>
    <?php echo $this->Form->create(); ?>
    <fieldset style="background-color: gray;border-color:#e74c3c; border-radius: 10px;">
        <h2 style="color:white">
            <span class="fa fa-edit" class></span> Select Patient
        </h2>
        <?php
        echo $this->Form->input(
            'national_id',
            [
                'type' => 'select',
                'label' => 'National ID<br><br>',
                'style' => 'color:black',
                'class' => 'chosen-select input dropbtn required'
            ]
        );
        echo "<br>";
        ?>
    </fieldset>
    <table style="color:white;background-color: gray;display:none; margin-left: -12px; ;" id="UserInfo" class="content-table">
    </table>
    <script>
        $(document).ready(function() {
            $.ajax({
                method: 'POST',
                url: '<?php echo $this->Html->url(['controller' => 'users', 'action' => 'ajax_get_national_id']); ?>',
                data: {},
                evalScripts: true,
                dataType: 'JSON',
                success: function(response) {
                    var users_options = '<option value=""><?php echo __("Please Select One"); ?></option>'

                    for (const prop in response) {
                        users_options += '<option value="' + response[prop] + '" > ' + prop + ' </option>';
                    }
                    $('#PatientNationalId').html(users_options);
                },
                error: function(request, status, error) {
                    console.log("hi");
                    alert(error);
                }
            });
            $('#PatientNationalId').on('change', function() {
                $.ajax({
                    method: 'POST',
                    url: '<?php echo $this->Html->url(['controller' => 'patients', 'action' => 'ajax_get_record_by_national_id']); ?>',
                    data: {
                        user_id: $('#PatientNationalId').val()
                    },
                    evalScripts: true,
                    dataType: 'JSON',
                    success: function(response) {
                        $('#UserInfo').append('');
                        $('#UserInfo').empty();
                        $('#UserInfo').append('<tr><th>Test Date</th><th>Action</th><tr>');
                        for (const prop in response) {
                            var str = 'delete';
                            var del = str.link('/patients/delete/' + response[prop]['Patient']['id']);
                            var upd = 'edit'.link('/patients/update/' + response[prop]['Patient']['id']);
                            $('#UserInfo').append('<tr><td>' + response[prop]['Patient']['test_date'] + '</td><td>' +
                                del + " " + upd +
                                '</td></tr>');
                        }
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

</body>

</html>