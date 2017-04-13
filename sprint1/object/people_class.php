<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class People{
    
    private $id_people;
    private $nm_people;

    function add($id_people, $nm_people) {
        $this->id_people = $id_people;
        $this->nm_people = $nm_people;
    }
    
    function getId_people() {
        return $this->id_people;
    }

    function getNm_people() {
        return $this->nm_people;
    }

    function setId_people($id_people) {
        $this->id_people = $id_people;
    }

    function setNm_people($nm_people) {
        $this->nm_people = $nm_people;
    }


}
