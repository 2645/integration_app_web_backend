<?php

class Verzorging{
    private $id_mantelzorger;
    private $id_patient;
    
    public function __construct($id_mantelzorger, $id_patient) {
        $this->id_mantelzorger = $id_mantelzorger;
        $this->id_patient = $id_patient;
    }
    
    public function getId_mantelzorger() {
        return $this->id_mantelzorger;
    }

    public function getId_patient() {
        return $this->id_patient;
    }

    public function setId_mantelzorger($id_mantelzorger) {
        $this->id_mantelzorger = $id_mantelzorger;
    }

    public function setId_patient($id_patient) {
        $this->id_patient = $id_patient;
    }



}

