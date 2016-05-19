<?php
include_once 'API.php';
if(isset($_POST["id_mantelzorger"])&&isset($_POST["id_patient"])){
    API::registerVerzorging($_POST["id_mantelzorger"], $_POST["id_patient"]);
}
