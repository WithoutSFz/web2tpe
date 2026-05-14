<?php
include_once 'model/autores_model.php';
include_once 'model/libros_model.php';
include_once 'view/autores_view.php';
include_once 'view/libros_view.php';
include_once 'middleware/auth.helper.php';


class AutoresController{
    private $modelAutor;
    private $viewAutor;
    private $viewLibro;

    function __construct(){
        $this->modelAutor= new AutoresModel();
        $this->viewAutor= new AutoresView();
       // $this->viewLibro= new LibrosView();
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

    function showFormAgregarAutor(){
        $this->viewAutor->mostrarFormularioAlta();
    }

    function agregarAutor(){
        $nombre = $_POST['nombre'] ?? null;
        $apellido=$_POST['apellido'] ?? null;
        $nacionalidad=$_POST['nacionalidad'] ?? null;

        if (empty($nombre) || empty($apellido)) {
            $this->viewAutor-> mostrarError("Falta campos obligatorios (Nombre y Apellido).");
            return;
        }
        $this->modelAutor->agregarAutor($nombre, $apellido, $nacionalidad);
        header("Location: router.php?action=admin");
        exit;    
    }

    function showFormEditarAutor($id_autor= null){
        if (empty($id_autor)){
            $this->viewAutor->mostrarError("ID de autor no especificado para edición.");
            return;
        }

        $autor = $this->modelAutor->obtenerAutorPorId($id_autor);
        if($autor){
            $this->viewAutor->mostrarFormularioEdicion($autor);
        } else {
            $this->viewAutor->mostrarError("Autor a editar no encontrado.");
        }
    }

    function editarAutor(){
        $id = $_POST ['id_autor'] ?? null;
        $nombre= $_POST ['nombre'] ?? null;
        $apellido = $_POST ['apellido'] ?? null;
        $nacionalidad = $_POST ['nacionalidad'] ?? null;

        if(empty($id) || empty ($nombre) || empty ($apellido) || empty($nacionalidad)){
            $this->viewAutor->mostrarError("Faltan datos obligatorios para la edicion.");
            return;
        }

        $this->modelAutor->editarAutor($id, $nombre, $apellido, $nacionalidad);
        header("Location: router.php?action=admin");
        exit;
    }

    function eliminarAutor($id_autor= null){
        if (empty($id_autor) || !is_numeric($id_autor)){
            $this->viewAutor->mostrarError("Debe indicar un ID de autor válido para eliminar.");
            return;
        }

        $this->modelAutor->eliminarAutor($id_autor);
        header("Location: router.php?action=admin");
        exit;
    }
}