<?php
include_once 'model/libros_model.php';
include_once 'model/autores_model.php';
include_once 'view/libros_view.php';

class LibrosController{
    private $modelLibro;
    private $viewLibro;

    function __construct(){
        $this->modelo = new LibrosModel();
        $this->view = new LibrosView();
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
        if (empty($id_libro=null) || !is_numeric($id_libro)){
            $this->viewLibro->mostrarError("Debe indicar el ID del libro.");
            return;
        }

        $libro=$this->modelLibro->obtenerLibroPorId($id_libro);

        if(empty($libro)){
            $this->viewLibro->mostrarError("No se encommtró el libro con ID: " . $id_libro);
        }else{
            $this->viewLibro->mostarDetalleLibro($libro);
        }
    }

    function buscarLibro(){
        $titulo_buscado = $_GET['titulo_libro'] ?? null;

        if(empty($titulo_buscado)){
            $this->viewLibro->mostrarError("Debe ingresar un titulo para buscar.");
            return;
        }

        $libro = $this->modelLibro->buscarLibroPorTitulo($titulo_buscado);

        if ($libro){
            $this->viewLibro->mostrardetalleLibro($libro);
        } else{
            $this->viewLibro->mostrarError("No se encomtro el libro con el titulo: '{$titulo_buscado}'.");
        }
    }

    
}