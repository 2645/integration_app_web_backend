<?php

//Kopieer deze template en pas deze aan naargelang de benodigde functionaliteit
include_once 'Model/Val.php';
include_once 'DAO/Verbinding/DatabaseFactory.php';

class ValDAO {

    private static function getVerbinding() {
        return DatabaseFactory::getDatabase();
    }

    public static function getAll() {
        $resultaat = self::getVerbinding()->voerSqlQueryUit("SELECT * FROM val");
        $resultatenArray = array();
        for ($index = 0; $index < $resultaat->num_rows; $index++) {
            $databaseRij = $resultaat->fetch_array();
            $nieuw = self::converteerRijNaarObject($databaseRij);
            $resultatenArray[$index] = $nieuw;
        }
        return $resultatenArray;
    }

    public static function getById($id) {
        $resultaat = self::getVerbinding()->voerSqlQueryUit("SELECT * FROM val where id='?'", array($id));
        $resultatenArray = array();
        for ($index = 0; $index < $resultaat->num_rows; $index++) {
            $databaseRij = $resultaat->fetch_array();
            $nieuw = self::converteerRijNaarObject($databaseRij);
            $resultatenArray[$index] = $nieuw;
        }
        return $resultatenArray;
    }

    public static function insert($val) {
        return self::getVerbinding()->voerSqlQueryUit("INSERT INTO val(id, tijd) VALUES ('?','?')", array($val->getId(), $val->getTijd()));
    }

    public static function deleteById($id) {
        return self::getVerbinding()->voerSqlQueryUit("DELETE FROM val where id=?", array($id));
    }

    protected static function converteerRijNaarObject($databaseRij) {
        return new Val($databaseRij['id'], $databaseRij['tijd']);
    }

}
