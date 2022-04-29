<?php
require_once "../config/Database.php";
require_once "../Objects/Portfolio.php";
header("Content-Type: application/json; charset=UTF-8");
require_once "../config/Database.php";
require_once  "../Objects/Portfolio.php";
$db = new Database();
$portfolio = new Portfolio($db);


http_response_code(200);
