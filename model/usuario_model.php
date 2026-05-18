<?php
include_once 'WEB2TPE/model/model.php';

class UsuarioModel extends Model {
    public function obtenerUsuarioPorEmail($email){
        $query = $this->db->prepare("SELECT * FROM usuarios WHERE email = ?");
        $query->execute([$email]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
}