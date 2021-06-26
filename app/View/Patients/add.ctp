<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
    <?php echo $this->Html->css('register'); ?>
    <?php echo $this->Form->create(); ?>
    <fieldset style="background-color: gray;border-color:#e74c3c; border-radius: 10px;">
        <h2 style="color:white">
            <span class="entypo-plus" class></span> Add Patient
        </h2>

        <?php

        echo $this->Form->input(
            'user_id',
            [
                'type' => 'select',
                'label' => 'National ID<br><br>',
                'style' => 'color:black',
                'class' => 'chosen-select input dropbtn required'
            ]
        );
        echo '<br>';
        echo $this->Form->input(
            'hospital_id',
            [
                'type' => 'select',
                'label' => 'Hospital<br><br>',
                'style' => 'color:black',
                'class' => 'chosen-select input dropbtn required'
            ]
        );
        ?>
        <br>
        <div class="input date required">
            <label for="PatientTestDateMonth">Test Date</label><input type="date" id="birthday" name="data[Patient][test_date]">
        </div>

        <div class="input select required">
            <?php echo $this->Form->input('state', [
                'options' => [
                    'Good' => 'Good',
                    'Medium' => 'Medium',
                    'Bad' => 'Bad'
                ],
                'class' => 'input dropbtn required',
                'style' => 'color:black',
                'label' => 'State<br><br>',
            ]); ?>
        </div>
        <?php echo "<br>"; ?>
        <?php echo $this->Form->input('chronic_diease');
        ?>

        <div class="input select required">
            <?php
            echo $this->Form->input('test_result', [
                'options' => [
                    '-1' => 'Negative',
                    '1' => 'Positive'
                ],
                'class' => 'input dropbtn required',
                'style' => 'color:black',
                'label' => 'Test result<br><br>'
            ]); ?>
        </div><br>
        <div class="input date"><label for="PatientDeathDateMonth"> Death Date</label>
            <input type="date" id="birthday" name="data[Patient][death_date]">
        </div>

        </div>

        <br>
    </fieldset>
    <?php echo $this->Form->submit('Add', ['style' => 'margin-left: 32px;background-color: #e74c3c;']); ?>
</body>
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
                $('#PatientUserId').html(users_options);
            },
            error: function(request, status, error) {
                console.log("hi");
                alert(error);
            }
        });
        $.ajax({
            method: 'POST',
            url: '<?php echo $this->Html->url(['controller' => 'hospitals', 'action' => 'ajax_get_hospitals_id']); ?>',
            data: {},
            evalScripts: true,
            dataType: 'JSON',
            success: function(response) {
                var users_options = '<option value=""><?php echo __("Please Select One"); ?></option>'

                for (const prop in response) {
                    users_options += '<option value="' + prop + '" > ' + response[prop] + ' </option>';
                }
                $('#PatientHospitalId').html(users_options);
            },
            error: function(request, status, error) {
                console.log("hi");
                alert(error);
            }
        });
    });
</script>

</html>