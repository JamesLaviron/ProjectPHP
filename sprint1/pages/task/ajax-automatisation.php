<?php
require_once("../../controller/init.php");
?>
<?php
$userId = $_POST["idU"];
$projects = getProjectsInProgress();
$tasks = getTasksByIdUser($userId);
$orderProjects = array();
//Manage projects displaying 
foreach ($projects as $project) {
    $incProject = null;
    foreach ($tasks as $task) {
        $date = str_replace('/', '-', $task->getDate());
        $date = date('Y-m-d', strtotime($date));
        $dateToCompare = date('Y-m-d', strtotime('-7 days', strtotime("now")));
        if ($task->getIdProject() == $project->getId() && $date > $dateToCompare) {
            $incProject++;
        }
    }
    $object = new stdClass();
    $object->idProject = $project->getId();
    $object->inc = $incProject;
    $object->projectName = $project->getName();
    $orderProjects[] = $object;
}
function compare_inc($a, $b) { // Make sure to give this a more meaningful name!
    return $b->inc - $a->inc;
}
usort($orderProjects, 'compare_inc');

$projectsSorted = array();
foreach ($orderProjects as $key=>$orderProject) {
    $projectSorted = new stdClass();
    $value = $orderProjects[$key]->idProject;
    $projectSorted->idProject = getProjectById($value)->getId();
    $projectSorted->projectName = getProjectById($value)->getName();
    $projectSorted->inc = $orderProject->inc;
    $projectsSorted[] = $projectSorted;
}
$projectsNotUsed = array();
$keyFirst = null;
foreach($projectsSorted as $key=>$projectSorted){
    if($projectSorted->inc == 0){
       $keyFirst = $key;
       break;
    }
}
foreach($projectsSorted as $key=>$projectSorted){
    if($projectSorted->inc == 0){
       $projectsNotUsed[] = $projectSorted;
    }
}
function compare_name($a, $b) { // Make sure to give this a more meaningful name!
    return strcmp($a->projectName, $b->projectName);
}
usort($projectsNotUsed,'compare_name');
//print_r($projectsNotUsed);
$projectsSorted = array_slice($projectsSorted, 0, $keyFirst);
$projectsSorted = array_merge( $projectsSorted, $projectsNotUsed);
//echo json_encode($projectsSorted);
echo json_encode($projectsSorted);
?>
<?php
