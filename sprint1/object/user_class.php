<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once($resspath."db/user_db.php");

class User{
    
    private $id;
    private $name;

    
    public function add($id, $name){
        $this->id = $id;
        $this->name = $name;
        alert("create user");
        return insertUser($this);
    }
    
    public function update($id, $name) {
        
        $this->id = $id;
        $this->name = $name;

        return $this->save();
    }
    
    function save() {

        return updateUser($this);
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


}
