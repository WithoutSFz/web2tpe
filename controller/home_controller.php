<?php
include_once 'view/home.phtml';

    class ControladorHome {
        private $view;

        public function __construct() {
            $this->view = new HomeVista();
        }

        public function showHome() {
            $this->view->showHome();
        }
    }
?>