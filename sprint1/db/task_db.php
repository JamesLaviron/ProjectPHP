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

    $object = array();
    $value = sChamp($value);

    $strQuery = "SELECT * FROM task WHERE idUser = '$value' ";

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
        time = '$time';

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