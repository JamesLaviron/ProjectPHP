<?php
if (!empty($tasks)) {
    ?>
    <table class="table1" style="border:none">
        <tr>
            <td align="center" valign="top">
                <table class="table1">
                    <tbody>
                    <th><?php echo $txt[$idLang]['task0011'] ?></th>
                    <tr>
                        <td>
                            <div id ="main-container">
                                <div class="nav">
                                    <ul class="tree">
                                        <?php
                                        foreach ($projects as $project) {
                                            $tasksUsingProject = array();
                                            $cumulateTimeProject = null;
                                            foreach ($tasks as $task) {
                                                $taskProject = getProjectById($task->getIdProject());
                                                if ($taskProject->getId() == $project->getId()) {
                                                    $tasksUsingProject[] = $task;
                                                }
                                            }
                                            foreach ($tasksUsingProject as $taskUsingProject) {
                                                $cumulateTimeProject = $cumulateTimeProject + $taskUsingProject->getTime();
                                            }
                                            if (!empty($tasksUsingProject)) {
                                                ?>
                                                <li><?php echo $project->getName() ?> : <?php echo $cumulateTimeProject ?>
                                                    <ul>
                                                        <?php
                                                        foreach ($primaryCategories as $primaryCategory) {
                                                            $tasksUsingPrimaryCategory = array();
                                                            $cumulateTimePrimaryCategory = null;
                                                            ?>
                                                            <?php
                                                            foreach ($tasksUsingProject as $taskUsingProject) {
                                                                $taskPrimaryCategory = getCategoryById($taskUsingProject->getIdCategory())->getIdParent();
                                                                if ($taskPrimaryCategory == $primaryCategory->getId()) {
                                                                    $tasksUsingPrimaryCategory[] = $taskUsingProject;
                                                                }
                                                            }
                                                            foreach ($tasksUsingPrimaryCategory as $taskUsingPrimaryCategory) {
                                                                $cumulateTimePrimaryCategory = $cumulateTimePrimaryCategory + $taskUsingPrimaryCategory->getTime();
                                                            }
                                                            if (!empty($tasksUsingPrimaryCategory)) {
                                                                ?>
                                                                <li><?php echo $primaryCategory->getName() ?> : <?php echo $cumulateTimePrimaryCategory ?><ul>
                                                                        <?php
                                                                        $categories = getChildCategoriesByIdParent($primaryCategory->getId());
                                                                        foreach ($categories as $category) {
                                                                            $tasksUsingCategory = array();
                                                                            $cumulateTimeCategory = null;
                                                                            ?>
                                                                            <?php
                                                                            if (!empty($categories)) {
                                                                                foreach ($tasksUsingPrimaryCategory as $taskUsingPrimaryCategory) {
                                                                                    if ($taskUsingPrimaryCategory->getIdCategory() == $category->getId()) {
                                                                                        $tasksUsingCategory[] = $taskUsingPrimaryCategory;
                                                                                    }
                                                                                }
                                                                            }
                                                                            foreach ($tasksUsingCategory as $taskUsingCategory) {
                                                                                $cumulateTimeCategory = $cumulateTimeCategory + $taskUsingCategory->getTime();
                                                                            }
                                                                            if (!empty($tasksUsingCategory)) {
                                                                                ?>                                                                            <li><?php echo $category->getName() ?> : <?php echo $cumulateTimeCategory ?></li><?php
                                                                            }
                                                                            ?>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </ul>
                                                                </li>
                                                                <?php
                                                            }
                                                            ?>

                                                            <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                </li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>

                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td align="center" valign="top">
                <table class="table1">
                    <tbody>
                    <th><?php echo $txt[$idLang]['task0012'] ?></th>
                    <tr>
                        <td>
                            <div id ="main-container">
                                <div class="nav">
                                    <ul class="tree">
                                        <?php
                                        foreach ($primaryCategories as $primaryCategory) {
                                            $tasksUsingPrimaryCategory = array();
                                            $cumulateTimePrimaryCategory = null;
                                            foreach ($tasks as $task) {
                                                $taskPrimaryCategory = getCategoryById($task->getIdCategory())->getIdParent();
                                                if ($taskPrimaryCategory == $primaryCategory->getId()) {
                                                    $tasksUsingPrimaryCategory[] = $task;
                                                }
                                            }
                                            foreach ($tasksUsingPrimaryCategory as $taskUsingPrimaryCategory) {
                                                $cumulateTimePrimaryCategory = $cumulateTimePrimaryCategory + $taskUsingPrimaryCategory->getTime();
                                            }
                                            if (!empty($tasksUsingPrimaryCategory)) {
                                                ?>
                                                <li><?php echo $primaryCategory->getName() ?> : <?php echo $cumulateTimePrimaryCategory ?>
                                                    <ul>
                                                        <?php
                                                        $categories = getChildCategoriesByIdParent($primaryCategory->getId());
                                                        foreach ($categories as $category) {
                                                            $tasksUsingCategory = array();
                                                            $cumulateTimeCategory = null;

                                                            foreach ($tasksUsingPrimaryCategory as $taskUsingPrimaryCategory) {

                                                                if ($taskUsingPrimaryCategory->getIdCategory() == $category->getId()) {
                                                                    $tasksUsingCategory[] = $taskUsingPrimaryCategory;
                                                                }
                                                            }
                                                            foreach ($tasksUsingCategory as $taskUsingCategory) {
                                                                $cumulateTimeCategory = $cumulateTimeCategory + $taskUsingCategory->getTime();
                                                            }
                                                            if (!empty($tasksUsingCategory)) {
                                                                ?>
                                                                <li><?php echo $category->getName() ?> : <?php echo $cumulateTimeCategory ?>
                                                                    <ul>
                                                                        <?php
                                                                        foreach ($projects as $project) {
                                                                            $tasksUsingProject = array();
                                                                            $cumulateTimeProject = null;
                                                                            ?>
                                                                            <?php
                                                                            foreach ($tasksUsingCategory as $taskUsingCategory) {
                                                                                if ($taskUsingCategory->getIdProject() == $project->getId()) {
                                                                                    $tasksUsingProject[] = $taskUsingCategory;
                                                                                }
                                                                            }
                                                                            foreach ($tasksUsingProject as $taskUsingProject) {
                                                                                $cumulateTimeProject = $cumulateTimeProject + $taskUsingProject->getTime();
                                                                            }
                                                                            if (!empty($tasksUsingProject)) {
                                                                                ?>                                                                                        <li><?php echo $project->getName() ?> : <?php echo $cumulateTimeProject ?></li>                                          
                                                                                <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </ul>
                                                                </li>
                                                                <?php
                                                            }
                                                            ?>
                                                            <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                </li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <?php ?>
        </tr>
    </table>
    <?php
}
?>
