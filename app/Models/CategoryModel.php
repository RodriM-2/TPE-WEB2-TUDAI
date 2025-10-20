<?php 

    require_once 'Model.php';

    class CategoryModel extends Model{
        protected $table='peluqueros';

        public function AddCategory($nombre_apellido,$telefono,$edad,$turno,$especialidad) {
            $sentence= $this->db->prepare("INSERT INTO {$this->table}(nombre_apellido,telefono,edad,turno,especialidad) VALUES (?,?,?,?,?)");
            $sentence->execute([$nombre_apellido,$telefono,$edad,$turno,$especialidad]);
        
            return $this->db->lastInsertId();
        }

        public function EditCategory($nombre_apellido,$telefono,$edad,$turno,$especialidad,$id) {
            $sentence= $this->db->prepare("UPDATE {$this->table} SET nombre_apellido=?, telefono=?, edad=?,turno=?, especialidad=? WHERE id_peluquero=?");
            $sentence->execute([$nombre_apellido,$telefono,$edad,$turno,$especialidad,$id]);
        
            return $sentence->rowCount();
        }

        public function RemoveCategory($id) {
            $sentence= $this->db->prepare("DELETE FROM {$this->table} WHERE id_peluquero=?");
            $sentence->execute([$id]);
        }

        public function GetCategoryByID($request) {
            $sentence= $this->db->prepare("SELECT * FROM {$this->table} WHERE id_peluquero=?");
            $sentence->execute([$request->id]);
            $peluquero= $sentence->fetch(PDO::FETCH_OBJ);

            return $peluquero;
        }
    }