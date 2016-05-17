<?php

class Gewicht {

    private $id;
    private $tijd;
    private $waarde;
    
    public function __construct($id, $tijd, $waarde) {
        $this->id = $id;
        $this->tijd = $tijd;
        $this->waarde = $waarde;
    }

    public function getId() {
        return $this->id;
    }

    public function getTijd() {
        return $this->tijd;
    }

    public function getWaarde() {
        return $this->waarde;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setTijd($tijd) {
        $this->tijd = $tijd;
    }

    public function setWaarde($waarde) {
        $this->waarde = $waarde;
    }


}
