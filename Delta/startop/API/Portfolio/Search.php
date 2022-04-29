<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// подключение необходимых файлов
include_once '../config/core.php';
require_once "../config/Database.php";
require_once  "../Objects/Portfolio.php";


$db = new Database();
$product = new Portfolio($db);
$email=isset($_GET["s"]) ? $_GET["s"] : "";

$stmt = $product->search($email);
$num = $stmt->rowCount();
if ($num>0) {
    $products_arr=array();
    $products_arr["records"]=array();
    while ($row = $stmt->fetch_assoc()){
        extract($row);
        $product_item=array(
            "firstName" => $firstName,
            "lastName" => $lastName,
            "patronymic" => $patronymic,
            "email" => $email,
            "birthdate" => $birthdate,
            "gender" => $gender,
            "phone" => $phone,
            "tg_nick" => $tg_nick,
            "img" => $img,
            "city" => $city,
            "profession" => $profession,
            "salary" => $salary,
            "skills" => $skills,
            "programs" => $programs,
            "exp" => $exp,
            "work_place" => $work_place,
            "education" => $education,
            "about" => $about,
            "achievements" => $achievements
        );
        array_push($products_arr["records"], $product_item);
    }
    // 200 OK
    http_response_code(200);
    echo json_encode($products_arr);
}

else {
    // 404 Ничего не найдено
    http_response_code(404);
    echo json_encode(array("message" => "Товары не найдены."), JSON_UNESCAPED_UNICODE);
}