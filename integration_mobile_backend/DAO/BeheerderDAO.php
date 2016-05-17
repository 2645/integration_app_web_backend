<?php
//Kopieer deze template en pas deze aan naargelang de benodigde functionaliteit
include_once 'Model/Beheerder.php';
include_once 'DAO/Verbinding/DatabaseFactory.php';

class BeheerderDAO {

    private static function getVerbinding() {
        return DatabaseFactory::getDatabase();
    }

    public static function getAll() {
        $resultaat = self::getVerbinding()->voerSqlQueryUit("SELECT * FROM mantelzorger");
        $resultatenArray = array();
        for ($index = 0; $index < $resultaat->num_rows; $index++) {
            $databaseRij = $resultaat->fetch_array();
            $nieuw = self::converteerRijNaarObject($databaseRij);
            $resultatenArray[$index] = $nieuw;
        }
        return $resultatenArray;
    }


    public static function getById($id) {
        $resultaat = self::getVerbinding()->voerSqlQueryUit("SELECT * FROM mantelzorger WHERE id=?", array($id));
        if ($resultaat->num_rows == 1) {
            $databaseRij = $resultaat->fetch_array();
            return self::converteerRijNaarObject($databaseRij);
        } else {
            //Er is waarschijnlijk iets mis gegaan
            return false;
        }
    }
    
    public static function getByGebruikersnaam($gebruikersnaam) {
        $resultaat = self::getVerbinding()->voerSqlQueryUit("SELECT * FROM mantelzorger WHERE gebruikersnaam='?'", array($gebruikersnaam));
        if ($resultaat->num_rows == 1) {
            $databaseRij = $resultaat->fetch_array();
            return self::converteerRijNaarObject($databaseRij);
        } else {
            //Er is waarschijnlijk iets mis gegaan
            return false;
        }
    }

    public static function insert($beheerder) {
        return self::getVerbinding()->voerSqlQueryUit("INSERT INTO mantelzorger(gebruikersnaam, naam, voornaam, wachtwoord) VALUES ('?','?','?','?')", array( $beheerder->getGebruikersnaam(), $beheerder->getNaam(), $beheerder->getVoornaam(), $beheerder->getWachtwoord()));
    }

    public static function deleteById($id) {
        return self::getVerbinding()->voerSqlQueryUit("DELETE FROM mantelzorger where id=?", array($id));
    }

    public static function delete($beheerder) {
        return self::deleteById($beheerder->getId());
    }

    public static function update($beheerder) {
        return self::getVerbinding()->voerSqlQueryUit("UPDATE patient SET gebruikersnaam = '?' ,naam='?',voornaam='?',wachtwoord='?' WHERE id=?", array($beheerder->getGebruikersnaam(), $beheerder->getNaam(), $beheerder->getVoornaam(), $beheerder->getWachtwoord(), $beheerder->getId()));
    }

    protected static function converteerRijNaarObject($databaseRij) {
        return new Beheerder($databaseRij['id'], $databaseRij['gebruikersnaam'], $databaseRij['naam'], $databaseRij['voornaam'], $databaseRij['wachtwoord']);
    }

}
