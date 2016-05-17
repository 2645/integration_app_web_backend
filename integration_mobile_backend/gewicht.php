<?php
include_once 'API.php';
if(isset($_POST["id"]) && isset($_POST["tijd"]) && isset($_POST["waarde"])){
    API::addGewicht($_POST["id"], $_POST["tijd"], $_POST["waarde"]);
}

