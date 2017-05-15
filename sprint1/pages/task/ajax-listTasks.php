<?php
require_once("../../controller/init.php");
?>
<?php
$projects = getProjects();
$categories = getChildCategories();
?>
<?php
//Management project+user
if (!empty($_POST['idP'])) {
    $idP = sChamp($_POST['idP']);
    if ($idP != 0) {
        $project = getProjectById($idP);
    } else {
        $project = null;
    }
}
if (!empty($_POST['idU'])) {
    $idU = sChamp($_POST['idU']);
    if ($idU != 0) {
        $user = getUserById($idU);
    } else {
        $user = null;
    }
}
if (!isset($user) && !isset($project)) {
    $tasks = getTasks();
} elseif (isset($user) && !isset($project)) {
    $tasks = getTasksByIdUser($user->getId());
} elseif (isset($project) && !isset($user)) {
    $tasks = getTasksByIdProject($project->getId());
} else {
    $tasks = getTasksByIdUserAndIdProject($user->getId(), $project->getId());
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

//Management category
if (!empty($_POST['idCat'])) {
    $idCat = sChamp($_POST['idCat']);
    if ($idCat != 0) {
        $category = getCategoryById($idCat);
    } else {
        $category = null;
    }
}

if (isset($category)) {
    $tasks1 = array();
    foreach ($tasks as $task) {
        if ($task->getIdCategory() == $category->getId()) {
            $tasks1[] = $task;
        }
    }
    $tasks = $tasks1;
}
?>
<script>
    $("#loadingImage").show();
    $(document).keyup(function (e) {
        if (e.keyCode == 27) { // escape key maps to keycode `27`
            // <DO YOUR WORK HERE>
            document.activeElement.focus();
            document.activeElement.blur();
        }
    });
    function selectRow(taskId) {
        var row = document.getElementById('tr' + taskId);
        row.className = "tableformat";
        $('#tableTasks tr.tableformat').removeClass("tableformat");
        var row = document.getElementById('tr' + taskId);
        row.className = "tableformat";
    }

    function deleteTask(taskId) {
        if (confirm("Etes vous sûr de vouloir supprimer cette tâche?")) {
            var row = document.getElementById('tr' + taskId);
            row.parentNode.removeChild(row);
            $.ajax({
                url: '<?php echo $rooturl ?>pages/task/ajax-deleteTask.php',
                type: 'POST',
                dataType: 'html',
                data: {'taskId': taskId},
                success: function (answer, statut) {
                    $("#task_delete").html(answer);
//                    $("#task_delete").find("script").each(function (i) {;
//                        eval($(this).text());
//                    });
                },

                error: function (resultat, statut, erreur) {

                },

                complete: function (resultat, statut) {

                }

            });
        }
    }

    function updateTask(taskId) {
        var idCat = $("#category" + taskId).val();
        var idUser = $("#userName" + taskId).html();
        var idProj = $("#project" + taskId).val();
        var desc = $("#description" + taskId).html();
        var date = $("#date" + taskId).html();
        var time = $("#time" + taskId).html();
        $.ajax({
            url: '<?php echo $rooturl ?>pages/task/ajax-updateTask.php',
            type: 'POST',
            dataType: 'html',
            data: {'taskId': taskId, 'idUser': idUser, 'idCat': idCat, 'idProj': idProj, 'desc': desc, 'date': date, 'time': time},
            success: function (answer, statut) {
                $("#task_update").html(answer);
            },

            error: function (resultat, statut, erreur) {

            },

            complete: function (resultat, statut) {

            }

        });

    }
    //Sort table onclick <th>
    function sortTable(f, n) {
        var rows = $('#tableTasks  tr').get();
        rows.shift();
        rows.sort(function (a, b) {

            var A = getVal(a);
            var B = getVal(b);

            if (A < B) {
                return -1 * f;
            }
            if (A > B) {
                return 1 * f;
            }
            return 0;
        });

        function getVal(elm) {
            var v = $(elm).children('td').eq(n).text().toUpperCase();
            if ($.isNumeric(v)) {
                v = parseInt(v, 10);
            }
            return v;
        }

        $.each(rows, function (index, row) {
            $('#tableTasks').append(row);
        });
    }

    var f_sl = 1;
    var f_nm = 1;
    $("#userColumn").click(function () {
        f_sl *= -1;
        var n = $(this).prevAll().length;
        sortTable(f_sl, n);
    });
    $("#projectColumn").click(function () {
        f_nm *= -1;
        var n = $(this).prevAll().length;
        sortTable(f_nm, n);
    });


//Detect focusOUT
    var delayedFn, blurredFrom;
    $("td[id*='description']").on('blur', '', function (event) {
        blurredFrom = event.delegateTarget;
        delayedFn = setTimeout(function () {
            var id = event.target.id;
            id = id.replace('description', '');
            updateTask(id);

        }, 0);
    });
    $("td[id*='description']").on('focus', '', function (event) {
        if (blurredFrom === event.delegateTarget) {
            clearTimeout(delayedFn);
        }
    });
    $("td[id*='date']").on('blur', '', function (event) {
        blurredFrom = event.delegateTarget;
        delayedFn = setTimeout(function () {
            var id = event.target.id;
            id = id.replace('date', '');
            updateTask(id);
        }, 0);
    });
    $("td[id*='date']").on('focus', '', function (event) {
        if (blurredFrom === event.delegateTarget) {
            clearTimeout(delayedFn);
        }
    });
    $("td[id*='time']").on('blur', '', function (event) {
        blurredFrom = event.delegateTarget;
        delayedFn = setTimeout(function () {
            var id = event.target.id;
            id = id.replace('time', '');
            updateTask(id);
        }, 0);
    });
    $("td[id*='time']").on('focus', '', function (event) {
        if (blurredFrom === event.delegateTarget) {
            clearTimeout(delayedFn);
        }
    });
    $("select[id*='project']").on('change', function (event) {
        var id = event.target.id;
        id = id.replace('project', '');
        updateTask(id);
    });
    $("select[id*='category']").on('change', function () {
        var id = event.target.id;
        id = id.replace('category', '');
        updateTask(id);
    });
</script>
<div>
    <table id="tableTasks" class="table1">
        <tr>
            <th id="userColumn"><?php echo $txt[$idLang]['task0002'] ?></th><th id="projectColumn"><?php echo $txt[$idLang]['task0003'] ?></th><th id="categoryColumn"><?php echo $txt[$idLang]['task0004'] ?></th><th id="descriptionColumn"><?php echo $txt[$idLang]['task0008'] ?></th><th id="dateColumn"><?php echo $txt[$idLang]['task0005'] ?></th><th id="timeColumn"><?php echo $txt[$idLang]['task0006'] ?></th><th id="deleteColumn"><?php echo $txt[$idLang]['task0010'] ?></th>
        </tr>
        <?php
        foreach ($tasks as $key => $task) {
            $userName = getUserById($task->getIdUser())->getName();
            $projectName = getProjectById($task->getIdProject())->getName();
            $categoryName = getCategoryById($task->getIdCategory())->getName();
            $description = $task->getDescription();
            $date = $task->getDate();
            $time = $task->getTime();
            ?>
            <tr id="tr<?php echo $task->getId() ?>">
                <td id="userName<?php echo $task->getId() ?>" onfocus="selectRow(<?php echo $task->getId() ?>)"><?php echo $userName ?></td>
                <td id="projectName<?php echo $task->getId() ?>" onfocus="selectRow(<?php echo $task->getId() ?>)">
                    <div class="field_container">
                        <select name="project<?php echo $task->getId() ?>" id="project<?php echo $task->getId() ?>">
                            <option value="0"><?php echo $txt[$idLang]['task0001'] ?></option>
                            <?php
                            foreach ($projects as $project) {
                                if ($project->getStatus() == 0) {
                                    ?>
                                    <option value="<?php echo $project->getId(); ?>" <?php
                                    if ($project->getId() == $task->getIdProject()) {
                                        echo "selected='selected'";
                                    }
                                    ?>><?php echo $project->getName(); ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                        </select>
                    </div>
                </td>
                <td id="categoryName<?php echo $task->getId() ?>" style="white-space: nowrap" contenteditable='true' onfocus="selectRow(<?php echo $task->getId() ?>)">
                    <div class="field_container">
                        <select name="category<?php echo $task->getId() ?>"  id="category<?php echo $task->getId() ?>">
                            <option value="0" ><?php echo $txt[$idLang]['task0009'] ?></option>
                            <?php
                            foreach ($categories as $category) {
                                ?>
                                <option value="<?php echo $category->getId(); ?>" <?php
                                if ($category->getId() == $task->getIdCategory()) {
                                    echo "selected='selected'";
                                }
                                ?>><?php echo $category->getName(); ?></option>
                                        <?php
                                    }
                                    ?>
                        </select>
                    </div>
                </td>
                <td id="description<?php echo $task->getId() ?>" contenteditable='true' align="left" onfocus="selectRow(<?php echo $task->getId() ?>)"><?php echo $description ?></td>
                <td id="date<?php echo $task->getId() ?>" contenteditable='true' onfocus="selectRow(<?php echo $task->getId() ?>)"><?php echo $date ?></td>
                <td id="time<?php echo $task->getId() ?>" contenteditable='true' onfocus="selectRow(<?php echo $task->getId() ?>)"><?php echo $time ?></td>
                <td id="delete<?php echo $task->getId() ?>"><a href="#" onclick="deleteTask(<?php echo $task->getId() ?>)" title="<?php echo $txt[$idLang]['basic0012'] ?>" ><img src="<?php echo $urlImg ?>ico-delete-32.png" alt="+" /></a></td>
            </tr>
            <?php
        }
        ?>
    </table>
    <div class="fulldiv" style="display: none;" id="task_delete"></div>
    <div class="fulldiv" style="display: none;" id="task_update"></div>
</div >
<script>
    $("#loadingImage").hide();
    </script>

