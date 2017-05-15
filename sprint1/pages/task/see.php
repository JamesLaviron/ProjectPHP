<?php @session_start(); ?><?php ?>
<?php
require_once("../../controller/init.php");
?>
<?php require_once($resspath . "pages/generic/top.php"); ?>
<?php
$tasks = getTasks();
$projects = getProjects();
$users = getUsers();
$primaryCategories = getPrimaryCategories();
$categories = getChildCategories();
$currentDate = date('d/m/Y', time());
?>
<script>
    $(document).ready(function () {
        function changeTask() {
            var project = document.getElementById('project').value;
            var user = document.getElementById('user').value;
            var dateBegin = document.getElementById('dateBegin').value;
            var dateEnd = document.getElementById('dateEnd').value;
            var category = document.getElementById('category').value;

            $.ajax({
                url: '<?php echo $rooturl ?>pages/task/ajax-listTasks.php',
                type: 'POST',
                dataType: 'html',
                data: {'idP': project, 'idU': user, 'dateBegin': dateBegin, 'dateEnd': dateEnd, 'idCat': category},
                success: function (answer, statut) {
                    $("#task_content").html(answer);
                    $("#task_content").find("script").each(function (i) {
                        eval($(this).text());
                    });
                },

                error: function (resultat, statut, erreur) {

                },

                complete: function (resultat, statut) {

                }
            });
        }
        $(function () {
            $("#dateBegin").datepicker({dateFormat: 'dd/mm/yy'});
            $("#dateEnd").datepicker({dateFormat: 'dd/mm/yy'});
        });
        $('#project').on('change', function () {
            changeTask();
        });
        $('#user').on('change', function () {
            changeTask();
        });
        $('#dateBegin').on('change', function () {
            changeTask();
        });
        $('#dateEnd').on('change', function () {
            changeTask();
        });
        $('#category').on('change', function () {
            changeTask();
        });
    }
    );
</script>

<div id="container-main">
    <div class="centralizer">
        <div class="main breadcrumb mtheader">
            <p><a href="<?php echo $urlDashboardSee ?>"><?php echo $txt[$idLang]['menu0005'] ?></a> - <a href="<?php echo $urlTaskAdd ?>"><?php echo $txt[$idLang]['menu0001'] ?></a> - <a href="<?php echo $urlTaskSee ?>"><b><?php echo $txt[$idLang]['menu0002'] ?></b></a> - <a href="<?php echo $urlProjectModify ?>"><?php echo $txt[$idLang]['menu0003'] ?></a> - <a href="<?php echo $urlTaskAnalyze ?>"><?php echo $txt[$idLang]['menu0004'] ?></a></p>
        </div>
    </div>
</div>
<div id="container-main">
    <div class="centralizer">
        <div class="main">
            <table class="table1">
                <tr><th><?php echo $txt[$idLang]['basic0009']; ?></th><th><?php echo $txt[$idLang]['basic0010']; ?></th><th><?php echo $txt[$idLang]['task0007']; ?></th><th><?php echo $txt[$idLang]['task0004']; ?></th></tr> 
                <tr>
                    <td>
                        <div class="field_container">
                            <select name="project"  id="project">
                                <option value="0"><?php echo $txt[$idLang]['task0001'] ?></option>
                                <?php
                                foreach ($projects as $project) {
                                    if ($project->getStatus() == 0) {
                                        ?>
                                        <option value="<?php echo $project->getId(); ?>" <?php
                                        if (isset($_POST['validate']) && $_POST['project'] == $project) {
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
                    <td>
                        <div class="field_container">
                            <select name="user"  id="user">
                                <option value="0" ><?php echo $txt[$idLang]['task0001'] ?></option>
                                <?php
                                foreach ($users as $user) {
                                    if ($user->getStatus() == 0) {
                                        ?>
                                        <option value="<?php echo $user->getId(); ?>"><?php echo $user->getName(); ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                    <td>
                        <div class="field_container">
                            <input type="search" name="dateBegin" id="dateBegin" value="<?php echo $currentDate ?>" <?php if (isset($_POST['validate'])) echo "value='" . $date1 . "'" ?>/>
                        </div>
                        <div class="field_container">
                            <input type="search" name="dateEnd" id="dateEnd" <?php if (isset($_POST['validate'])) echo "value='" . $date2 . "'" ?>/>
                        </div>
                    </td>
                    <td>
                        <div class="field_container">
                            <select name="category"  id="category">
                                <option value="0" ><?php echo $txt[$idLang]['task0009'] ?></option>
                                <?php
                                foreach ($primaryCategories as $primaryCategory) {
                                    $categories = getChildCategoriesByIdParent($primaryCategory->getId());
                                    ?>
                                    <optgroup label="<?php echo $primaryCategory->getName() ?>">
                                        <?php
                                        foreach ($categories as $key => $category) {
                                            if ($category->getName() == $txt[$idLang]['task0014']) {
                                                $item = $categories[$key];
                                                unset($categories[$key]);
                                                array_push($categories, $item);
                                                break;
                                            }
                                        }
                                        foreach ($categories as $category) {
                                                ?>
                                                <option value="<?php echo $category->getId(); ?>"><?php echo $category->getName(); ?></option>
                                                <?php
                                        }
                                        ?>
                                    </optgroup>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
            </table>
            <div class="se-pre-con"></div>
            <div class="fulldiv" id="task_content"></div>
        </div>	
    </div>
</div>

<?php require_once($resspath . "pages/generic/bottom.php"); ?>
