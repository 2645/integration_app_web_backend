<?php

//Kopieer deze template en pas deze aan naargelang de benodigde functionaliteit
include_once 'Model/Gewicht.php';
include_once 'DAO/Verbinding/DatabaseFactory.php';

class GewichtDAO {

    private static function getVerbinding() {
        return DatabaseFactory::getDatabase();
    }

    public static function getAll() {
        $resultaat = self::getVerbinding()->voerSqlQueryUit("SELECT * FROM gewicht");
        $resultatenArray = array();
        for ($index = 0; $index < $resultaat->num_rows; $index++) {
            $databaseRij = $resultaat->fetch_array();
            $nieuw = self::converteerRijNaarObject($databaseRij);
            $resultatenArray[$index] = $nieuw;
        }
        return $resultatenArray;
    }

    public static function getById($id) {
        $resultaat = self::getVerbinding()->voerSqlQueryUit("SELECT * FROM gewicht where id='?'", array($id));
        $resultatenArray = array();
        for ($index = 0; $index < $resultaat->num_rows; $index++) {
            $databaseRij = $resultaat->fetch_array();
            $nieuw = self::converteerRijNaarObject($databaseRij);
            $resultatenArray[$index] = $nieuw;
        }
        return $resultatenArray;
    }

    public static function insert($gewicht) {
        return self::getVerbinding()->voerSqlQueryUit("INSERT INTO gewicht(id, gewicht, tijd) VALUES ('?','?','?')", array($gewicht->getId(), $gewicht->getWaarde(), $gewicht->getTijd()));
    }

    public static function deleteById($id) {
        return self::getVerbinding()->voerSqlQueryUit("DELETE FROM gewicht where id=?", array($id));
    }

    protected static function converteerRijNaarObject($databaseRij) {
        return new Gewicht($databaseRij['id'], $databaseRij['tijd'], $databaseRij['gewicht']);
    }

}
