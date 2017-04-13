<?php

function getUserById($value) {
    global $connexion, $debug;

    $value = sChamp($value);

    $strQuery = "SELECT * FROM user WHERE id = '$value' LIMIT 1";
    $sth = $connexion->prepare($strQuery);

    if ($debug)
        echo $strQuery;
    $sth->setFetchMode(PDO::FETCH_CLASS, 'User');

    $sth->execute();
    $pic = $sth->fetch(PDO::FETCH_CLASS);
    $sth->closeCursor();

    return $pic;
}

function getUserByName($value) {
    global $connexion, $debug;

    $value = sChamp($value);

    $strQuery = "SELECT * FROM user WHERE name = '$value' LIMIT 1";
    $sth = $connexion->prepare($strQuery);

    if ($debug)
        echo $strQuery;
    $sth->setFetchMode(PDO::FETCH_CLASS, 'User');

    $sth->execute();
    $pic = $sth->fetch(PDO::FETCH_CLASS);
    $sth->closeCursor();

    return $pic;
}

function getUsers() {
    global $connexion, $debug;

    $objects = array();
    
    $strQuery = "SELECT * FROM user";
    $sth = $connexion->prepare($strQuery);

    if ($debug)
        echo $strQuery;
    
    $sth = $connexion->query($strQuery);

    $sth->setFetchMode(PDO::FETCH_CLASS, 'User');
    
    while ($obj = $sth->fetch()) {

        $objects[] = $obj;
    }
    
    $sth->closeCursor();
    
    return $objects;
}

function updateUser($o){
    global $connexion, $debug;
    
    $id = $o->getId();
    $name = $o->getName();
    
    $strQuery = "UPDATE user SET
        
        name ='$name'

	WHERE id ='$id' ";
    
    if ($debug)
        echo $strQuery;
    
    $sth = $connexion->prepare($strQuery);

    $sth->execute();

    return true;
    
}

function insertUser($o){
    global $connexion, $debug;
    
    
    $strQuery = "INSERT INTO user(id, name) VALUES ( '". $o->getId() ."','". $o->getName() ."')";
    
    if ($debug)
        echo $strQuery;
    
    $sth = $connexion->prepare($strQuery);

    $sth->execute();
    alert("create user in dB");
    return $connexion->lastInsertId();
    
}