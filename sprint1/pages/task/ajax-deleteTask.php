<?php
require_once("../../controller/init.php");
?>
<script type="text/javascript">
    </script>
<?php
    //Management project delete
//    alert("delete page process");
    if (!empty($_POST['taskId'])) {
            $taskId = sChamp($_POST['taskId']);
            getTaskById($taskId)->delete();
    }
    ?>
