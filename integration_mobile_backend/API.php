<?php

include_once 'DAO/PatientDAO.php';
include_once 'DAO/BeheerderDAO.php';
include_once 'DAO/HartslagDAO.php';
include_once 'DAO/GewichtDAO.php';
include_once 'DAO/ValDAO.php';
include_once 'DAO/VerzorgingDAO.php';
include_once 'Validation/ImageHandler.php';

/*
 *  -- REGISTER TEST --
 * $returnvalue = API::register("admin", "ad", "min", "nimda");
 * if(strcmp($returnvalue, "user created") === 0){
 *     echo "succes!";
 * }else{
 *     echo "failure!";
 * }
 */

/*
 * -- LOGIN TEST --
 * $returnvalue = API::login("nieuweUser", "12345");
 * if(strcmp($returnvalue["error"],"") === 0){
 *     echo $returnvalue["userid"];    
 * }else{
 *     echo $returnvalue["error"];
 * }
 */

/*
 *  -- GET PATIENTEN TEST --
 * $returnvalue = API::getPatienten(26);
 * if (strcmp($returnvalue["error"], "") === 0) {
 *     foreach ($returnvalue["values"] as $patient) {
 *         echo $patient->getVoornaam() . " " . $patient->getNaam() . " : " . $patient->getLeeftijd() . " jaar oud- " . $patient->getLengte() . " cm<br>";
 *     }
 * }else{
 *     echo $returnvalue["error"];
 * }
 */
  $returnvalue = API::getPatienten(26);
 if (strcmp($returnvalue["error"], "") === 0) {
     foreach ($returnvalue["values"] as $patient) {
         echo $patient->getVoornaam() . " " . $patient->getNaam() . " : " . $patient->getLeeftijd() . " jaar oud- " . $patient->getLengte() . " cm<br>";
     }
 }else{
     echo $returnvalue["error"];
 }
/*
 *  -- GET HARTSLAG TEST --
 * $returnvalue = API::getHartslag("test");
 * foreach($returnvalue as $hartslag){
 *     echo "op ".$hartslag->getTijd()." hartslag: ".$hartslag->getWaarde()." bpm<br>";
 * }
 */

/*
 *  -- GET GEWICHT TEST --
 * $returnvalue = API::getGewicht("test");
 *  foreach($returnvalue as $gewicht){
 *      echo "op ".$gewicht->getTijd()." gewicht: ".$gewicht->getWaarde()." kg<br>";
 *  }
 */

/*
 * -- GET VAL TEST --
 * $returnvalue = API::getVal("test");
 * foreach($returnvalue as $val){
 *     echo "op ".$val->getTijd()." gevallen<br>";
 * }
 */

/*
 * -- GET PATIENT BY ID TEST --
 * $returnvalue = API::getPatientById("test");
 * if (strcmp($returnvalue["error"], "") === 0) {
 *     $patient = $returnvalue["value"];
 *     echo $patient->getVoornaam() . " " . $patient->getNaam() . " : " . $patient->getLeeftijd() . " jaar oud- " . $patient->getLengte() . " cm<br>";
 * }else{
 *     echo $returnvalue["error"];
}
*/

/*
 * -- REGISTER VERZORGING TEST --
 * $returnvalue = API::registerVerzorging(2, "test");
 * echo $returnvalue["error"];
 */


class API {

    public static function register($gebruikersnaam, $voornaam, $naam, $ww) {
        $beheerders = BeheerderDAO::getAll();

        foreach ($beheerders as $current) {
            if (!strcmp($current->getGebruikersnaam(), $gebruikersnaam)) {
                return "username already exists";
            }
        }
        BeheerderDAO::insert(new Beheerder("", $gebruikersnaam, $voornaam, $naam, $ww));
        return "user created";
    }

    public static function login($gebruikersnaam, $ww) {
        $gebruiker = BeheerderDAO::getByGebruikersnaam($gebruikersnaam);
        if ($gebruiker == false) {
            return array(
                'error' => "no user found",
                'userid' => ""
            );
        }

        if (strcmp($gebruiker->getWachtwoord(), $ww) === 0) {
            return array(
                'error' => "",
                'userid' => $gebruiker->getId()
            );
        } else {
            return array(
                'error' => "password incorrect",
                'userid' => ""
            );
        }
    }
     
    public static function addPatient($id, $naam, $voornaam, $leeftijd, $lengte, $adres, $foto){
        $foto = ImageHandler::uploadImage($foto, $id);
        $patient = new Patient($id, $naam, $voornaam, $leeftijd, $lengte, $adres, $foto);
        PatientDAO::insert($patient);
    }
    
    public static function registerVerzorging($id_mantelzorger, $id_patient){
        $beheerder = self::getBeheerderById($id_mantelzorger);
        $patient = self::getPatientById($id_patient);
        
        if(strcmp($beheerder["error"],"") === 0 && strcmp($patient["error"], "") === 0){
            VerzorgingDAO::insert(new Verzorging($id_mantelzorger,$id_patient));
            return array(
                "error"=>""                
            );
        }else{
            if(strcmp($beheerder["error"],"") === 0 ){
                return array(
                    "error"=>"no patient with given ID"
                );
            }else if(strcmp($patient["error"], "") === 0){
                return array(
                    "error"=>"no caretaker with given ID"
                );                
            }else{
                return array(
                    "error"=>"no caretaker and patient with given ID's"
                );
            }
        }
    }
    
    public static function getPatienten($id_mantelzorger) {
        if (is_numeric($id_mantelzorger)) {
            return array(
                "error" => "",
                "values" => PatientDAO::getByMantelzorgerId($id_mantelzorger)
            );
        } else {
            return array(
                "error" => "non numeric ID",
                "values" => array()
            );
        }
    }

    public static function getPatientById($id_patient) {
        $patient = PatientDAO::getById($id_patient);
        if ($patient == false) {
            return array(
                "error" => "no patient found",
                "value" => ""
            );
        } else {
            return array(
                "error" => "",
                "value" => $patient
            );
        }
    }
    
    public static function getBeheerderById($id_mantelzorger){
        $beheerder = BeheerderDAO::getById($id_mantelzorger);
        if ($beheerder == false) {
            return array(
                "error" => "no patient found",
                "value" => ""
            );
        } else {
            return array(
                "error" => "",
                "value" => $beheerder
            );
        }
    }

    public static function getHartslag($id_patient) {
        return HartslagDAO::getById($id_patient);
    }
    
    public static function addHartslag($id, $tijd, $waarde){
        $hartslag = new Hartslag($id, $tijd, $waarde);
        HartslagDAO::insert($hartslag);
    }

    public static function getGewicht($id_patient) {
        return GewichtDAO::getById($id_patient);
    }

    public static function addGewicht($id, $tijd, $waarde){
        $gewicht = new Gewicht($id, $tijd, $waarde);
        GewichtDAO::insert($gewicht);
    }
    
    public static function getVal($id_patient) {
        return ValDAO::getById($id_patient);
    }
    
    public static function addVal($id, $tijd){
        $val = new Val($id, $tijd);
        ValDAO::insert($val);
    }
}
