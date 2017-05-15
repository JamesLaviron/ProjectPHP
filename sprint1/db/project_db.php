<?php

function getProjectById($value) {
    global $connexion, $debug;

    $value = sChamp($value);

    $strQuery = "SELECT * FROM project WHERE id = '$value' LIMIT 1";
    $sth = $connexion->prepare($strQuery);

    if ($debug)
        echo $strQuery;
    $sth->setFetchMode(PDO::FETCH_CLASS, 'Project');

    $sth->execute();
    $pic = $sth->fetch(PDO::FETCH_CLASS);
    $sth->closeCursor();

    return $pic;
}

function getProjectByName($value) {
    global $connexion, $debug;

    $value = sChamp($value);

    $strQuery = "SELECT * FROM project WHERE name = '$value' LIMIT 1";
    $sth = $connexion->prepare($strQuery);

    if ($debug)
        echo $strQuery;
    $sth->setFetchMode(PDO::FETCH_CLASS, 'Project');

    $sth->execute();
    $pic = $sth->fetch(PDO::FETCH_CLASS);
    $sth->closeCursor();

    return $pic;
}

function getProjects() {
    global $connexion, $debug;

    $objects = array();
        
    $strQuery = "SELECT * FROM project ORDER BY name ASC";
    $sth = $connexion->prepare($strQuery);

    if ($debug)
        echo $strQuery;
    
    $sth = $connexion->query($strQuery);

    $sth->setFetchMode(PDO::FETCH_CLASS, 'Project');
    
    while ($obj = $sth->fetch()) {

        $objects[] = $obj;
    }
    
    $sth->closeCursor();
    
    return $objects;
}

function getProjectsInProgress() {
    global $connexion, $debug;

    $objects = array();

    $strQuery = "SELECT * FROM project WHERE status = 0 ORDER BY name ASC";
    $sth = $connexion->prepare($strQuery);

    if ($debug)
        echo $strQuery;
    
    $sth = $connexion->query($strQuery);

    $sth->setFetchMode(PDO::FETCH_CLASS, 'Project');
    
    while ($obj = $sth->fetch()) {

        $objects[] = $obj;
    }
    
    $sth->closeCursor();
    
    return $objects;
}

function updateProject($o){
    global $connexion, $debug;
    
    $id = $o->getId();
    $name = $o->getName();
    $status = $o->getStatus();
    
    $strQuery = "UPDATE project SET
        
        name ='$name',
	status ='$status'

	WHERE id ='$id' ";
    
    if ($debug)
        echo $strQuery;
    
    $sth = $connexion->prepare($strQuery);

    $sth->execute();

    return true;
    
}

function insertProject($o){
    global $connexion, $debug;
    
    $strQuery = "INSERT INTO project( name, status) VALUES ('". $o->getName() ."','". $o->getStatus() ."')";
    
    if ($debug)
        echo $strQuery;
    
    $sth = $connexion->prepare($strQuery);

    $sth->execute();

    return $connexion->lastInsertId();
    
}

function deleteProject($o){
    
    global $connexion, $debug;
    
    $id = $o->getId();
    $name = $o->getName();
    
    $strQuery = "UPDATE project SET
        
        name ='$name',
	status = '-10'

	WHERE id ='$id' ";

    if ($debug)
        echo $strQuery;

    $sth = $connexion->prepare($strQuery);

    $sth->execute();
    
    return true;
}