<?php @session_start(); ?><?php ?>
<?php
require_once("../../controller/init.php");
?>
<?php require_once($resspath . "pages/generic/top.php"); ?>
<script>
    $(document).ready(function () {
        $("#task-add-button").click(function () {

            $("#task-add").submit();

        });
    }
    );

</script>
<div id="container-main">
    <div class="centralizer">
        <div class="main breadcrumb mtheader">
            <p><a href="<?php echo $urlDashboardSee ?>"><b><?php echo $txt[$idLang]['menu0005'] ?></b></a> - <a href="<?php echo $urlTaskAdd ?>"><?php echo $txt[$idLang]['menu0001'] ?></a> - <a href="<?php echo $urlTaskSee ?>"><?php echo $txt[$idLang]['menu0002'] ?></a> - <a href="<?php echo $urlProjectModify ?>"><?php echo $txt[$idLang]['menu0003'] ?></a> - <a href="<?php echo $urlTaskAnalyze ?>"><?php echo $txt[$idLang]['menu0004'] ?></a></p>
        </div>
    </div>
</div>
<div id="container-main">
    <div class="centralizer">
        <div class="main">
        </div>	
    </div>
</div>

<div id="action_bottomright">
    <a href="#" id="task-add-button" title="<?php echo $txt[$idLang]['basic0002'] ?>" ><img src="<?php echo $urlImg ?>ico-send-64.png" alt="+" /></a>
    <a href="<?php echo $urlProjectModify ?>" title="<?php echo $txt[$idLang]['basic0008'] ?>" ><img src="<?php echo $urlImg ?>ico-edit-32.png" alt="+" /></a>
</div>
</div>
<?php require_once($resspath . "pages/generic/bottom.php"); ?>
