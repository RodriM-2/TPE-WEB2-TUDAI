<?php

    require_once 'Model.php';
    class ItemModel extends Model{

       protected $table='gatos';

        public function GetItem($id) {
            $sentence= $this->db->prepare("SELECT * FROM {$this->table} WHERE id_gato=?");
            $sentence->execute([$id]);
            $gato= $sentence->fetch(PDO::FETCH_OBJ);

            return $gato;
        }

        public function AddItem($nombre,$edad,$raza,$color,$peso,$observaciones) {
            $sentence=$this->db->prepare("INSERT INTO {$this->table}(nombre,edad_meses,raza,color,peso_kg,observaciones) VALUES (?,?,?,?,?,?)");
            $sentence->execute([$nombre,$edad,$raza,$color,$peso,$observaciones]);
        }

        public function EditItem($nombre,$edad,$raza,$color,$peso,$observaciones,$id) {
            $sentence= $this->db->prepare("UPDATE {$this->table} SET nombre=?, edad_meses=?, raza,color=?, peso_kg=?, observaciones=? WHERE id_gato=?");
            $sentence->execute([$nombre,$edad,$raza,$color,$peso,$observaciones,$id]);
        }
    }