<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once($resspath."db/category_db.php");

class Category{
    
    private $id;
    private $name;
    private $cardinal;
    private $idParent;

    
    public function add( $id, $name, $cardinal = 0 , $idParent = ''){
        
        $this->id = $id;
        $this->name = $name;
        $this->cardinal = $cardinal;
        $this->idParent = $idParent;
        
        return insertCategory($this);
    }
    
    public function add2( $name, $cardinal = 0 , $idParent = ''){
        
        $this->name = $name;
        $this->cardinal = $cardinal;
        $this->idParent = $idParent;
        
        return insertCategory2($this);
    }
    
    public function update($id, $name, $cardinal, $idParent) {
        
        $this->id = $id;
        $this->name = $name;
        $this->cardinal = $cardinal;
        $this->idParent = $idParent;

        return $this->save();
    }
    
    function save() {

        return updateCategory($this);
    }
    
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getIdParent() {
        return $this->idParent;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setIdParent($idParent) {
        $this->idParent = $idParent;
    }
    
    function getCardinal() {
        return $this->cardinal;
    }

    function setCardinal($cardinal) {
        $this->cardinal = $cardinal;
    }

}
