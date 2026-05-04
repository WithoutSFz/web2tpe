<?php
include_once 'WEB2TPE/model/autores_model.php';
include_once 'WEB2TPE/model/libros_model.php';
include_once 'WEB2TPE/view/autores_view.php';
include_once 'WEB2TPE/view/libros_view.php';


class AutoresController{
    private $modelAutor;
    private $viewAutor;
    private $viewLibro;

    function __construct(){
        $this->modelAutor= new AutoresModel();
        $this->viewAutor ;
        $this->viewLibro ;
    }

    /*mostrar todos los autores*/
    function showAutores(){
        $autores= $this->modelAutor->obtenerTodosLosAutores();
        $this->viewAutor->mostrarListaAutores($autores);
    }

    /*obtener autor por id*/
    function showAutoresPorId(){
        $id_autor = $_GET['nombre_autor'] ?? null;
        if (empty($id_autor)){
            $this->viewAutor->mostrarError("debe ingresar el nombre de un autor para buscar.");
            return;
        }

        $autor = $this->modelAutor->obtenerAutorPorId($id_autor);

        if($autor){
            $this->viewAutor->mostrarDetalleAutor($autor);
        } else{
            $this->viewAutor->mostrarError("No se encontró el autor con el nombre: '{$id_autor}'.");
        }
    }

    /*obtener libro por autor*/
    function showLibroPorAutor($id_autor= null){
        if (empty($id_autor) || !is_numeric($id_autor)){
            $this->viewAutor->mostrarError("Debe indicar el id del autor.");
            return;
        }

        $autor = $this->modelAutor->obtenerAutorPorId($id_autor);

        if (!$autor){
            $this->viewAutor->mostrarError("Autor no encontrado con ID: " . $id_autor);
            return;
        }

        $libros= $this->modelAutor->obtenerLibroPorAutor($id_autor);

        $this->viewLibro->mostrarLibros($libros, $autor);
    }
    
}