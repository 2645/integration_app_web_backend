<?php
//Kopieer deze template en pas deze aan naargelang de benodigde functionaliteit
include_once 'Model/Hartslag.php';
include_once 'DAO/Verbinding/DatabaseFactory.php';

class HartslagDAO {

    private static function getVerbinding() {
        return DatabaseFactory::getDatabase();
    }

    public static function getAll() {
        $resultaat = self::getVerbinding()->voerSqlQueryUit("SELECT * FROM hartslag");
        $resultatenArray = array();
        for ($index = 0; $index < $resultaat->num_rows; $index++) {
            $databaseRij = $resultaat->fetch_array();
            $nieuw = self::converteerRijNaarObject($databaseRij);
            $resultatenArray[$index] = $nieuw;
        }
        return $resultatenArray;
    }
    public static function getById($id){
        $resultaat = self::getVerbinding()->voerSqlQueryUit("SELECT * FROM hartslag where id='?'",array($id));
        $resultatenArray = array();
        for ($index = 0; $index < $resultaat->num_rows; $index++) {
            $databaseRij = $resultaat->fetch_array();
            $nieuw = self::converteerRijNaarObject($databaseRij);
            $resultatenArray[$index] = $nieuw;
        }
        return $resultatenArray;
    }

    public static function insert($hartslag) {
        return self::getVerbinding()->voerSqlQueryUit("INSERT INTO hartslag(id, hartslag, tijd) VALUES ('?','?','?')", array( $hartslag->getId(), $hartslag->getWaarde(), $hartslag->getTijd()));
    }

    public static function deleteById($id) {
        return self::getVerbinding()->voerSqlQueryUit("DELETE FROM hartslag where id=?", array($id));
    }

    protected static function converteerRijNaarObject($databaseRij) {
        return new Hartslag($databaseRij['id'], $databaseRij['tijd'], $databaseRij['hartslag']);
    }

}
