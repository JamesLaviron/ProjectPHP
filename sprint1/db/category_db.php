<?php

function getCategoryById($value) {
    global $connexion, $debug;

    $value = sChamp($value);

    $strQuery = "SELECT * FROM category WHERE id = '$value' LIMIT 1";
    $sth = $connexion->prepare($strQuery);

    if ($debug)
        echo $strQuery;
    $sth->setFetchMode(PDO::FETCH_CLASS, 'Category');

    $sth->execute();
    $pic = $sth->fetch(PDO::FETCH_CLASS);
    $sth->closeCursor();

    return $pic;
}

function getPrimaryCategories() {
    global $connexion, $debug;

    $objects = array();
        

    $strQuery = "SELECT * FROM category WHERE idParent = 0 ";
    $sth = $connexion->prepare($strQuery);

    if ($debug)
        echo $strQuery;
    
    $sth = $connexion->query($strQuery);

    $sth->setFetchMode(PDO::FETCH_CLASS, 'Category');
    
    while ($obj = $sth->fetch()) {

        $objects[] = $obj;
    }
    
    $sth->closeCursor();
    
    return $objects;
}

function getChildCategories() {
    global $connexion, $debug;
    
    $objects = array();


    $strQuery = "SELECT * FROM category WHERE idParent != 0 ";
    $sth = $connexion->prepare($strQuery);

    if ($debug)
        echo $strQuery;
    
    $sth = $connexion->query($strQuery);

    $sth->setFetchMode(PDO::FETCH_CLASS, 'Category');
    
    while ($obj = $sth->fetch()) {

        $objects[] = $obj;
    }
    
    $sth->closeCursor();
    
    return $objects;
}

function getCategoryByName($value) {
    global $connexion, $debug;

    $value = sChamp($value);

    $strQuery = "SELECT * FROM category WHERE name = '$value' LIMIT 1";
    $sth = $connexion->prepare($strQuery);

    if ($debug)
        echo $strQuery;
    $sth->setFetchMode(PDO::FETCH_CLASS, 'Category');

    $sth->execute();
    $pic = $sth->fetch(PDO::FETCH_CLASS);
    $sth->closeCursor();

    return $pic;
}

function updateCategory($o){
    global $connexion, $debug;
    
    $id = $o->getId();
    $name = $o->getName();
    $idParent = $o->getIdParent();
    
    $strQuery = "UPDATE category SET
        
        name ='$name',
	idParent ='$idParent'

	WHERE id ='$id' ";
    
    if ($debug)
        echo $strQuery;
    
    $sth = $connexion->prepare($strQuery);

    $sth->execute();

    return true;
    
}

function insertCategory($o){
    global $connexion, $debug;
    
    $strQuery = "INSERT INTO category( id, name, cardinal, idParent) VALUES ( '". $o->getId() ."','". $o->getName() ."','". $o->getCardinal() ."','". $o->getIdParent() ."')";
    
    if ($debug)
        echo $strQuery;
    
    $sth = $connexion->prepare($strQuery);

    $sth->execute();

    return $connexion->lastInsertId();
    
}

function insertCategory2($o){
    global $connexion, $debug;
    
    $strQuery = "INSERT INTO category( name, cardinal, idParent) VALUES ( '". $o->getName() ."','". $o->getCardinal() ."','". $o->getIdParent() ."')";
    
    if ($debug)
        echo $strQuery;
    
    $sth = $connexion->prepare($strQuery);

    $sth->execute();

    return $connexion->lastInsertId();
    
}