<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once($resspath."db/project_db.php");

class Project{
    
    private $id;
    private $name;
    private $status;

    
    public function add($id, $name, $status){
        $this->id = $id;
        $this->name = $name;
        $this->status = $status;
        
        return insertProject($this);
    }
    
    public function update($id, $name, $status) {
        
        $this->id = $id;
        $this->name = $name;
        $this->status = $status;

        return $this->save();
    }
    
    function save() {

        return updateProject($this);
    }
    
    function getId() {
        return $this->id;
    }
    
    function getName() {
        return $this->name;
    }
    
    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function getStatus() {
        return $this->status;
    }

    function setStatus($status) {
        $this->status = $status;
    }

}
