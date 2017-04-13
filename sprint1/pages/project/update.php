<?php @session_start(); ?><?php ?>
<?php
require_once("../../controller/init.php");
?>
<?php require_once($resspath . "pages/generic/top.php"); ?>
<?php
$projects = getProjects();
$id = sChamp($_REQUEST['id']);
$project = getprojectById($id);
?>
<script>
    $(document).ready(function () {
        $("#project-rename-button").click(function () {

            $("#project-rename").submit();
        });
    }
    );
</script>
<div id="container-main">
    <div class="centralizer">
        <div class="main breadcrumb mtheader">
            <p><a href="<?php echo $urltaskSee ?>"><?php echo $txt[$idLang]['basic0001'] ?></a> > <a href="<?php echo $urlProjectModify ?>"><?php echo $txt[$idLang]['basic0014']; ?></a> > <?php echo getProjectById($id)->getName(); ?></p>
        </div>
    </div>
</div>
<div id="container-main">
    <div class="centralizer">
        <div class="main">
            <?php
            //Management change name of projects
            $action = false;
            $errors = array();
            if (isset($_POST['validate'])) {
                $name = sChamp($_POST['name']);
                $id = sChamp($_POST['id']);

                $nameG = strlen($name) >= 1;

                $projectSelected = getProjectById($id);

                if ($nameG) {
                    $action = $projectSelected->update($id, $name, $project->getStatus());
                } else {

                    //Affichage messages erreurs (avant form)
                    if (!$nameG) {
                        $errors[] = $txt[$idLang]['error0002'];
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
                <p class='success'><?php echo $txt[$idLang]['basic0018'] ?></p>

                <?php
                seRendreAenTemps($urlProjectModify, $delayRedirect_inc);
            }
            ?>

            <form id="project-rename" action="" method="post">
                <table cellpadding="2" class="w100">
                    <tr>
                        <td class="label">
                            <label for='name'><?php echo $txt[$idLang]['basic0016'] ?> <sup>*</sup></label><br />
                            <span  class="field_comment"></span>
                        </td>
                        <td>
                            <div class="field_container">
                                <input type="text" name="name" id="name" <?php if (isset($_POST['validate'])) echo "value='" . $name . "'" ?>/>
                            </div>
                        </td>
                    </tr>
                    <input type="hidden"  name="id" id="id" value="<?php echo $id; ?>">
                </table>
                <input type="hidden" name="validate" />
            </form>
        </div>	
    </div>
</div>
<div id="action_bottomright">
    <a href="#" id="project-rename-button" title="<?php echo $txt[$idLang]['basic0017'] ?>" ><img src="<?php echo $urlImg ?>ico-send-64.png" alt="+" /></a>
</div>
<?php require_once($resspath . "pages/generic/bottom.php"); ?>

