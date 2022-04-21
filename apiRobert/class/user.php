<?php
include_once "dataBase/db.php";
class User extends DB{
    public function loginUser($datos){
        $pass = md5($datos->password);
        $query = $this->connect()->prepare("SELECT UsuarioId FROM usuarios WHERE Usuario = :usuario AND Password = :password");
        $query->bindparam('usuario',$datos->usuario);
        $query->bindparam('password',$pass);
        $query->execute();
        
        $arr = $query->fetch(PDO::FETCH_OBJ)->UsuarioId;
        return $arr;
    }
}
?>