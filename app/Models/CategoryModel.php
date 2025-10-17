<?php 

    require_once 'Model.php';

    class CategoryModel extends Model{
        protected $table='peluqueros';

        public function AddCategory($nombre_apellido,$telefono,$edad,$turno,$especialidad) {
            $sentence= $this->db->prepare("INSERT INTO {$this->table}(nombre_apellido,telefono,edad,turno,especialidad)");
            $sentence->execute([$nombre_apellido,$telefono,$edad,$turno,$especialidad]);
        }

        public function EditCategory($nombre_apellido,$telefono,$edad,$turno,$especialidad,$id) {
            $sentence= $this->db->prepare("UPDATE {$this->table} SET nombre_apellido=?, telefono=?, edad,turno=?, especialidad=? WHERE id=?");
            $sentence->execute([$nombre_apellido,$telefono,$edad,$turno,$especialidad,$id]);
        }
    }