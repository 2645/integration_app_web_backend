<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include_once 'DAO/PatientDAO.php';
        include_once 'Model/Patient.php';
        include_once 'DAO/BeheerderDAO.php';
        include_once 'Model/Beheerder.php';
        include_once 'DAO/VerzorgingDAO.php';
        include_once 'Model/Verzorging.php';
        include_once 'DAO/HartslagDAO.php';
        include_once 'Model/Hartslag.php';
        include_once 'DAO/GewichtDAO.php';
        include_once 'Model/Gewicht.php';
        ?>
        
        <form method="POST" action="nieuwePatient.php"  enctype="multipart/form-data">
            <input type="text" name="id">
            <br>
            <input type="text" name="voornaam">
            <br>
            <input type="text" name="naam">
            <br>
            <input type="text" name="leeftijd">
            <br>
            <input type="text" name="lengte">
            <br>
            <input type="text" name="adres">
            <br>
            <input type="file" name="foto">   
            <br>
            <input type="submit">

        </form>
    </body>
</html>
