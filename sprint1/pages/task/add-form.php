<?php
$users = getUsers();
$projects = getProjects();
//$projects = getProjectsInProgress();
$primaryCategories = getPrimaryCategories();
$childCategories = getChildCategories();
?>

<form id="task-add" action="" method="post">
    <table cellpadding="s" class="w100">
        <tr>
            <td class="label">
                <label for='username'><?php echo $txt[$idLang]['basic0003'] ?> <sup>*</sup></label><br />
                <span  class="field_comment"></span>
            </td>
            <td>
                <div class="field_container">
                    <select name="username"  id="username">
                        <?php foreach ($users as $user) {
                            ?>
                            <option value="<?php echo $user->getId(); ?>" <?php
                            if (isset($_POST['validate']) && $_POST['username'] == $user->getName()) {
                                echo "selected='selected'";
                            } else if (isset($_POST['validate'])) {
                                echo "value='" . getUserById($userId)->getName() . "'";
                            }
                            ?>><?php echo $user->getName(); ?></option>  
                                    <?php
                                }
                                ?>                            
                    </select>
                </div>

            </td>
            <td class="label">
                <label for='projectname'><?php echo $txt[$idLang]['basic0004'] ?> <sup>*</sup></label><br />
                <span  class="field_comment"></span>
            </td>
            <td>
                <div class="field_container">
                    <select name="projectname"  id="projectname">
                        <?php foreach ($projects as $project) {
                            ?>
                            <option value="<?php echo $project->getId(); ?>" <?php
                            if (isset($_POST['validate']) && $_POST['projectname'] == $project->getId()) {
                                echo "selected='selected'";
                            } else if (isset($_POST['validate'])) {
                                echo "value='" . getProjectById($projectId)->getName() . "'";
                            }
                            ?>><?php echo $project->getName(); ?></option>  
                                    <?php
                                }
                                ?>                            
                    </select>
                </div>

            </td>
        </tr>
        <tr>
            <td class="label">
                <label for='date'><?php echo $txt[$idLang]['basic0005'] ?> <sup>*</sup></label><br />
                <span  class="field_comment"></span>
            </td>
            <td>
                <div class="field_container">
                    <input type="text" name="date" id="date" <?php if (isset($_POST['validate'])) echo "value='" . $date . "'" ?>/>
                </div>
            </td>
            <td class="label">
                <label for='hour'><?php echo $txt[$idLang]['basic0006'] ?> <sup>*</sup></label><br />
                <span  class="field_comment"></span>
            </td>
            <td>
                <div class="field_container">
                    <select name="hour"  id="hour">
                        <?php for ($i = 0; $i <= 14; $i++) {
                            ?>
                            <option value="<?php echo $i; ?>" <?php if (isset($_POST['validate']) && $_POST['hour'] == $i) {
                            echo "selected='selected'";
                        } else if (isset($_POST['validate'])) {
                            echo "value='" . $hour . "'";
                        } ?>><?php echo $i . " h" ?></option>  
    <?php }
?>
                        </
                </div>
            </td>
            <td>
                <div class="field_container">
                    <select name="minute"  id="minute">
                        <?php for ($i = 0; $i <= 3; $i++) {
                            ?>
                            <option value="<?php echo $i * 15; ?>" <?php if (isset($_POST['validate']) && $_POST['minute'] == $i * 15) {
                                echo "selected='selected'";
                            } else if (isset($_POST['validate'])) {
                                echo "value='" . $minute . "'";
                            } ?>><?php echo $i * 15 . " min" ?></option>  
                    <?php }
                ?>
                    </select>
                </div>
            </td>
        </tr>
        <table class="table1">
            <tr>
                    <?php foreach ($primaryCategories as $primaryCategory) { ?>
                    <th> <?php echo $primaryCategory->getName(); ?> </th>
                    <?php } ?>
            </tr>
            <tr>
                    <?php
                    foreach ($primaryCategories as $primaryCategory) {
                        ?><td>
                        <?php
                    foreach ($childCategories as $childCategory) {
                        if ($childCategory->getIdParent() == $primaryCategory->getId()) {
                            ?>
                                <input type="radio" name="childcategory" id="childcategory" value="<?php echo $childCategory->getId(); ?>" checked> <?php echo $childCategory->getName(); ?><br/>
            <?php
        }
    }
    ?></td>
    <?php
}
?>
            </tr>
        </table>
        <tr>
            <td class="label">
                <label for='description'><?php echo $txt[$idLang]['basic0007'] ?> <sup></sup></label><br />
                <span  class="field_comment"></span>
            </td>
            <td>
                <div class="field_container">
                    <input type="text" name="description" id="description" <?php if (isset($_POST['validate'])) echo "value='" . $description . "'" ?>/>
                </div>

            </td>
        </tr>
        <script>
            $(function () {
                $("#date").datepicker({dateFormat: 'dd/mm/yy'});
            });
        </script>
    </table>
    <input type="hidden" name="validate" />
</form>