<?php
include_once 'model/libros_model.php';
include_once 'model/autores_model.php';
include_once 'view/libros_view.php';

class LibrosController{
    private $modelLibro;
    private $viewLibro;

    function __construct(){
        $this->modelLibro = new LibrosModel();
        $this->viewLibro = new LibrosView();
    }

    //muestra todos los libros
    function showLibros(){
        $libro=$this->modelLibro->obtenerLibros();
        
        if (empty($libro)){
            $this->viewLibro->mostrarError("No se encotraron libros en la biblioteca.");
        }else{
            $this->viewLibro->mostrarLibros($libro);
        }
    }

    function showLibrosPorId($id_libro=null){
        if (empty($id_libro) || !is_numeric($id_libro)){
            $this->viewLibro->mostrarError("Debe indicar el ID del libro.");
            return;
        }

        $libro=$this->modelLibro->obtenerLibroPorId($id_libro);

        if(empty($libro)){
            $this->viewLibro->mostrarError("No se encommtró el libro con ID: " . $id_libro);
        }else{
            $this->viewLibro->mostrarDetalleLibro($libro);
        }
    }

    function buscarLibro(){
        $titulo_buscado = $_GET['titulo_libro'] ?? null;

        if(empty($titulo_buscado)){
            $this->viewLibro->mostrarError("Debe ingresar un titulo para buscar.");
            return;
        }

        $libro = $this->modelLibro->buscarLibrosPorTitulo($titulo_buscado);

        if ($libro){
            $this->viewLibro->mostrarDetalleLibro($libro);
        } else{
            $this->viewLibro->mostrarError("No se encomtro el libro con el titulo: '{$titulo_buscado}'.");
        }
    }

    function showFormAgregarLibro(){
        $autoresModel = new AutoresModel();
        $autores = $autoresModel->obtenerTodosLosAutores();
        $this->viewLibro->mostrarFormularioAltaLibro($autores);
    }

    function agregarLibro(){
        $titulo = $_POST['titulo'] ?? null;
        $genero = $_POST['genero'] ?? null;
        $anio_publicacion = $_POST['anio_publicacion'] ?? null;
        $editorial = $_POST['editorial'] ?? null;
        $id_autor = $_POST['id_autor'] ?? null;

        if(empty($titulo) || empty($genero) || empty($id_autor)){
            $this->viewLibro->mostrarError("Faltan campos obligatorios (Título, Género e ID del autor). ");
            return;
        }

        $this->modelLibro->agregarLibro($titulo, $genero, $anio_publicacion, $editorial, $id_autor);

        header("Location: router.php?action=admin");
        exit;
    }

    function showFormEditarLibro($id_libro = null){

        if(empty($id_libro) || !is_numeric($id_libro)){
            $this->viewLibro->mostrarError("ID de libro no especificado para edición.");
            return;
        }

        $libro = $this->modelLibro->obtenerLibroPorId($id_libro);

        if ($libro){
            $this->viewLibro->mostrarFormularioEdicion($libro);
        } else {
            $this->viewLibro->mostrarError("Libro a editar no encontrado.");
        }
    }

    function editarLibro() {
        $id_libro= $_POST['id_libro'] ?? null;
        $titulo = $_POST['titulo'] ?? null;
        $genero = $_POST['genero'] ?? null;
        $anio_publicacion = $_POST['anio_publicacion'] ?? null;
        $editorial = $_POST['editorial'] ?? null;
        $id_autor = $_POST['id_autor'] ?? null;

        if (empty($id_libro) || empty($titulo) || empty($genero)) {
            $this->viewLibro->mostrarError("Faltan datos obligatorios para la edición.");
            return;
        }

        $this->modelLibro->editarLibro($id_libro, $titulo, $genero, $anio_publicacion, $editorial, $id_autor);
        header("Location: router.php?action=admin");
        exit;
    }


    function eliminarLibro($id_libro = null) {
        if (empty($id_libro) || !is_numeric($id_libro)) {
            $this->viewLibro->mostrarError("Debe indicar un ID de libro válido para eliminar.");
            return;
        }

        $this->modelLibro->eliminarLibro($id_libro);
        header("Location: router.php?action=admin");
        exit;
    }
}