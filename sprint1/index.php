<?php @session_start(); ?><?php
$NAV = "12";
$RIGHT = "16";
?>
<?php
require_once("controller/init.php");
?>
<?php require_once($resspath . "pages/generic/top.php"); ?>

<div class="fulldiv p1em h100">


    <?php
    $objects = getObjects();

    $statesCo = 0;
    $statesNoCo = 0;
    $statesError = 0;
    foreach ($objects as $object) {


        switch ($object->getNature()) {
            case $objectNatureGateway: {
                    $gateway = getGatewayByIdObject($object->getId());

                    if ($gateway->getConnectionStatus() == 1) {
                        $statesCo++;
                    } else if ($gateway->getConnectionStatus() == 0) {
                        $statesNoCo++;
                    } else {
                        $statesError++;
                    }

                    break;
                }
            case $objectNatureSensor : {
                    $sensor = getSensorByIdObject($object->getId());
                    ?>

                    <?php
                    break;
                }
            case $objectNatureLight : {
                    $light = getLightByIdObject($object->getId());

                    if ($light->getConnected() == 1) {
                        $statesCo++;
                    } else if ($light->getConnected() == 0) {
                        $statesNoCo++;
                    } else {
                        $statesError++;
                    }

                    break;
                }

            default : {
                    $nature_txt = $txt[$idLang]['nature0001'];
                    break;
                }
        }
    }
    ?>

    <div class="chart_div" >
        <div id="chart_div_title">Device status connectivité</div>
        <canvas id="myData" width="600" height="400"></canvas> 
    </div>
</div>
<script type="text/javascript">

    Chart.defaults.global.animation.easing = 'easeOutBounce';//Animation
    var pieData = {
        labels: [
            "Connecté",
            "Non connecté",
            "Introuvable"
        ],
        datasets: [
            {
                data: [<?php echo $statesCo ?>, <?php echo $statesNoCo ?>, <?php echo $statesError ?>],
                backgroundColor: [
                    "#82d25b",
                    "#f6af5c",
                    "#ef6d7d"
                ],
                hoverBackgroundColor: [
                    "#00D600",
                    "#F97C00",
                    "#B20000"
                ],
                borderColor: [
                    "#ffffff",
                    "#ffffff",
                    "#ffffff"],
                borderWidth: [3, 3, 3],
                hoverBorderWidth: [3, 3, 3],
                hoverBorderColor: [
                    "#00D600",
                    "#F97C00",
                    "#B20000"]
            }]
    };
    var options = {
        segmentShowStroke: true,
        title: {
            display: true,
            text: "Statut des devices",
            fontSize: 15
        }
    };

    var ctx = document.getElementById("myData").getContext("2d");

    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: pieData,
        options: options
    });



</script>


<?php require_once($resspath . "pages/generic/bottom.php"); ?>
