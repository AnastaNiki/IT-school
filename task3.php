<?php
interface Human {
    public function printFio();
    public function printTable();
    public function isAdmin();
}

class User implements Human {
    public const TABLE_NAME = "users";
    private const ROLE = "user";
    
    protected string $fio;
    readonly protected string $login;
    protected string $email;

    public function printFio() {
        var_dump($this->fio);
    }
    public function isAdmin() {
        if (self::ROLE != "admin") {
             return false;
        }
        return true;
    }
    public function printTable() {
        var_dump(self::TABLE_NAME);
    }

    public function __construct(string $fio, string $login, string $email) {
        $this->fio = $fio;
        $this->login = $login;
        $this->email = $email;
    }
    public function __destruct() {
        echo 'Destroying user with login: ', $this->login, PHP_EOL;
    }
}

abstract class Client {
    abstract protected function someTest();
    public function printNumber($num) {
        var_dump($num);
    }
}

//$testUser = new User("Name Surname", "newLogin", "email@internet.ru");
//$testUser->printFio();
//$testUser->printTable();
//var_dump($testUser->isAdmin());
?>
