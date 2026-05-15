<?php
require_once 'WEB2TPE/model/libros_model.php';
require_once 'WEB2TPE/model/autores_model.php';
require_once 'WEB2TPE/view/admin_view.php';
require_once 'WEB2TPE/middleware/auth.helper.php';

class ControladorAdministrador{
    private $view;
    private $librosModel;
    private $autoresModel;

    public function __construct(){
        $this->view= new AdminView;
        //$this->librosModel= new LibrosModel();
        $this->autoresModel= new AutoresModel();
    }

    public function showPanelAdmin(){
        //$libros= $this->librosModel-> obtenerLibros();
        $autores= $this->autoresModel-> obtenerTodosLosAutores();

        $this->view->mostrarPanelAdmin($autores, $libros);
    }
}