<?php @session_start(); ?><?php ?>
<?php
require_once("controller/init.php");
?>
<?php require_once($resspath . "pages/generic/top.php"); ?>
<script>
    $(document).ready(function () {
        $("#task-add-button").click(function () {

            $("#task-add").submit();

        });
    }
    );

    $("#username").on('change', function (event) {
        sortProjects();
    });

</script>
<div id="container-main">
    <div class="centralizer">
        <div class="main breadcrumb mtheader">
            <p><a href="<?php echo $urlDashboardSee ?>"><?php echo $txt[$idLang]['menu0005'] ?></a> - <a href="<?php echo $urlTaskAdd ?>"><b><?php echo $txt[$idLang]['menu0001'] ?></b></a> - <a href="<?php echo $urlTaskSee ?>"><?php echo $txt[$idLang]['menu0002'] ?></a> - <a href="<?php echo $urlProjectModify ?>"><?php echo $txt[$idLang]['menu0003'] ?></a> - <a href="<?php echo $urlTaskAnalyze ?>"><?php echo $txt[$idLang]['menu0004'] ?></a></p>
        </div>
    </div>
</div>
<div id="container-main">
    <div class="centralizer">
        <div class="main">
            <?php
            $action = false;

            $errors = array();

            if (isset($_POST['validate'])) {
                $userId = sChamp($_POST['username']);
                $projectId = sChamp($_POST['projectname']);
                $date = sChamp($_POST['date']);
                $hour = sChamp($_POST['hour']);
                $minute = sChamp($_POST['minute']);
                $childcategory = sChamp($_POST['childcategory']);

                $description = 0;
                if (isset($_POST['description']))
                    $description = $_POST['description'];

                $dateG = $date != null;

                $time = $hour * 60 + $minute;
                if ($date != null) {
                    $date = str_replace('/', '-', $date);
                    $date = date('Y-m-d', strtotime($date));
                }
                if ($dateG) {
                    //Create new task
                    $newTask = new Task();
                    $action = $newTask->add($userId, $projectId, $childcategory, $description, $date, $time);
                } else {
                    //Affichage messages erreurs (avant form)
                    if (!$dateG) {
                        $errors[] = $txt[$idLang]['error0001'];
                    }


                    echo "<p class='error'>";

                    foreach ($errors as $error) {
                        echo "- " . $error . "<br />";
                    }
                    echo "</p><br />";
                }
            }



            if ($action) {
                ?>
                <p class='success' id ="success"><?php echo $txt[$idLang]['task0015'] ?></p>
                <?php
                require_once ($resspath . "pages/task/add-form.php");
            } else {
//                if (!$dateG) {
//                     ?>
                     <script>
                        $("label[for='date']").addClass("error-label");
                    </script>
                    //<?php
//                    }
                require_once ($resspath . "pages/task/add-form.php");
            }
            ?>
        </div>	
    </div>
</div>

<div id="action_bottomright">
    <a href="#" id="task-add-button" title="<?php echo $txt[$idLang]['basic0002'] ?>" ><img src="<?php echo $urlImg ?>ico-send-64.png" alt="+" /></a>
    <a href="<?php echo $urlProjectModify ?>" title="<?php echo $txt[$idLang]['basic0008'] ?>" ><img src="<?php echo $urlImg ?>ico-edit-32.png" alt="+" /></a>
</div>
</div>
<?php require_once($resspath . "pages/generic/bottom.php"); ?>
