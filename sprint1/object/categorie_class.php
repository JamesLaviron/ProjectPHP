<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once($resspath."db/oldecheancier_db.php");

class Categorie{
    
    private $id_categorie;
    private $nm_categorie;
    
    function add($id_categorie, $nm_categorie) {
        $this->id_categorie = $id_categorie;
        $this->nm_categorie = $nm_categorie;
    }

    
    function getId_categorie() {
        return $this->id_categorie;
    }

    function getNm_categorie() {
        return $this->nm_categorie;
    }

    function setId_categorie($id_categorie) {
        $this->id_categorie = $id_categorie;
    }

    function setNm_categorie($nm_categorie) {
        $this->nm_categorie = $nm_categorie;
    }
}

