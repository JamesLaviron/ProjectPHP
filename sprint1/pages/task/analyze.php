<?php @session_start(); ?><?php ?>
<?php
require_once("../../controller/init.php");
?>
<?php require_once($resspath . "pages/generic/top.php"); ?>
<?php
$tasks = getTasks();
$projects = getProjects();
$users = getUsers();
$categories = getChildCategories();
$currentDate = date('d/m/Y', time());
$yesterday = date("d/m/Y", strtotime("-1 days"));
$primaryCategories = getPrimaryCategories();
?>
<script>
    $(document).ready(function () {
        function changeTask() {
            $("#loadingImage").show();

            var project = document.getElementById('project').value;
            var user = document.getElementById('user').value;
            console.log(user);
            var dateBegin = document.getElementById('dateBegin').value;
            var dateEnd = document.getElementById('dateEnd').value;
            var category = document.getElementById('category').value;

            $.ajax({
                url: '<?php echo $rooturl ?>pages/task/ajax-listTasksAnalyze.php',
                type: 'POST',
                dataType: 'html',
                data: {'idP': project, 'idU': user, 'dateBegin': dateBegin, 'dateEnd': dateEnd, 'idCat': category},
                success: function (answer, statut) {
                    $("#task_content").html(answer);
                    $("#loadingImage").hide();
                },

                error: function (resultat, statut, erreur) {

                },

                complete: function (resultat, statut) {

                }

            });
            $("#loadingImage").hide();
        }
        $(function () {
            $("#dateBegin").datepicker({dateFormat: 'dd/mm/yy'});
            $("#dateEnd").datepicker({dateFormat: 'dd/mm/yy'});
        });
        $('#dateBegin').on('change', function () {
            changeTask();
        });
        $('#dateEnd').on('change', function () {
            changeTask();
        });
        $('#project').on('change', function () {
            $('#user').val(0);
            $('#category').val(0);
            changeTask();
        });
        $('#user').on('change', function () {
            $('#project').val(0);
            $('#category').val(0);
            changeTask();
        });
        $('#category').on('change', function () {
            $('#project').val(0);
            $('#user').val(0);
            changeTask();
        });
    }
    );
</script>

<div id="container-main">
    <div class="centralizer">
        <div class="main breadcrumb mtheader">
            <p><a href="<?php echo $urlDashboardSee ?>"><?php echo $txt[$idLang]['menu0005'] ?></a> - <a href="<?php echo $urlTaskAdd ?>"><?php echo $txt[$idLang]['menu0001'] ?></a> - <a href="<?php echo $urlTaskSee ?>"><?php echo $txt[$idLang]['menu0002'] ?></a> - <a href="<?php echo $urlProjectModify ?>"><?php echo $txt[$idLang]['menu0003'] ?></a> - <a href="<?php echo $urlTaskAnalyze ?>"><b><?php echo $txt[$idLang]['menu0004'] ?></b></a></p>
        </div>
    </div>
</div>
<div id="container-main">
    <div class="centralizer">
        <div class="main">
            <table class="table1">
                <tr><th><?php echo $txt[$idLang]['task0007']; ?></th><th><?php echo $txt[$idLang]['basic0009']; ?></th><th><?php echo $txt[$idLang]['task0002']; ?></th><th><?php echo $txt[$idLang]['task0004']; ?></th></tr> 
                <tr>
                    <td>
                        <div class="field_container">
                            <input type="search" name="dateBegin" id="dateBegin" value="<?php echo $yesterday ?>" <?php if (isset($_POST['validate'])) echo "value='" . $date1 . "'" ?>/>
                        </div>
                        <div class="field_container">
                            <input type="search" name="dateEnd" id="dateEnd" value="<?php echo $currentDate ?>" <?php if (isset($_POST['validate'])) echo "value='" . $date2 . "'" ?>/>
                        </div>
                    </td>
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
            <p id="loadingImage" class="tac dn"> <img src="<?php echo $urlImg ?>loading.gif" /></p>
            <div class="fulldiv" id="task_content"></div>
        </div>	
    </div>
</div>

<?php require_once($resspath . "pages/generic/bottom.php"); ?>
