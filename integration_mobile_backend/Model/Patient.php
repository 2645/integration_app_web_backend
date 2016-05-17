<?php

class Patient {

    private $id;
    private $naam;
    private $voornaam;
    private $leeftijd;
    private $lengte;
    private $adres;
    private $foto;
    
    public function __construct($id, $naam, $voornaam, $leeftijd, $lengte, $adres, $foto) {
        $this->id = $id;
        $this->naam = $naam;
        $this->voornaam = $voornaam;
        $this->leeftijd = $leeftijd;
        $this->lengte = $lengte;
        $this->adres = $adres;
        $this->foto = $foto;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getNaam() {
        return $this->naam;
    }

    public function getVoornaam() {
        return $this->voornaam;
    }

    public function getLeeftijd() {
        return $this->leeftijd;
    }

    public function getLengte() {
        return $this->lengte;
    }

    public function getAdres() {
        return $this->adres;
    }
    
    public function getFoto(){
        return $this->foto;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNaam($naam) {
        $this->naam = $naam;
    }

    public function setVoornaam($voornaam) {
        $this->voornaam = $voornaam;
    }

    public function setLeeftijd($leeftijd) {
        $this->leeftijd = $leeftijd;
    }

    public function setLengte($lengte) {
        $this->lengte = $lengte;
    }

    public function setAdres($adres) {
        $this->adres = $adres;
    }
    public function setFoto($foto){
        $this->foto = $foto;
    }
}
