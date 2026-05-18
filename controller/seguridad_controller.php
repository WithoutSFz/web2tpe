<?php
include_once 'model/usuario_model.php';
include_once 'view/login.php';
include_once 'middleware/auth.helper.php';

class SeguridadController{
    private $model;
    private $view;
    private $helper;

    public function __construct(){
        $this->model = new UsuarioModel();
        $this->view = new LoginView();
        $this->helper = new AuthHelper();
    }

    //muestra form login
    function showLoginForm($error = null){
        $this->view->mostrarLogin($error);
    }

    //procesa POST login
    function verify(){
        $userEmail = $_POST['email'] ?? null;
        $userPassword = $_POST['password'] ?? null;

        if (empty($userEmail) || empty($userPassword)){
            $this->showLoginForm('Debe completar ambos campos.');
            return;
        }

        $user = $this->model->obtenerUsuarioPorEmail($userEmail);
        
        if ($user && password_verify($userPassword, $user->password)){
            $this->helper->login($user);
            header("Location: router.php?action=admin");
            die();
        }else{
            $this->showLoginForm('Usuario o contraseña incorrectos.');
        }
    }
    
    //cierre de sesion
    function logout(){
        $this->helper->logout();
    }
}