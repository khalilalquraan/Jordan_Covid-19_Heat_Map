<!DOCTYPE html>
<html>

<head>


    <title>Covid-19 Healthmap
    </title>



</head>

<body style="background-color:black;" ;>

    ﻿<style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            text-align: center;
        }

        .row {
            margin-right: 0;
            margin-left: 0;
        }

        .divtitel {

            background-color: #393333;
            height: 60px;
            margin-top: -22px;
            padding: 13px;
            text-align: center;
            color: white;
            font-size: 25px;
            margin-bottom: 3px;
        }

        .maindiv {
            height: 700px;
            color: white;

        }

        .divcenter {
            background-color: #393333;
            border: 7px solid black;
            height: 700px;
        }

        .divL1 {
            background-color: #393333;
            height: 150px;
            border: 7px solid black;
            color: white;

        }

        .divL1Start {
            padding-top: 25px;
        }

        .divL2 {
            background-color: #393333;
            height: 550px;
            border: 7px solid black;
            overflow-y: scroll;
            overflow-x: hidden;
        }

        ::-webkit-scrollbar {
            width: 10px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        .divR1 {

            height: 400px;

        }

        .divR1R {
            background-color: #393333;
            height: 600px;
            border: 7px solid black;
            overflow-y: scroll;
            overflow-x: hidden;
        }


        .divR3 {
            background-color: #393333;
            height: 300px;
            border: 7px solid black;
        }

        .redtext {
            color: red;
            text-align: center;
        }

        table {
            text-align: center !important;
        }

        hr {
            margin-right: -61px;
            margin-left: 6px;

        }
    </style>
    <?php

    //echo $this->Html->css('bootstrap');
    echo $this->Html->css('bootstrap.min');
    //echo $this->Html->css('cake.generic');
    ?>
    <div class=" divtitel">
        <p>COVID-19 statistics report - Jordan</p>
    </div>
    <div class="row maindiv">
        <!-- @*row1 L*@ -->
        <div class="col-sm-2 ">
            <div class="divL1">
                <h3><b>Total Cases</b></h3>
                <h3><b style="color:red"><?= $data['totalCases'] ?></b></h3>
            </div>
            <div class="divL2 table-responsive">
                <h3><b>Cases by Region</b></h3>

                <table>
                    <?php foreach ($data['casesByRegion'] as $key => $val) : ?>
                        <tr>
                            <td>
                                <div>
                                    <h4><b class="redtext"><?php echo $val; ?></b> <b> <?php echo $key; ?></b></h4>
                                    <hr />
                                </div>

                            </td>

                        </tr>
                    <?php endforeach ?>
                </table>
            </div>
        </div>
        <!-- @*row1 center*@ -->
        <div class="col-sm-6 divcenter" id="map">



        </div>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqi1pTz4AF81kI0rgfGbMh1eJvBsLS7zc&libraries=visualization&callback=myMap"></script>
        <script>
            /* Data points defined as a mixture of WeightedLocation and LatLng objects */
            var heatMapData = [];
            <?php foreach ($data['position'] as $key => $val) : ?>
                heatMapData.push({
                    location: new google.maps.LatLng(<?= $val['User']['latitude'] ?>, <?= $val['User']['longitude'] ?>),
                    weight: 2
                });
            <?php endforeach ?>
            var sanFrancisco = new google.maps.LatLng(30.999158, 36.930359);

            map = new google.maps.Map(document.getElementById('map'), {
                center: sanFrancisco,
                zoom: 7,
                mapTypeId: 'satellite'
            });

            var heatmap = new google.maps.visualization.HeatmapLayer({
                data: heatMapData
            });
            heatmap.setMap(map);
        </script>
        <!-- @*row1 R*@ -->
        <div class="col-sm-4 ">

            <div class="divR1">
                <div class="col-sm-6 divR1R">
                    <h3><b>Total Deaths</b></h3>
                    <h3><b style="color:red"><?= $data['totalDeath'] ?></b></h3>
                    <table>
                        <?php foreach ($data['deathsByRegion'] as $key => $val) : ?>
                            <tr>
                                <td>
                                    <div>
                                        <h4><b class="redtext"><?php echo $val; ?></b> <b><?php echo $key ?></b></h4>
                                        <hr />
                                    </div>

                                </td>

                            </tr>
                        <?php endforeach ?>
                    </table>
                </div>
                <div class="col-sm-6 divR1R">

                    <h3><b>Total Recovered</b></h3>
                    <h3><b style="color:red"><?= $data['totalRecovered'] ?></b></h3>
                    <table>
                        <?php foreach ($data['recoveredCases'] as $key => $val) : ?>
                            <tr>
                                <td>
                                    <div>
                                        <h4><b class="redtext"><?php echo $val; ?></b> <b> <?php echo $key; ?></b></h4>
                                        <hr />
                                    </div>

                                </td>

                            </tr>
                        <?php endforeach ?>

                    </table>
                </div>
            </div>

            <div class="divR3">

                <h5> <b style="align-content: center; scroll-margin-block:200px;">Last Update At</b> </h5>
                <h4><b><?= date('Y-m-d') ?></b></h4>
            </div>

        </div>

    </div>
    <div class="row">
        <div class="col-sm-2 ">
            <div class="divL1 divL1Start">
                <h1><button type="button" style="font-size: 22px; color:white; background-color: #393333;">Get Report</button></h1>
            </div>
        </div>
        <div class="col-sm-10 " style="margin-left: -15px; padding: 0 0;">
            <div class="col-sm-2 divL1">
                <h3><b style="font-size: 14px;">New Deaths</b></h3>
                <h1><b style="font-size: 22px;"><?= $data['newDeaths'] ?></b></h1>

            </div>
            <div class="col-sm-2 divL1">
                <h3><b style="font-size: 14px;">Daliy Positive Cases</b></h3>
                <h1><b style="font-size: 22px;"><?= $data['daliyPositiveCases'] ?></b></h1>
            </div>
            <div class="col-sm-2 divL1">
                <h3><b style="font-size: 14px;">New Positive Cases</b></h3>
                <h1><b style="font-size: 22px;"><?= $data['newPositiveCases'] ?></b></h1>
            </div>
            <div class="col-sm-2 divL1">
                <h3><b style="font-size: 14px;">Total Activity Cases</b></h3>
                <h1><b style="font-size: 22px;"><?= $data['totalActivitycases'] ?></b></h1>
            </div>
            <div class="col-sm-2 divL1">
                <h3><b style="font-size: 14px;">Recovered Cases</b></h3>
                <h1><b style="font-size: 22px;"><?= $data['recoveredCasesToDay'] ?></b></h1>
            </div>
            <div class="col-sm-2 divL1">
                <h1><button type="button" style="font-size: 22px; color:white; background-color: #393333;">about us</button></h1>
            </div>

        </div>

    </div>
</body>

</html>