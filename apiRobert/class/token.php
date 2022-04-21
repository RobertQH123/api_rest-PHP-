<?php
include_once "dataBase/db.php";
class Token extends DB{
    public function insertarToken($UsuarioId){
        try{
            $val= true;
            $token = bin2hex(openssl_random_pseudo_bytes(16,$val));
            $date = date("Y-m-d H:i:s");
            $estado = "Activo";
            $query = $this->connect()->prepare("INSERT INTO usuarios_token (UsuarioId,Token,Estado,Fecha) VALUE (:usuarioId,:token,:estado,:date)");
            $query->bindparam('usuarioId',$UsuarioId);
            $query->bindparam('token',$token);
            $query->bindparam('estado',$estado);
            $query->bindparam('date',$date);
            $query->execute();
            return $token;
        }catch(PDOException $e){
            return false;
        }
    }
    public function comprobarToken($token){
        try{
            $query = $this->connect()->prepare("SELECT * FROM usuarios_token WHERE Token =:token Estado='Activo'");
            $query->bindparam('token',$token);
            $query->execute();
            $rows = $query->fetchColumn();
            if($rows>0){
                return true;
            }
            return false;
        }catch(PDOException $e){
            return false;
        }
    }
}
?>