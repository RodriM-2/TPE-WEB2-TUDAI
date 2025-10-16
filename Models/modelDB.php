<?php

require_once __DIR__ . '/../src/config.php';

abstract class ModelDB {
    protected $db;
    protected $table;
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

        public function GetElements() {
        $sentence= $this->db->prepare("SELECT * FROM {$this->table}");
        $sentence->execute();
        $items= $sentence->fetchAll(PDO::FETCH_OBJ);

        return $items;
    }

        public function RemoveElement($id) {
            $sentence= $this->db->prepare("DELETE FROM {$this->table} WHERE id=?");
            $sentence->execute([$id]);
        }
}

