<?php
include_once 'WEB2TPE/view/home_view.phtml';

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