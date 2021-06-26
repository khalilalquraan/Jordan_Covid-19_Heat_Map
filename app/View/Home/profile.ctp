<html lang="en">

<head>
    <?php echo $this->Html->script('register'); ?>
    <?php echo $this->Html->css('register'); ?>
    <title>Profile</title>

</head>

<body>
    <div class='form users'>

        <?php echo $this->Form->create('User'); ?>

        <fieldset style=" background-color: gray;border-color:#e74c3c; border-radius: 10px;width: 125%">
            <h2 style="color:white">
                <span class="fa fa-address-card" class></span> Profile
            </h2>
            <h2 style="color:white">
                <span class="fa fa-user-circle"></span>
                <?php echo $_SESSION['Auth']['User']['first_name'] . " " . $_SESSION['Auth']['User']['family_name']; ?>
                <hr>
            </h2>
            <h2 style="color:white">
                <span class="fa fa-id-card-o">
                    <b style="font-size: 25px;">National ID : </b>
                </span>
                <?php echo $_SESSION['Auth']['User']['national']; ?>
                <hr>
            </h2>
            <h2 style="color:white">
                <span class="fa fa-user-o">
                    <b style="font-size: 25px;">Username : </b>
                </span>
                <?php echo $_SESSION['Auth']['User']['username']; ?>
                <hr>
            </h2>
            <h2 style="color:white">
                <span class="fa fa-envelope">
                    <b style="font-size: 25px;">Email : </b>
                </span>
                <?php echo $_SESSION['Auth']['User']['email']; ?>
                <hr>
            </h2>
            <h2 style="color:white">
                <span class="fa fa-calendar">
                    <b style="font-size: 25px;">Age : </b>
                </span>
                <?php echo $_SESSION['Auth']['User']['age']; ?>
                <hr>
            </h2>
            <h2 style="color:white">
                <span class="fa fa-home">
                    <b style="font-size: 25px;">City : </b>
                </span>
                <?php echo $_SESSION['Auth']['User']['city']; ?>
                <hr>
            </h2>
            <h2 style="color:white">
                <span class="fa fa-home">
                    <b style="font-size: 25px;">Neighbourhood : </b>
                </span>
                <?php echo $_SESSION['Auth']['User']['neighbourhood']; ?>
                <hr>
            </h2>
            <h2 style="color:white">
                <span class="fa fa-home">
                    <b style="font-size: 25px;">Suburb : </b>
                </span>
                <?php echo $_SESSION['Auth']['User']['suburb']; ?>

            </h2>
        </fieldset>
    </div>
</body>

</html>