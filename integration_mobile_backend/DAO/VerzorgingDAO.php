<?php
//Kopieer deze template en pas deze aan naargelang de benodigde functionaliteit
include_once 'Model/Verzorging.php';
include_once 'DAO/Verbinding/DatabaseFactory.php';

class VerzorgingDAO {

    private static function getVerbinding() {
        return DatabaseFactory::getDatabase();
    }

    public static function getAll() {
        $resultaat = self::getVerbinding()->voerSqlQueryUit("SELECT * FROM verzorging");
        $resultatenArray = array();
        for ($index = 0; $index < $resultaat->num_rows; $index++) {
            $databaseRij = $resultaat->fetch_array();
            $nieuw = self::converteerRijNaarObject($databaseRij);
            $resultatenArray[$index] = $nieuw;
        }
        return $resultatenArray;
    }
    

    public static function insert($verzorging) {
        return self::getVerbinding()->voerSqlQueryUit("INSERT INTO verzorging(id_mantelzorger, id_patient) VALUES ('?','?')", array( $verzorging->getId_mantelzorger(), $verzorging->getId_patient()));
    }

    public static function deleteById($id_mantelzorger, $id_patient) {
        return self::getVerbinding()->voerSqlQueryUit("DELETE FROM mantelzorger where id_mantelzorger=? AND id__patient=?", array($id_mantelzorger, $id_patient));
    }

    protected static function converteerRijNaarObject($databaseRij) {
        return new Verzorging($databaseRij['id_mantelzorger'], $databaseRij['id_patient']);
    }

}
