<?php

    class UserModel {
        private $db;
        private $table= 'usuarios';

        function __construct() {
            $this->db= new PDO("mysql:host=".MYSQL_HOST.
            ";dbname=".MYSQL_DB.";charset=utf8", 
            MYSQL_USER, MYSQL_PASS);
        }

        function getByUsername($user) {
            $task= $this->db->prepare("SELECT * FROM {$this->table} WHERE username= ?");
            $task->execute([$user]);
            $user= $task->fetch(PDO::FETCH_OBJ);

            return $user;
        }

        function insert($name, $password) {
            $task = $this->db->prepare("INSERT INTO {$this->table}}(username,password) VALUES(?,?)");
            $task->execute([$name, $password]);

            return $this->db->lastInsertId();
    }
    }