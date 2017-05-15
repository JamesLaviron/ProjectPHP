<?php
$users = getUsers();
$projects = getProjects();
//$projects = getProjectsInProgress();
$primaryCategories = getPrimaryCategories();
//Send 'autre' to end of array
foreach ($primaryCategories as $key => $primaryCategory) {
    if ($primaryCategory->getName() == $txt[$idLang]['task0014']) {
        $item = $primaryCategories[$key];
        unset($primaryCategories[$key]);
        array_push($primaryCategories, $item);
        break;
    }
}
$childCategories = getChildCategories();
if (isset($date)) {
    $date = date('d/m/Y', strtotime($date));
}
?>
<script type="text/javascript">

    function sortProjects(userId) {
        
        var sortedProjects = new Array();
        $.ajax({
            url: '<?php echo $rooturl ?>pages/task/ajax-automatisation.php',
            type: 'POST',
            dataType: 'html',
            data: {'idU': userId},
            success: function (data) {
                console.log(data);
                var data = JSON.parse(data);
                $("#projectchange").html(data);
                $('#projectname').empty();
                var newOptions = new Array();
                for (var i = 0; i < data.length; i++) {
                    var dataObject = {
                        id: data[i].idProject,
                        name: data[i].projectName
                    };
                    newOptions[i] = dataObject;
                    var lastProjectId = $('#lastProjectId').val();
                    console.log("lastProjectId: " + lastProjectId);
                    console.log("dataObject.id: " + dataObject.id);
                    if (lastProjectId != null) {
                        if (lastProjectId == dataObject.id) {
                            $('#projectname').append('<option value="' + dataObject.id + '" selected="selected" >' + dataObject.name + '</option>');
                        } else {
                            $('#projectname').append('<option value="' + dataObject.id + '">' + dataObject.name + '</option>');
                        }
                    } else {
                        $('#projectname').append('<option value="' + dataObject.id + '">' + dataObject.name + '</option>');
                    }
                }

            },
            error: function (resultat, statut, erreur) {

            },
            complete: function (resultat, statut) {

            }
        });
    }

    $("#username").on('change', function (event) {
        sortProjects();
    });
<?php if (isset($_POST["validate"]) && isset($_POST['username'])) { ?>
        sortProjects(<?php echo $_POST['username'] ?>);
    <?php } ?>
    </script>
    <form id="task-add" action="" method="post">
        <table cellpadding="s" class="w100">
            <tr>
                <td class="label">
                    <label for='username'><?php echo $txt[$idLang]['basic0003'] ?> <sup>*</sup></label><br />
                    <span  class="field_comment"></span>
                </td>
                <td>
                    <div class="field_container">
                        <select name="username"  id="username" onchange="sortProjects(this.value)">
                            <?php
                            foreach ($users as $user) {
                                if ($user->getStatus() == 0) {
                                    ?>
                                    <option value="<?php echo $user->getId(); ?>" <?php
                        if (isset($_POST['validate']) && $_POST['username'] == $user->getId()) {
                            echo "selected='selected'";
                        } else if (isset($_POST['validate'])) {
                            echo "value='" . getUserById($userId)->getName() . "'";
                        }
                                    ?>><?php echo $user->getName(); ?></option>  
                                            <?php
                                        }
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
                            <?php
                            foreach ($projects as $project) {
                                if ($project->getStatus() == 0) {
                                    ?>
                                    <option value="<?php echo $project->getId(); ?>" <?php
                        if (isset($_POST['validate']) && $_POST['projectname'] == $project->getId()) {
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
                                <option value="<?php echo $i; ?>" <?php
                        if (isset($_POST['validate']) && $_POST['hour'] == $i) {
                            echo "selected='selected'";
                        } else if (isset($_POST['validate'])) {
                            echo "value='" . $hour . "'";
                        }
                                ?>><?php echo $i . " h" ?></option>  
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
                                <option value="<?php echo $i * 15; ?>" <?php
                        if (isset($_POST['validate']) && $_POST['minute'] == $i * 15) {
                            echo "selected='selected'";
                        } else if (isset($_POST['validate'])) {
                            echo "value='" . $minute . "'";
                        }
                                ?>><?php echo $i * 15 . " min" ?></option>  
                                    <?php }
                                    ?>
                        </select>
                    </div>
                </td>
            </tr>
            <?php
            foreach ($primaryCategories as $primaryCategory) {
                $childCategories = getChildCategoriesByIdParent($primaryCategory->getId());
                foreach ($childCategories as $key => $childCategory) {
                    if ($childCategory->getName() == $txt[$idLang]['task0014']) {
                        $item = $childCategories[$key];
                        unset($childCategories[$key]);
                        array_push($childCategories, $item);
                        break;
                    }
                }
                if ($primaryCategory->getId() == 82) {
                    ?>
                    <table class="table1" style="width:11%;display:inline-block; margin:0px; vertical-align: top;" >
                    <?php } elseif ($primaryCategory->getId() == 83) { ?>
                        <table class="table1" style="width:8.5%;display:inline-block; margin:0px; vertical-align: top;" >
                        <?php } else { ?>
                            <table class="table1" style="width:13%;display:inline-block; margin:0px; vertical-align: top;" >
                            <?php }
                            ?>

                            <th> <?php echo $primaryCategory->getName(); ?> </th>
                            <?php
                            foreach ($childCategories as $childCategory) {
                                ?>
                                <tr height="25px"><td style="height:15px;"><input id="rb<?php echo $childCategory->getId(); ?>" type="radio" style='text-align: left' name="childcategory" id="childcategory" value="<?php echo $childCategory->getId(); ?>" checked> <label for="rb<?php echo $childCategory->getId(); ?>"><?php echo $childCategory->getName(); ?></label></td></tr>
                                <?php
                            }
                            ?>
                        </table>
                        <?php
                    }
                    ?>
                    <table style="width:2%;display:inline-block; margin:0px; vertical-align: top;"><!--Table pour remplir en horizontal-->
                    </table>
                    <table class="table1">
                        <tr>
                            <td class="label">
                                <label for='description'><?php echo $txt[$idLang]['basic0007'] ?> <sup></sup></label><br />
                                <span  class="field_comment"></span>
                            </td>
                            <td colspan="2">
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
                    <div class="fulldiv" id="projectchange"></div>
                    <input type="hidden" id="lastProjectId" value="<?php echo (isset($_POST["projectname"])) ? $_POST["projectname"] : null; ?>" />
                <input type="hidden" name="validate" />
                </form>