<?php @session_start(); ?><?php ?>
<?php
require_once("../../controller/init.php");
?>
<?php require_once($resspath . "pages/generic/top.php"); ?>
<?php
$projects = getProjects();
?>
<script>    
    
    function editProject(){
        var element = document.getElementById('project');   
        var result = element.value;
        window.location.href = "<?php echo $urlProjectUpdate ?>?id="+result;
    }
    
    function deleteProject(){
        var element = document.getElementById('project');   
        var result = element.value;
        window.location.href = "<?php echo $urlProjectModify ?>?del=1&id="+result;
    }
    
    function finalizeProject(){
        var element = document.getElementById('project');   
        var result = element.value;
        window.location.href = "<?php echo $urlProjectModify ?>?fn=1&id="+result;
    }
</script>
<div id="container-main">
    <div class="centralizer">
        <div class="main breadcrumb mtheader">
            <p><a href="<?php echo $urltaskSee ?>"><?php echo $txt[$idLang]['basic0001'] ?></a> > <?php echo $txt[$idLang]['basic0014']; ?></p>
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

            if ($action && $del) {
                ?>
                <p class='success'><?php echo $txt[$idLang]['basic0019'] ?></p>

                <?php
                seRendreAenTemps($urlProjectModify, $delayRedirect_inc);
            } elseif($action && !$del){
                                ?>
                <p class='success'><?php echo $txt[$idLang]['basic0020'] ?></p>

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
                                    echo "value='" . $projectC . "'";
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
            </table>
        </div>	
    </div>
</div>

<?php require_once($resspath . "pages/generic/bottom.php"); ?>
