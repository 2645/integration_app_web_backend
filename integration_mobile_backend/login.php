<?php

include_once 'API.php';

if (isset($_POST["gebruikersnaam"]) && isset($_POST["wachtwoord"])) {
    $gebruikersnaam = $_POST["gebruikersnaam"];
    $wachtwoord = $_POST["wachtwoord"];
    return API::login($gebruikersnaam, $wachtwoord);
}
return array(
    "error"=>"please enter username and password",
    "userid"=>""
);

