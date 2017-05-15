<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once($resspath."db/task_db.php");

class Task{
    
    private $id;
    private $idUser;
    private $idProject;
    private $idCategory;
    private $description;
    private $date;
    private $time;

    function add( $idUser, $idProject, $idCategory, $description, $date, $time) {

        $this->idUser = $idUser;
        $this->idProject = $idProject;
        $this->idCategory = $idCategory;
        $this->description = $description;
        $this->date = $date;
        $this->time = $time;
        
        return insertTask($this);
    }
    
    public function update($id, $idUser, $idProject, $idCategory, $description, $date, $time) {
        
        $this->id = $id;
        $this->idUser = $idUser;
        $this->idProject = $idProject;
        $this->idCategory = $idCategory;
        $this->description = $description;
        $this->date = $date;
        $this->time = $time;

        return $this->save();
    }
    
    public function delete(){
        deleteTask($this);
    }
    
    function save() {

        return updateTask($this);
    }
    
    function getId() {
        return $this->id;
    }

    function getIdUser() {
        return $this->idUser;
    }

    function getIdProject() {
        return $this->idProject;
    }

    function getIdCategory() {
        return $this->idCategory;
    }

    function getDescription() {
        return $this->description;
    }

    function getDate() {
        return $this->date;
    }

    function getTime() {
        return $this->time;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIdUser($idUser) {
        $this->idUser = $idUser;
    }

    function setIdProject($idProject) {
        $this->idProject = $idProject;
    }

    function setIdCategory($idCategory) {
        $this->idCategory = $idCategory;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setDate($date) {
        $this->date = $date;
    }

    function setTime($time) {
        $this->time = $time;
    }

}
