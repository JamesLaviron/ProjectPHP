<?php @session_start(); ?><?php ?>
<?php
require_once("../../controller/init.php");
?>
<?php require_once($resspath . "pages/generic/top.php"); ?>
<?php
$projects = getProjects();
?>
<script>

    function editProject() {
        var element = document.getElementById('project');
        var result = element.value;
        window.location.href = "<?php echo $urlProjectUpdate ?>?id=" + result;
    }

    function deleteProject() {
        var element = document.getElementById('project');
        var result = element.value;
        window.location.href = "<?php echo $urlProjectModify ?>?del=1&id=" + result;
    }

    function finalizeProject() {
        var element = document.getElementById('project');
        var result = element.value;
        window.location.href = "<?php echo $urlProjectModify ?>?fn=1&id=" + result;
    }
    
    function addProject() {
        var element = document.getElementById('name');
        var result = element.value;
        window.location.href = "<?php echo $urlProjectModify ?>?add=1&name=" + result;
    }
</script>
<div id="container-main">
    <div class="centralizer">
        <div class="main breadcrumb mtheader">
            <p><a href="<?php echo $urlDashboardSee ?>"><?php echo $txt[$idLang]['menu0005'] ?></a> - <a href="<?php echo $urlTaskAdd ?>"><?php echo $txt[$idLang]['menu0001'] ?></a> - <a href="<?php echo $urlTaskSee ?>"><?php echo $txt[$idLang]['menu0002'] ?></a> - <a href="<?php echo $urlProjectModify ?>"><b><?php echo $txt[$idLang]['menu0003'] ?></b></a> - <a href="<?php echo $urlTaskAnalyze ?>"><?php echo $txt[$idLang]['menu0004'] ?></a></p>
        </div>
    </div>
</div>
<div id="container-main">
    <div class="centralizer">
        <div class="main">
            <?php
            $action = false;
            $del = false;
            $errors = array();

            //Management project finalize
            if (!empty($_GET['fn'])) {
                if ($_GET['fn'] == 1) {
                    $id = $_GET['id'];
                    $projectSelected = getProjectById($id);
                    $action = $projectSelected->update($id, $projectSelected->getName(), -1);
                    $del = true;
                }
            }

            //Management project delete
            if (!empty($_GET['del']) && !empty($_GET['id'])) {
                if ($_GET['del'] == 1) {
                    $id = $_GET['id'];
                    $projectSelected = getProjectById($id);
                    $action = deleteProject($projectSelected);
                }
            }
            
            //Management project add
            if (!empty($_GET['add']) && !empty($_GET['name'])) {
                if ($_GET['add'] == 1) {
                    $name = $_GET['name'];
                    $newProject = new Project();
                    $action = $newProject->add($name, 0);
                }
            }
            
            if ($action && $del) {
                ?>
                <p class='success'><?php echo $txt[$idLang]['basic0019'] ?></p>

                <?php
                seRendreAenTemps($urlProjectModify, $delayRedirect_inc);
            } elseif ($action && !$del) {
                ?>
                <p class='success'><?php echo $txt[$idLang]['basic0020'] ?></p>

                <?php
                seRendreAenTemps($urlProjectModify, $delayRedirect_inc);
            } elseif ($action && $add) {
                ?>
                <p class='success'><?php echo $txt[$idLang]['basic0023'] ?></p>

                <?php
                seRendreAenTemps($urlProjectModify, $delayRedirect_inc);
            }else {
                require_once ($resspath . "pages/project/modify.php");
            }
            ?>
            <table class="table1">
                <tr><th><?php echo $txt[$idLang]['basic0009']; ?></th><th><?php echo $txt[$idLang]['basic0010']; ?></th></tr> 
                <tr>
                    <td>
                        <div class="field_container">
                            <select name="project"  id="project">
                                <?php
                                foreach ($projects as $project) {
                                    if ($project->getStatus() == 0) {
                                        ?>
                                        <option value="<?php echo $project->getId(); ?>" <?php
                                        if (isset($_POST['validate']) && $_POST['project'] == $project) {
                                            echo "selected='selected'";
                                        } else if (isset($_POST['validate'])) {
                                            echo "value='" . $project . "'";
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
                        <a href="#" onclick="editProject()" title="<?php echo $txt[$idLang]['basic0011'] ?>" ><img src="<?php echo $urlImg ?>ico-edit-32.png" alt="+" /></a>
                        <a href="#" onclick="deleteProject()" title="<?php echo $txt[$idLang]['basic0012'] ?>" ><img src="<?php echo $urlImg ?>ico-delete-32.png" alt="+" /></a>
                        <a href="#" onclick="finalizeProject()" title="<?php echo $txt[$idLang]['basic0013'] ?>" ><img src="<?php echo $urlImg ?>ico-install-32.png" alt="+" /></a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for='name'><?php echo $txt[$idLang]['basic0021'] ?> <sup>:</sup></label><br />
                        <span  class="field_comment"></span>
                        <div class="field_container">
                            <input type="text" name="name" id="name"/>
                        </div>

                    </td>
                    <td>
                        <a href="#" onclick="addProject()" title="<?php echo $txt[$idLang]['basic0022'] ?>" ><img src="<?php echo $urlImg ?>ico-add-32.png" alt="+" /></a>
                    </td>
                </tr>
            </table>
        </div>	
    </div>
</div>

<?php require_once($resspath . "pages/generic/bottom.php"); ?>
