<?php

/**
 * Raccourci PDO.
 * @author Hugo Heneault et Thomas Lorenzin
 *
 */
class MyPDO
{
    private static $_instance, $_nbQuery = 0, $_allQuery = '';
    private $_PDOInstance = null;

    //Construction de MyPDO
    private function __construct()
    {
        $this->_PDOInstance = new PDO(SQL_DSN, SQL_USER, SQL_PASS);
        if (defined('SQL_ENCODE')) {
            $this->_PDOInstance->exec('SET NAMES '.SQL_ENCODE);
        }
    }

    //Appel de l'instance de PDO
    public static function get()
    {
        if(is_null(self::$_instance)) {
            self::$_instance = new MyPDO();
        }
        return self::$_instance;
    }

    public function prepare($query)
    {
        self::$_allQuery .= $query.'<br />';
        self::$_nbQuery++;
        $prepare = $this->_PDOInstance->prepare($query);
        // Définition du mode fetch par défaut
        $prepare->setFetchMode(PDO::FETCH_ASSOC);
        return $prepare;
    }

    public function lastInsertId()
    {
        return $this->_PDOInstance->lastInsertId();
    }

    public static function getNbQuery()
    {
       return self::$_nbQuery;
    }

    public static function getAllQuery()
    {
        return self::$_allQuery;
    }
}
