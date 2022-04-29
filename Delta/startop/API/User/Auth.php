<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once "../config/Database.php";
require_once  "../Objects/User.php";

$db = new Database();
$user = new User($db);

$data = json_decode(file_get_contents("php://input"));
if (!empty($data->email) &&
    !empty($data->password)) {
    $user->email = $data->email;
    $user->password = $data->password;

    if(!$user->checkEmail()) {
        http_response_code(404);
        echo json_encode(array("message" => "Неправильный логин"), JSON_UNESCAPED_UNICODE);
    }
    else if($user->checkPwd()) {
        $key = $user->generateKey();
        // 200 OK
        http_response_code(200);
        echo json_encode($key);
    }
    else {
        // 404 Ничего не найдено
        http_response_code(404);
        echo json_encode(array("message" => "Неправильный пароль"), JSON_UNESCAPED_UNICODE);
    }
}