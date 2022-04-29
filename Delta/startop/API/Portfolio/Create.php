<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once "../config/Database.php";
require_once  "../Objects/Portfolio.php";

$db = new Database();
$portfolio = new Portfolio($db);

$data = json_decode(file_get_contents("php://input"));
if (!empty($data->firstName) &&
    !empty($data->lastName) &&
    !empty($data->patronymic) &&
    !empty($data->email) &&
    !empty($data->birthdate) &&
    !empty($data->gender) &&
    !empty($data->phone) &&
    !empty($data->tg_nick) &&
    !empty($data->img) &&
    !empty($data->city) &&
    !empty($data->profession) &&
    !empty($data->salary) &&
    !empty($data->skills) &&
    !empty($data->programs) &&
    !empty($data->exp) &&
    !empty($data->work_place) &&
    !empty($data->education) &&
    !empty($data->about) &&
    !empty($data->achievements)
) {

    $portfolio->firstName = $data->firstName;
    $portfolio->lastName = $data->lastName;
    $portfolio->patronymic = $data->patronymic;
    $portfolio->email = $data->email;
    $portfolio->birthdate = $data->birthdate;
    $portfolio->gender = $data->gender;
    $portfolio->phone = $data->phone;
    $portfolio->tg_nick = $data->tg_nick;
    $portfolio->img = $data->img;
    $portfolio->city = $data->city;
    $portfolio->profession = $data->profession;
    $portfolio->salary = $data->salary;
    $portfolio->skills = $data->skills;
    $portfolio->programs = $data->programs;
    $portfolio->exp = $data->exp;
    $portfolio->work_place = $data->work_place;
    $portfolio->education = $data->education;
    $portfolio->about = $data->about;
    $portfolio->achievements = $data->achievements;
    if($portfolio->create()){
        // 201 создано
        http_response_code(201);
        echo json_encode(array("message" => "Портфолио было создан."), JSON_UNESCAPED_UNICODE);
    }
    else {
        // 503 сервис недоступен
        http_response_code(503);
        echo json_encode(array("message" => "Невозможно создать портфолио."), JSON_UNESCAPED_UNICODE);
    }
}
else {
    // 400 неверный запрос
    http_response_code(400);
    echo json_encode(array("message" => "Невозможно создать портфолио. Данные неполные."), JSON_UNESCAPED_UNICODE);
}