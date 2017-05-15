<?php @session_start(); ?><?php ?>
<?php
require_once("../../controller/init.php");
require_once($resspath . "pages/generic/top.php");

//$projects = getProjectsold();
//$peoples = getPeople();
//$categories = getCategorie();
//$echeanciers = getEcheancier();
//$sscategories = getSscategorie();

//foreach($projects as $project){
//    $projectN = new Project();
//    $projectN->add($project->getId_project(), $project->getNm_project(), $project->getIsActif()-1);
//}
//foreach($peoples as $people){
//    $user = new User();
//    $user->add($people->getId_people(), $people->getNm_people());
//}
//foreach($echeanciers as $echeancier){
//    $str_time = $echeancier->getDuree();
//    $str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $str_time);
//    sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
//    $time_minute = $hours * 60 + $minutes;
//    
//    $task = new Task();
//    $task->add($echeancier->getId_people(), $echeancier->getId_project(), $echeancier->getId_ss_categorie(), $echeancier->getAction(), $echeancier->getJour(), $time_minute);
//}
//foreach($sscategories as $sscategorie){
//    $category = new Category();
//    $category->add($sscategorie->getId_sscategorie(), $sscategorie->getNm_sscategorie(), $sscategorie->getId_cardinal(), $sscategorie->getId_categorie());
//}
//
//foreach($categories as $categorie){
//    $category = new Category();
//    $category->add2($categorie->getNm_categorie(), 0, 0);
//}
$tasks = getTasks();
foreach($tasks as $task){
    if($task->getIdCategory() == 0){
        $task->setIdCategory(37);
        $task->update($task->getId(), $task->getIdUser(), $task->getIdProject(), $task->getIdCategory(), $task->getDescription(), $task->getDate(), $task->getTime());
    }
}
?>



<?php require_once($resspath . "pages/generic/bottom.php"); ?>