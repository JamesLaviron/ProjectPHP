<?php
require_once("../../controller/init.php");
?>
<?php
$projects = getProjectsInProgress();
$primaryCategories = getPrimaryCategories();
$categories = getChildCategories();
$users = getUsers();
$userSelected = null;
$projectSelected = null;
?>
<?php
//Management project
if (!empty($_POST['idP'])) {
    $idP = sChamp($_POST['idP']);
    if ($idP != 0) {
        $projectSelected = getProjectById($idP);
    }
}
//
//Management user
//
if (!empty($_POST['idU'])) {
    $idU = sChamp($_POST['idU']);
    if ($idU != 0) {
        $userSelected = getUserById($idU);
    }
}


if (!isset($userSelected) && !isset($projectSelected)) {
    $tasks = getTasks();
} elseif (isset($userSelected) && !isset($projectSelected)) {
    $tasks = getTasksByIdUser($userSelected->getId());
} elseif (isset($projectSelected) && !isset($userSelected)) {
    $tasks = getTasksByIdProject($projectSelected->getId());
} else {
    $tasks = getTasksByIdUserAndIdProject($userSelected->getId(), $projectSelected->getId());
}

//Management dates
if (!empty($_POST['dateBegin'])) {
    $dateBegin = sChamp($_POST['dateBegin']);
    $dateBegin = str_replace('/', '-', $dateBegin);
    $dateBegin = date('Y-m-d', strtotime($dateBegin));
} else {
    $dateBegin = null;
}
if (!empty($_POST['dateEnd'])) {
    $dateEnd = sChamp($_POST['dateEnd']);
    $dateEnd = str_replace('/', '-', $dateEnd);
    $dateEnd = date('Y-m-d', strtotime($dateEnd));
} else {
    $dateEnd = null;
}
if (!isset($dateBegin) && !isset($dateEnd)) {
//Let tasks as selected
} elseif (isset($dateBegin) && !isset($dateEnd)) {
    $tasks1 = array();
    foreach ($tasks as $task) {
        if ($task->getDate() == $dateBegin) {
            $tasks1[] = $task;
        }
    }
    $tasks = $tasks1;
} elseif (!isset($dateBegin) && isset($dateEnd)) {
    $tasks1 = array();
    foreach ($tasks as $task) {
        if ($task->getDate() == $dateEnd) {
            $tasks1[] = $task;
        }
    }
    $tasks = $tasks1;
} else {
    $tasks1 = array();
    foreach ($tasks as $task) {
        if ($task->getDate() <= $dateEnd && $task->getDate() >= $dateBegin) {
            $tasks1[] = $task;
        }
    }
    $tasks = $tasks1;
}
$period = new DatePeriod(new DateTime($dateBegin), new DateInterval('P1D'), new DateTime($dateEnd));
//End management dates
//////////////////////
//Management category
if (!empty($_POST['idCat'])) {
    $idCat = sChamp($_POST['idCat']);
    if ($idCat != 0) {
        $categorySelected = getCategoryById($idCat);
    } else {
        $categorySelected = null;
    }
}

if (isset($categorySelected)) {
    $tasks1 = array();
    foreach ($tasks as $task) {
        if ($task->getIdCategory() == $categorySelected->getId()) {
            $tasks1[] = $task;
        }
    }
    $tasks = $tasks1;
}
?>
<script>
    $(document).keyup(function (e) {
        if (e.keyCode == 27) { // escape key maps to keycode `27`
            // <DO YOUR WORK HERE>
            document.activeElement.focus();
            document.activeElement.blur();
        }
    });

</script>
<?php
if (isset($categorySelected)) {
    require_once($resspath . "pages/task/treeCategory.php");
    require_once($resspath . "pages/task/tableCategory.php");
}
if (isset($projectSelected)) {
    require_once($resspath . "pages/task/treeProject.php");
    require_once($resspath . "pages/task/tableProject.php");
}
if (isset($userSelected)) {
    require_once($resspath . "pages/task/treeUser.php");
    require_once($resspath . "pages/task/tableUser.php");
}
?>
<div class="fulldiv" style="display: none;" id="task_delete"></div>
<div class="fulldiv" style="display: none;" id="task_update"></div>
</div >
<?php
