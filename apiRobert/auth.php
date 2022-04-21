<?php
require_once 'class/user.php';
require_once 'class/token.php';
$_user = new User;
$_token = new Token;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $postbody = file_get_contents("php://input");
    $postbody = json_decode($postbody);
    $result = $_user->loginUser($postbody);
    $token = $_token->insertarToken($result);
    print_r($token);
}elseif($_SERVER["REQUEST_METHOD"] == "GET"){
    echo "get";
}
?>