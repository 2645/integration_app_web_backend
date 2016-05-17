<?php

class Beheerder{
    
    private $id;
    private $gebruikersnaam;
    private $naam;
    private $voornaam;
    private $wachtwoord;
   
    public function __construct($id, $gebruikersnaam, $naam, $voornaam, $wachtwoord) {
        $this->id = $id;
        $this->gebruikersnaam = $gebruikersnaam;
        $this->naam = $naam;
        $this->voornaam = $voornaam;
        $this->wachtwoord = $wachtwoord;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getGebruikersnaam() {
        return $this->gebruikersnaam;
    }

    public function getNaam() {
        return $this->naam;
    }

    public function getVoornaam() {
        return $this->voornaam;
    }

    public function getWachtwoord() {
        return $this->wachtwoord;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setGebruikersnaam($gebruikersnaam) {
        $this->gebruikersnaam = $gebruikersnaam;
    }

    public function setNaam($naam) {
        $this->naam = $naam;
    }

    public function setVoornaam($voornaam) {
        $this->voornaam = $voornaam;
    }

    public function setWachtwoord($wachtwoord) {
        $this->wachtwoord = $wachtwoord;
    }




}