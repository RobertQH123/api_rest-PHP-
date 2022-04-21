<?php
require_once 'class/pacientes.class.php';

$_pacientes = new Pacientes;
$_respuestas = new Respuestas;
if($_SERVER["REQUEST_METHOD"] == "GET"){
    if(isset($_GET["page"])){
        $page = $_GET["page"];
        $getList = $_pacientes->list($page);
        header("Content-type: application/json");
        echo json_encode($getList);
        http_response_code(200);
    }elseif(isset($_GET["id"])){
        $id = $_GET["id"];
        $getList = $_pacientes->view($id);
        header("Content-type: application/json");
        if(isset($getList["result"]["error_id"])){
            $respons = $getList["result"]["error_id"];
            http_response_code($respons);
        }else{
            http_response_code(200);
        }
        echo json_encode($getList);
    }


}elseif($_SERVER["REQUEST_METHOD"] == "POST"){
    $postBody = file_get_contents("php://input");
    $conver = json_decode($postBody,true);
    $idPaciente = $_pacientes->postPaciente($conver);
    header("Content-type: application/json");
    if(isset($idpaciente["result"]["error_id"])){
        $respons = $idpaciente["result"]["error_id"];
        http_response_code($respons);
    }else{
        http_response_code(200);
    }
    echo json_encode($idPaciente);


}elseif($_SERVER["REQUEST_METHOD"] == "PUT"){
    $hader = getallheaders();
    if(isset($hader["token"]) && isset($hader["pacienteId"])){
        $putBody = json_encode($hader);
    }else{
        $putBody = file_get_contents("php://input");  
    }
    $conver = json_decode($putBody,true);
    $idPaciente = $_pacientes->putPaciente($conver);
    header("Content-type: application/json");
    if(isset($idpaciente["result"]["error_id"])){
        $respons = $idpaciente["result"]["error_id"];
        http_response_code($respons);
    }else{
        http_response_code(200);
    }
    echo json_encode($idPaciente);


}elseif($_SERVER["REQUEST_METHOD"] == "DELETE"){
    $hader = getallheaders();
    if(isset($hader["token"]) && isset($hader["pacienteId"])){
        $putBody = json_encode($hader);
    }else{
        $putBody = file_get_contents("php://input");  
    }
    $conver = json_decode($putBody,true);
    $idPaciente = $_pacientes->deletePaciente($conver);
    header("Content-type: application/json");
    if(isset($idpaciente["result"]["error_id"])){
        $respons = $idpaciente["result"]["error_id"];
        http_response_code($respons);
    }else{
        http_response_code(200);
    }
    echo json_encode($idPaciente);
}else{
    header("Content-type: application/json");
    $respons = $_respuestas->error_405();
    echo json_encode($respons);
}
?>
