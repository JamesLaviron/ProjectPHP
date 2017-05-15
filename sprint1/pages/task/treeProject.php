<?php
if (!empty($tasks)) {
    ?>
    <table class="table1" style="">
        <tr>
            <td align="center" valign="top">
                <table class="table1">
                    <tbody>
                    <th><?php echo $txt[$idLang]['task0013'] ?></th>
                    <tr>
                        <td>
                            <div id ="main-container">
                                <div class="nav">
                                    <ul class="tree">
                                        <?php
                                        foreach ($users as $user) {
                                            $tasksUsingUser = array();
                                            $cumulateTimeUser = null;
                                            foreach ($tasks as $task) {
                                                $taskUser = getUserById($task->getIdUser());
                                                if ($taskUser->getId() == $user->getId()) {
                                                    $tasksUsingUser[] = $task;
                                                }
                                            }
                                            foreach ($tasksUsingUser as $taskUsingUser) {
                                                $cumulateTimeUser = $cumulateTimeUser + $taskUsingUser->getTime();
                                            }
                                            if (!empty($tasksUsingUser)) {
                                                ?>
                                                <li><?php echo $user->getName() ?> : <?php echo $cumulateTimeUser ?>
                                                    <ul>
                                                        <?php
                                                        foreach ($primaryCategories as $primaryCategory) {
                                                            $tasksUsingPrimaryCategory = array();
                                                            $cumulateTimePrimaryCategory = null;
                                                            foreach ($tasksUsingUser as $taskUsingUser) {
                                                                $taskPrimaryCategory = getCategoryById($taskUsingUser->getIdCategory())->getIdParent();
                                                                if ($taskPrimaryCategory == $primaryCategory->getId()) {
                                                                    $tasksUsingPrimaryCategory[] = $taskUsingUser;
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
                                                                                ?>                                                                                                                       <li><?php echo $category->getName() ?> : <?php echo $cumulateTimeCategory ?></li>
                                                                                <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </ul>
                                                                </li>
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
                                                                        foreach ($users as $user) {
                                                                            $tasksUsingUser = array();
                                                                            $cumulateTimeUser = null;

                                                                            foreach ($tasksUsingCategory as $taskUsingCategory) {
                                                                                if ($taskUsingCategory->getIdUser() == $user->getId()) {
                                                                                    $tasksUsingUser[] = $taskUsingCategory;
                                                                                }
                                                                            }
                                                                            foreach ($tasksUsingUser as $taskUsingUser) {
                                                                                $cumulateTimeUser = $cumulateTimeUser + $taskUsingUser->getTime();
                                                                            }
                                                                            if (!empty($tasksUsingUser)) {
                                                                                ?>
                                                                                <li><?php echo $user->getName() ?> : <?php echo $cumulateTimeUser ?></li>
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
