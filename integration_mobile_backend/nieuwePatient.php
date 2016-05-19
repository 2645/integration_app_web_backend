<?php
include_once 'API.php';

if(isset($_POST["naam"])){
   API::addPatient($_POST["id"], $_POST["naam"],$_POST["voornaam"],$_POST["leeftijd"],$_POST["lengte"],$_POST["adres"],$_POST['foto']);
}

?>

