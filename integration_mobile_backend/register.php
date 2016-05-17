<?php

include_once 'API.php';

if (isset($_POST["gebruikersnaam"]) && isset($_POST["naam"]) && isset($_POST["voornaam"]) && isset($_POST["wachtwoord"])) {
    $gebruikersnaam = $_POST["gebruikersnaam"];
    $naam = $_POST["naam"];
    $voornaam = $_POST["voornaam"];
    $wachtwoord = $_POST["wachtwoord"];
    return API::register($gebruikersnaam, $voornaam, $naam, $wachtwoord);
}
return "please enter a value for all fields";




