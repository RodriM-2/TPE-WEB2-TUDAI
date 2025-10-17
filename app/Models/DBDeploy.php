<?php

require_once __DIR__ . '/../../src/config.php';

class ModelDB {
    protected $db;
    public function __construct() {
        $this->db = new PDO(
    "mysql:host=".MYSQL_HOST.
         ";dbname=".MYSQL_DB.";charset=utf8", 
MYSQL_USER, MYSQL_PASS);
        $this->_deploy();
    }
    private function _deploy() {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        if(count($tables) == 0) {
            $sql =<<<END
            END;
        $this->db->query($sql);
        }
    }

    //Function para que redirija todos los $this->db de las clases hijas
    public function __call(string $name, array $arguments) {
        return call_user_func_array([$this->db, $name], $arguments);
    }
}

