<?php

    require_once 'Model.php';
    class ItemModel extends Model{

       protected $table='gatos';

        public function GetItem($request) {
            $sentence= $this->db->prepare("SELECT * FROM {$this->table} WHERE id_gato=?");
            $sentence->execute([$request->id]);
            $gato= $sentence->fetch(PDO::FETCH_OBJ);

            return $gato;
        }

        public function GetItemsByCategory($request) {
            $sentence= $this->db->prepare("SELECT * FROM {$this->table} WHERE id_peluquero=?");
            $sentence->execute([$request->id]);
            $gatos= $sentence->fetchAll(PDO::FETCH_OBJ);

            return $gatos;
        }

        public function AddItem($nombre,$edad,$raza,$color,$peso,$observaciones,$peluquero) {
            $sentence=$this->db->prepare("INSERT INTO {$this->table}(nombre,edad_meses,raza,color,peso_kg,observaciones,id_peluquero) VALUES (?,?,?,?,?,?,?)");
            $sentence->execute([$nombre,$edad,$raza,$color,$peso,$observaciones,$peluquero]);

            return $this->db->lastInsertId();
        }

        public function EditItem($nombre,$edad,$raza,$color,$peso,$observaciones,$peluquero,$id) {
            $sentence= $this->db->prepare("UPDATE {$this->table} SET nombre=?, edad_meses=?, raza=?,color=?, peso_kg=?, observaciones=?, id_peluquero=? WHERE id_gato=?");
            $sentence->execute([$nombre,$edad,$raza,$color,$peso,$observaciones,$peluquero,$id]);

            return $sentence->rowCount();
        }

        public function RemoveItem($id) {
            $sentence= $this->db->prepare("DELETE FROM {$this->table} WHERE id_gato=?");
            $sentence->execute([$id]);
        }
    }