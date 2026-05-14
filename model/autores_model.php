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

    //alta- INSERT
    function agregarAutor($nombre, $apellido, $nacionalidad){
        $query = $this->db->prepare("INSERT INTO autores (nombre, apellido, naciolidad) VALUES (?, ?, ?)");
        $query->execute([$nombre, $apellido, $nacionalidad]);
    }

    //media- UPDATE
    function editarAutor($id_autor, $nombre, $apellido, $nacionalidad){
        $query= $this->db->prepare("UPDATE autores SET nombre = ?, apellido = ?, nacionalidad = ? WHERE id_autor = ?");
        return $query -> execute([$nombre, $apellido, $nacionalidad, $id_autor]);    
    }

    //baja- DELETE
    function eliminarAutor($id_autor){
        $query = $this->db->prepare("DELETE FROM autores WHERE id_autor= ?");
        return $query->execute([$id_autor]);
    }
}