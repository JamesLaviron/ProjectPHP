<?php

function getTaskById($value) {
    global $connexion, $debug;

    $value = sChamp($value);

    $strQuery = "SELECT * FROM task WHERE id = '$value' LIMIT 1";
    $sth = $connexion->prepare($strQuery);

    if ($debug)
        echo $strQuery;
    $sth->setFetchMode(PDO::FETCH_CLASS, 'Task');

    $sth->execute();
    $pic = $sth->fetch(PDO::FETCH_CLASS);
    $sth->closeCursor();

    return $pic;
}

function getTasksByIdUser($value) {
    global $connexion, $debug;

    $objects = array();
    $value = sChamp($value);

    $strQuery = "SELECT * FROM task WHERE idUser = '$value' ORDER BY idProject DESC";

    if ($debug)
        echo $strQuery;
    
    $sth = $connexion->query($strQuery);

    $sth->setFetchMode(PDO::FETCH_CLASS, 'Task');
    
    while ($obj = $sth->fetch()) {

        $objects[] = $obj;
    }
    
    $sth->closeCursor();
    
    return $objects;
}

function getTasksByIdProject($value) {
    global $connexion, $debug;

    $objects = array();
    $value = sChamp($value);

    $strQuery = "SELECT * FROM task WHERE idProject = '$value' ORDER BY idUser DESC";

    if ($debug)
        echo $strQuery;
    
    $sth = $connexion->query($strQuery);

    $sth->setFetchMode(PDO::FETCH_CLASS, 'Task');
    
    while ($obj = $sth->fetch()) {

        $objects[] = $obj;
    }
    
    $sth->closeCursor();
    
    return $objects;
}

function getTasks() {
    global $connexion, $debug;

    $object = array();

    $strQuery = "SELECT * FROM task";

    if ($debug)
        echo $strQuery;
    
    $sth = $connexion->query($strQuery);

    $sth->setFetchMode(PDO::FETCH_CLASS, 'Task');
    
    while ($obj = $sth->fetch()) {

        $objects[] = $obj;
    }
    
    $sth->closeCursor();
    
    return $objects;
}

function getTasksByIdUserAndIdProject($value1, $value2) {
    global $connexion, $debug;

    $objects = array();
    $value1 = sChamp($value1);
    $value2 = sChamp($value2);

    $strQuery = "SELECT * FROM task WHERE idUser = '$value1' AND idProject = '$value2' ORDER BY date";

    if ($debug)
        echo $strQuery;
    
    $sth = $connexion->query($strQuery);

    $sth->setFetchMode(PDO::FETCH_CLASS, 'Task');
    
    while ($obj = $sth->fetch()) {

        $objects[] = $obj;
    }
    
    $sth->closeCursor();
    
    return $objects;
}



function updateTask($o){
    global $connexion, $debug;
    
    $id = $o->getId();
    $idUser = $o->getIdUser();
    $idProject = $o->getIdProject();
    $idCategory = $o->getIdCategory();
    $description = $o->getDescription();
    $date = $o->getDate();
    $time = $o->getTime();
    
    $strQuery = "UPDATE task SET
        
        idUser = '$idUser',
        idProject = '$idProject',
        idCategory = '$idCategory',
        description = '$description',
        date = '$date',
        time = '$time'

	WHERE id ='$id' ";
    
    if ($debug)
        echo $strQuery;
        
    
    $sth = $connexion->prepare($strQuery);

    $sth->execute();

    return true;
    
}

function insertTask($o){
    global $connexion, $debug;
    
    
    $strQuery = "INSERT INTO task(idUser, idProject, idCategory, description, date, time) VALUES ( '". $o->getIdUser() ."','". $o->getIdProject() ."','". $o->getIdCategory() ."','". $o->getDescription() ."','". $o->getDate() ."','". $o->getTime() ."')";
    
    if ($debug)
        echo $strQuery;
    
    $sth = $connexion->prepare($strQuery);

    $sth->execute();

    return $connexion->lastInsertId();
    
}

function deleteTask($o){
    
    global $connexion, $debug;
    
    $id = $o->getId();
    
    $strQuery = "DELETE FROM task WHERE id = '$id'";

    if ($debug)
        echo $strQuery;

    $sth = $connexion->prepare($strQuery);

    $sth->execute();
    
    return true;
}
