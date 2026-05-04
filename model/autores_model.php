<?php 
include_once 'model.php';

class AutoresModel extends Model {
   
    function obtenerTodosLosAutores(){
        $query=$this->db->prepare("SELECT * FROM autores");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    function obtenerAutorPorId($id_autor){
        $query = $this->db->prepare("SELECT * FROM autores WHERE id_autor = ?");
        $query->execute([$id_autor]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    function obtenerLibroPorAutor ($id_autor){
        $query= $this->db->prepare("SELECT * FROM libros WHERE id_autor = ?");
        $query->execute([$id_autor]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}