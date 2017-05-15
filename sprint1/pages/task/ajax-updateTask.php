<?php
require_once("../../controller/init.php");
?>
<?php
    if (!empty($_POST['taskId'])) {
            $taskId = sChamp($_POST['taskId']);
    }else{
        $taskId = null;
    }
    if (!empty($_POST['idUser'])) {
            $idUser = sChamp($_POST['idUser']);
    }else{
        $idUser = null;
    }
    if (!empty($_POST['idCat'])) {
            $idCat = sChamp($_POST['idCat']);
    }else{
        $idCat = null;
    }
    if (!empty($_POST['idProj'])) {
            $idProj = sChamp($_POST['idProj']);
    }else{
        $idProj = null;
    }
    if (!empty($_POST['desc'])) {
            $desc = sChamp($_POST['desc']);
    }else{
        $desc = null;
    }
    if (!empty($_POST['date'])) {
            $date = sChamp($_POST['date']);
    }else{
        $date = null;
    }
    if (!empty($_POST['time']) || $_POST['time'] == 0) {
            $time = sChamp($_POST['time']);
    }else{
        $time = null;
    }
    ?>
    <?php
    if(isset($taskId) && isset($idUser) && isset($idCat) && isset($idProj) && isset($desc) && isset($date) && isset($time)){
        $task = getTaskById($taskId);
        $idUser = getUserByName($idUser)->getId();
        $task->update($taskId, $idUser, $idProj, $idCat, $desc, $date, $time);
    }
    ?>
    
