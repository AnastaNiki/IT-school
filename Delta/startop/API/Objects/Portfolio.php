<?php

/**
 * класс, который должен облегчить сериализацию данных номер 1
 */
class Portfolio
{
    private $conn;
    //fields
    public int $id;
    public string $firstName;
    public string $lastName;
    public string $patronymic;
    public string $email;
    public string $birthdate;
    public string $gender;
    public string $phone;
    public string $tg_nick;
    public string $img;
    public string $city;
    public string $profession;
    public int $salary;
    public string $skills;
    public string $programs;
    public string $exp;
    public string $work_place;
    public string $education;
    public string $about;
    public string $achievements;

    public function __construct($db){
        $this->conn = $db;
    }
    public function Read(){
        return json_encode($this);
    }

    /**
     * создаёт портфолио с переданными параметрами, возвращает true, если создано
     * @return bool
     */
    public function create(): bool {
        $prep = $this->conn->prepare("INSERT INTO portfolio (email, firstName, lastName, patronymic, city, birtdate, gender, phone, tg_nick, img, profession, salary, skills, programs, exp, work_place, education, about, achievements) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $prep->bind_param('sssssssssssissssss', $this->email, $this->firstName, $this->lastName, $this->patronymic, $this->city, $this->birtdate, $this->gender, $this->phone, $this->tg_nick, $this->img, $this->profession, $this->salary, $skills_b, $programs_b, $this->exp, $work_place_b, $education_b, $this->about, $achievements_b);
        $prep->execute();
        $prep->close();
        return true;
    }

    /**
     * удаляет портфолио по его id, возвращает true, если удалено успешно
     * @return bool
     */
    public function delete(): bool{
        $prep = $this->conn->prepare("DELETE FROM portfolio WHERE id = ?");
        $prep->bind_param('i', $this->id);
        $prep->execute();
        $prep->close();
        $prep = $this->conn->prepare("SELECT * FROM portfolio WHERE id = ?");
        $prep->bind_param('i', $this->id);
        $prep->execute();
        $res = $prep->get_results();
        $prep->close();
        if($res === false || $res->num_rows != 0) return false;
        return true;
    }

    /**
     * возвращает массив портфолио по email
     * @param $email
     * @return false | array
     */
    public function search($email): false | array{
        $prep = $this->conn->prepare("SELECT * FROM fortfolio WHERE email = ?");
        $prep->bind_param('s', $email);
        $prep->execute();
        $res = $prep->get_result();
        $prep->close();
        if($res === false || $res->num_rows != 1) return false;
        return $res;
    }

    /**
     * По переданному email влзвращает кол-во портфолио в вашем аккаунте
     * @param $email
     * @return int
     */
    public function count($email): int {
        $prep = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $prep->bind_param('s', $email);
        $prep->execute();
        $res = $prep->get_result();
        $prep->close();
        return $res->num_rows;
    }
}