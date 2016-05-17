<?php

include_once 'API.php';

if (isset($_POST["gebruikersnaam"]) && isset($_POST["wachtwoord"])) {
    $gebruikersnaam = $_POST["gebruikersnaam"];
    $wachtwoord = $_POST["wachtwoord"];
    $loginData = API::login($gebruikersnaam, $wachtwoord);
    echo json_encode($loginData);
} else {
    echo json_encode(array(
    "error" => "please enter username and password",
    "userid" => ""
    ));
}

