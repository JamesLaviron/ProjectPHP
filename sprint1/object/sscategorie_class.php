<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Ss_categorie{
    
    private $id_sscategorie;
    private $id_categorie;
    private $nm_sscategorie;
    private $aide;
    private $id_cardinal;
    
    function add($id_sscategorie, $id_categorie, $nm_sscategorie, $aide, $id_cardinal) {
        $this->id_sscategorie = $id_sscategorie;
        $this->id_categorie = $id_categorie;
        $this->nm_sscategorie = $nm_sscategorie;
        $this->aide = $aide;
        $this->id_cardinal = $id_cardinal;
    }
    
    function getId_sscategorie() {
        return $this->id_sscategorie;
    }

    function getId_categorie() {
        return $this->id_categorie;
    }

    function getNm_sscategorie() {
        return $this->nm_sscategorie;
    }

    function getAide() {
        return $this->aide;
    }

    function getId_cardinal() {
        return $this->id_cardinal;
    }

    function setId_sscategorie($id_sscategorie) {
        $this->id_sscategorie = $id_sscategorie;
    }

    function setId_categorie($id_categorie) {
        $this->id_categorie = $id_categorie;
    }

    function setNm_sscategorie($nm_sscategorie) {
        $this->nm_sscategorie = $nm_sscategorie;
    }

    function setAide($aide) {
        $this->aide = $aide;
    }

    function setId_cardinal($id_cardinal) {
        $this->id_cardinal = $id_cardinal;
    }


}

