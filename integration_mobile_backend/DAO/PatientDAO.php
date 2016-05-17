<?php
//Kopieer deze template en pas deze aan naargelang de benodigde functionaliteit
include_once 'Model/Patient.php';
include_once 'DAO/Verbinding/DatabaseFactory.php';

class PatientDAO {

    private static function getVerbinding() {
        return DatabaseFactory::getDatabase();
    }

    public static function getAll() {
        $resultaat = self::getVerbinding()->voerSqlQueryUit("SELECT * FROM patienten");
        $resultatenArray = array();
        for ($index = 0; $index < $resultaat->num_rows; $index++) {
            $databaseRij = $resultaat->fetch_array();
            $nieuw = self::converteerRijNaarObject($databaseRij);
            $resultatenArray[$index] = $nieuw;
        }
        return $resultatenArray;
    }


    public static function getById($id) {
        $resultaat = self::getVerbinding()->voerSqlQueryUit("SELECT * FROM patienten WHERE id='?'", array($id));
        if ($resultaat->num_rows == 1) {
            $databaseRij = $resultaat->fetch_array();
            return self::converteerRijNaarObject($databaseRij);
        } else {
            //Er is waarschijnlijk iets mis gegaan
            return false;
        }
    }
    
    public static function getByMantelzorgerId($id){
        $resultaat = self::getVerbinding()->voerSqlQueryUit("select * from patienten p JOIN verzorging v ON p.id = v.id_patient WHERE v.id_mantelzorger = ?", array($id));
        $resultatenArray = array();
        for ($index = 0; $index < $resultaat->num_rows; $index++) {
            $databaseRij = $resultaat->fetch_array();
            $nieuw = self::converteerRijNaarObject($databaseRij);
            $resultatenArray[$index] = $nieuw;
        }
        return $resultatenArray;
    }

    public static function insert($patient) {
        return self::getVerbinding()->voerSqlQueryUit("INSERT INTO patienten(id, naam, voornaam, leeftijd, lengte, adres, foto) VALUES ('?','?','?','?','?','?','?')", array($patient->getId(), $patient->getNaam(), $patient->getVoornaam(), $patient->getLeeftijd(), $patient->getLengte(), $patient->getAdres(), $patient->getFoto()));
    }

    public static function deleteById($id) {
        return self::getVerbinding()->voerSqlQueryUit("DELETE FROM patienten where id=?", array($id));
    }

    public static function delete($patient) {
        return self::deleteById($patient->getId());
    }

    public static function update($patient) {
        return self::getVerbinding()->voerSqlQueryUit("UPDATE patient SET naam='?',voornaam='?', leeftijd='?', lengte='?', adres='?', foto='?' WHERE id=?", array($patient->getNaam(), $patient->getVoornaam(), $patient->getLeeftijd(), $patient->getLengte(), $patient->getAdres(), $patient->getFoto(), $patient->getId()));
    }

    protected static function converteerRijNaarObject($databaseRij) {
        return new Patient($databaseRij['id'], $databaseRij['naam'], $databaseRij['voornaam'], $databaseRij['leeftijd'], $databaseRij['lengte'], $databaseRij['adres'], $databaseRij['foto']);
    }

}
