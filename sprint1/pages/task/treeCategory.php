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
                                                        foreach ($projects as $project) {
                                                            $cumulateTimeProject = null;
                                                            $tasksUsingProject = array();
                                                            foreach ($tasksUsingUser as $taskUsingUser) {
                                                                if ($taskUsingUser->getIdProject() == $project->getId()) {
                                                                    $tasksUsingProject[] = $taskUsingUser;
                                                                }
                                                            }
                                                            foreach ($tasksUsingProject as $taskUsingProject) {
                                                                $cumulateTimeProject = $cumulateTimeProject + $taskUsingProject->getTime();
                                                            }
                                                            if (!empty($tasksUsingProject)) {
                                                                ?>
                                                                <li><?php echo $project->getName() ?> : <?php echo $cumulateTimeProject ?></li>
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
                                                        foreach ($users as $user) {
                                                            $cumulateTimeUser = null;
                                                            $tasksUsingUser = array();
                                                            foreach ($tasksUsingProject as $taskUsingProject) {
                                                                if ($taskUsingProject->getIdUser() == $user->getId()) {
                                                                    $tasksUsingUser[] = $taskUsingProject;
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
            <?php
            ?>
        </tr>
    </table>
    <?php
}
?>
