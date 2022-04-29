<?php
require_once "Database.php";
class Portfolio
{
    public static function create($email, $firstName, $lastName, $patronymic, $city, $birtdate, $gender, $phone, $tg_nick, $img, $profession, $salary, $skills, $programs, $exp, $work_place, $education, $about, $achievements) {
        $db = new Database();
        $prep = $db->prepare("INSERT INTO portfolio (email, firstName, lastName, patronymic, city, birthdate, gender, phone, tg_nick, img, profession, salary, skills, programs, exp, work_place, education, about, achievements) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $prep->bind_param('sssssssssssisssssss', $email, $firstName, $lastName, $patronymic, $city, $birtdate, $gender, $phone, $tg_nick, $img, $profession, $salary, $skills, $programs, $exp, $work_place, $education, $about, $achievements);
        $prep->execute();
        $prep->close();
    }
    public static function get($email): array | NULL  {
        $db = new Database();
        $prep = $db->prepare("SELECT * FROM portfolio WHERE email = ?");
        $prep->bind_param('s', $email);
        $prep->execute();
        $res = $prep->get_result();
        $prep->close();
        if($res === false || $res->num_rows != 1) return NULL;
        return $res->fetch_assoc();
    }
    public static function getByID($id): array | NULL  {
        $db = new Database();
        $prep = $db->prepare("SELECT * FROM portfolio WHERE id = ?");
        $prep->bind_param('i', $id);
        $prep->execute();
        $res = $prep->get_result();
        $prep->close();
        if($res === false || $res->num_rows != 1) return NULL;
        return $res->fetch_assoc();
    }

}