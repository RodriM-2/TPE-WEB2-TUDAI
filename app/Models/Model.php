<?php

require_once 'DBDeploy.php';

abstract class Model {

    protected $db;
    protected $table;

    public function __construct() {
        $this->db= new ModelDB();
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