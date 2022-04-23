<?php
include_once "dataBase/db.php";
include_once "class/respuestas.php";
class User extends DB{
    public function loginUser($datos){
        $_respuestas = new Respuestas;
        $_token = new Token;
        $pass = md5($datos->password);
        $query = $this->connect()->prepare("SELECT UsuarioId,Estado FROM usuarios WHERE Usuario = :usuario AND Password = :password");
        $query->bindparam('usuario',$datos->usuario);
        $query->bindparam('password',$pass);
        $query->execute();
        if($query->rowCount()>0){
            $arr = $query->fetchAll(PDO::FETCH_ASSOC);
            $usuario = $arr[0]["UsuarioId"];
            $estado = $arr[0]["Estado"];
            if($estado == "Activo"){
                $tokenre = $_token->insertarToken($usuario );
                if($tokenre){
                    $resul = $_respuestas->response;
                    $resul["result"] = array(
                        "token" => $tokenre
                    );
                    return $resul;
                }else{
                    return $_respuestas->error_500("error interno, no emos podido guardar");
                }
            }else{
                    return $_respuestas->error_200("usuario inactivo");
            }
        }else{
            return $_respuestas->error_200("datos incorrectos");
        }
    }
}
?>
