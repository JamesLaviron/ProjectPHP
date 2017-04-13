<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function getCategorie(){
    global $connexion, $debug;

    $objects = array();
    
    $strQuery = "SELECT * FROM categorie";
    $sth = $connexion->prepare($strQuery);

    if ($debug)
        echo $strQuery;
    
    $sth = $connexion->query($strQuery);

    $sth->setFetchMode(PDO::FETCH_CLASS, 'Categorie');
    
    while ($obj = $sth->fetch()) {

        $objects[] = $obj;
    }
    
    $sth->closeCursor();
    
    return $objects;
}

function getPeople(){
    global $connexion, $debug;

    $objects = array();
    
    $strQuery = "SELECT * FROM people";
    $sth = $connexion->prepare($strQuery);

    if ($debug)
        echo $strQuery;
    
    $sth = $connexion->query($strQuery);

    $sth->setFetchMode(PDO::FETCH_CLASS, 'People');
    
    while ($obj = $sth->fetch()) {

        $objects[] = $obj;
    }
    
    $sth->closeCursor();
    
    return $objects;
}

function getEcheancier(){
    global $connexion, $debug;

    $objects = array();
    
    $strQuery = "SELECT * FROM echeancier";
    $sth = $connexion->prepare($strQuery);

    if ($debug)
        echo $strQuery;
    
    $sth = $connexion->query($strQuery);

    $sth->setFetchMode(PDO::FETCH_CLASS, 'Echeancier');
    
    while ($obj = $sth->fetch()) {

        $objects[] = $obj;
    }
    
    $sth->closeCursor();
    
    return $objects;
}

function getSscategorie(){
    global $connexion, $debug;

    $objects = array();
    
    $strQuery = "SELECT * FROM sscategorie";
    $sth = $connexion->prepare($strQuery);

    if ($debug)
        echo $strQuery;
    
    $sth = $connexion->query($strQuery);

    $sth->setFetchMode(PDO::FETCH_CLASS, 'Ss_categorie');
    
    while ($obj = $sth->fetch()) {

        $objects[] = $obj;
    }
    
    $sth->closeCursor();
    
    return $objects;
}

function getProjectsold(){
    global $connexion, $debug;

    $objects = array();
    
    $strQuery = "SELECT * FROM projects";
    $sth = $connexion->prepare($strQuery);

    if ($debug)
        echo $strQuery;
    
    $sth = $connexion->query($strQuery);

    $sth->setFetchMode(PDO::FETCH_CLASS, 'Projects');
    
    while ($obj = $sth->fetch()) {

        $objects[] = $obj;
    }
    
    $sth->closeCursor();
    
    return $objects;
}
