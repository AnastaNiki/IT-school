<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once "../config/Database.php";
require_once  "../Objects/Portfolio.php";

$db = new Database();
$portfolio = new Product($db);

$data = json_decode(file_get_contents("php://input"));
$portfolio->id = $data->id;

if ($portfolio->delete()) {
    // 200 ok
    http_response_code(200);
    echo json_encode(array("message" => "Портфолио было удалён."), JSON_UNESCAPED_UNICODE);
}
else {
    // 503 Сервис не доступен
    http_response_code(503);
    echo json_encode(array("message" => "Не удалось удалить портфолио."));
}