<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Projects{
    
    private $id_project;
    private $nm_project;
    private $isActif;
    
    function add($id_project, $nm_project, $isActif) {
        $this->id_project = $id_project;
        $this->nm_project = $nm_project;
        $this->isActif = $isActif;
    }
    
    function getId_project() {
        return $this->id_project;
    }

    function getNm_project() {
        return $this->nm_project;
    }

    function getIsActif() {
        return $this->isActif;
    }

    function setId_project($id_project) {
        $this->id_project = $id_project;
    }

    function setNm_project($nm_project) {
        $this->nm_project = $nm_project;
    }

    function setIsActif($isActif) {
        $this->isActif = $isActif;
    }

}