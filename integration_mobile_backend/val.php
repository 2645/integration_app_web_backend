<?php
include_once 'API.php';
if(isset($_POST["id"]) && isset($_POST["tijd"])){
    API::addHartslag($_POST["id"], $_POST["tijd"]);
}

