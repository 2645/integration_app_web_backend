<?php

class Val{
    private $id;
    private $tijd;
    
    public function __construct($id, $tijd) {
        $this->id = $id;
        $this->tijd = $tijd;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getTijd() {
        return $this->tijd;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setTijd($tijd) {
        $this->tijd = $tijd;
    }
}