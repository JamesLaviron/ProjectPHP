<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Echeancier{
    
    private $id_tache;
    private $jour;
    private $id_people;
    private $id_project;
    private $action;
    private $duree;
    private $id_ss_categorie;
    
    function add($id_tache, $jour, $id_people, $id_project, $action, $duree, $id_ss_categorie) {
        $this->id_tache = $id_tache;
        $this->jour = $jour;
        $this->id_people = $id_people;
        $this->id_project = $id_project;
        $this->action = $action;
        $this->duree = $duree;
        $this->id_ss_categorie = $id_ss_categorie;
    }
    
    function getId_tache() {
        return $this->id_tache;
    }

    function getJour() {
        return $this->jour;
    }

    function getId_people() {
        return $this->id_people;
    }

    function getId_project() {
        return $this->id_project;
    }

    function getAction() {
        return $this->action;
    }

    function getDuree() {
        return $this->duree;
    }

    function getId_ss_categorie() {
        return $this->id_ss_categorie;
    }

    function setId_tache($id_tache) {
        $this->id_tache = $id_tache;
    }

    function setJour($jour) {
        $this->jour = $jour;
    }

    function setId_people($id_people) {
        $this->id_people = $id_people;
    }

    function setId_project($id_project) {
        $this->id_project = $id_project;
    }

    function setAction($action) {
        $this->action = $action;
    }

    function setDuree($duree) {
        $this->duree = $duree;
    }

    function setId_ss_categorie($id_ss_categorie) {
        $this->id_ss_categorie = $id_ss_categorie;
    }


}
