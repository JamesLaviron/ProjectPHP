<table id="tableTasks" class="table1">
    <tr>
        <th id="dateColumn"><?php echo $txt[$idLang]['task0005'] ?></th><th id="projectColumn"><?php echo $txt[$idLang]['task0003'] ?></th><th id="categoryColumn"><?php echo $txt[$idLang]['task0004'] ?></th><th id="descriptionColumn"><?php echo $txt[$idLang]['task0008'] ?></th><th id="timeColumn"><?php echo $txt[$idLang]['task0006'] ?></th>
    </tr>
    <?php
    foreach ($period as $dateS) {
        
        $dateS = $dateS->format('Y-m-d');
        setlocale(LC_ALL, 'fra_fra');
        $dateDay = strftime('%A', strtotime($dateS));
        $timeS = null;
        $tasksS = array();
        foreach ($tasks as $task) {
            if ($task->getDate() == $dateS) {
                $time = $task->getTime();
                $timeS = $timeS + $time;
                $tasksS[] = $task;
            }
        }
        if (!empty($tasksS)) {
            ?>
            <tr>
                <td id="date" style="white-space: nowrap"><?php echo $dateS . " (" . $dateDay . ")" ?></td>
                <td id="time" style="white-space: nowrap"><?php echo $timeS ?></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <?php
            foreach ($projects as $project) {
                $tasksProject = array();
                $timeProject = null;
                foreach ($tasksS as $taskS) {
                    if ($taskS->getIdProject() == $project->getId()) {
                        $tasksProject[] = $taskS;
                        $timeProject = $timeProject + $taskS->getTime();
                    }
                }
                if (!empty($tasksProject)) {
                    ?>
                    <tr>
                        <td></td>
                        <td><?php echo $project->getName() ?></td>
                        <td><?php echo minToHMS($timeProject) ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php
                }
                foreach ($tasksProject as $taskProject) {
                    ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><?php echo getCategoryById($taskProject->getIdCategory())->getName() ?></td>
                        <td><?php echo $taskProject->getDescription() ?></td>
                        <td><?php echo $taskProject->getTime() ?></td>
                    </tr>
                    <?php
                }
            }
        }
        ?>
        <?php
    }
    ?>
</table>