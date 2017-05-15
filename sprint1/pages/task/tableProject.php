<table id="tableTasks" class="table1">
    <tr>
        <th id="dateColumn"><?php echo $txt[$idLang]['task0005'] ?></th><th id="userColumn"><?php echo $txt[$idLang]['task0002'] ?></th><th id="categoryColumn"><?php echo $txt[$idLang]['task0004'] ?></th><th id="descriptionColumn"><?php echo $txt[$idLang]['task0008'] ?></th><th id="timeColumn"><?php echo $txt[$idLang]['task0006'] ?></th>
    </tr>
    <?php
    foreach ($period as $dateS) {
        $timeS = null;
        $tasksS = array();

        $dateS = $dateS->format('Y-m-d');
        setlocale(LC_ALL, 'fra_fra');
        $dateDay = strftime('%A', strtotime($dateS));

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
            foreach ($users as $user) {
                $tasksUser = array();
                $timeUser = null;
                foreach ($tasksS as $taskS) {
                    if ($taskS->getIdUser() == $user->getId()) {
                        $tasksUser[] = $taskS;
                        $timeUser = $timeUser + $taskS->getTime();
                    }
                }
                if (!empty($tasksUser)) {
                    ?>
                    <tr>
                        <td></td>
                        <td><?php echo $user->getName() ?></td>
                        <td><?php echo $timeUser ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php
                }
                foreach ($tasksUser as $taskUser) {
                    $category = getCategoryById($taskUser->getIdCategory());
                    $primaryCategory = getCategoryById($category->getIdParent());
                    ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><?php echo $primaryCategory->getName() . ": " . $category->getName() ?></td>
                        <td><?php echo $taskUser->getDescription() ?></td>
                        <td><?php echo $taskUser->getTime() ?></td>
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