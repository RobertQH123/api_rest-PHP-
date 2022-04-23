<?php
require_once 'class/user.php';
require_once 'class/token.php';
$_user = new User;
$_respuestas = new Respuestas;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $postbody = file_get_contents("php://input");
    $postbody = json_decode($postbody);
    $result = $_user->loginUser($postbody);
    header("Content-type: application/json");
    if(isset($result["result"]["error_id"])){
        $respons = $result["result"]["error_id"];
        http_response_code($respons);
    }else{
        http_response_code(200);
    }
    echo json_encode($result);
}else{
    header("Content-type: application/json");
    $respons = $_respuestas->error_405();
    echo json_encode($respons);
}
?>
