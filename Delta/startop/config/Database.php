<?php

class Database extends \mysqli
{
    public function __construct()
    {
        parent::__construct('127.0.0.1', 'root', NULL, 'users');
    }
}
class Auth {
    public static function Register($email, $password):void {
        $db = new Database();
        if(self::getHashByEmail($email) !== NULL) {
            throw new \Exception("Уже зарегистрирован");
        }
        $salt = self::generateSalt();
        $hash = password_hash($password . $salt,PASSWORD_BCRYPT);
        $prep = $db->prepare("INSERT INTO users (email, hash, salt) VALUES(?,?,?)");
        $prep->bind_param('sss', $email, $hash, $salt);
        $prep->execute();
        $prep->close();
    }
    private static function generateSalt(): string{
        return bin2hex(random_bytes(8));
    }
    private static function getHashByEmail($email): array | NULL {
        $db = new Database();
        $prep = $db->prepare("SELECT * FROM users WHERE email = ?");
        $prep->bind_param('s', $email);
        $prep->execute();
        $res = $prep->get_result();
        $prep->close();
        if($res === false || $res->num_rows != 1) return NULL;
        $user = $res->fetch_assoc();
        return $user['hash'];
    }
    private static function getUserByEmail($email): array | NULL {
        $db = new Database();
        $prep = $db->prepare("SELECT * FROM users WHERE email = ?");
        $prep->bind_param('s', $email);
        $prep->execute();
        $res = $prep->get_result();
        $prep->close();
        if($res === false || $res->num_rows != 1) return NULL;
        return $res->fetch_assoc();
    }
    public static function checkPassword($email,$password):bool {
        $hash = self::getUserByEmail($email)['hash'];
        $salt = self::getUserByEmail($email)['salt'];
        $pwd = $password . $salt;
        if($hash !== NULL && password_verify($pwd,$hash)) {
            return true;
        }
        return false;
    }
    private static function generateKey() {
        return bin2hex(random_bytes(25)) . date("Y-m-d H:i:s");
    }
    public static function getKey($email):string {
        $db = new Database();
        $key = self::generateKey();
        $prep = $db->prepare("INSERT INTO sessions (email, user_key) VALUES(?,?)");
        $prep->bind_param('ss', $email, $key);
        $prep->execute();
        $prep->close();
        return $key;
    }
    private static function checkKey($key):bool {
        if(self::getEmailByKey($key) !== null) return true;
        return false;
    }
    public static function isLogged():bool {
        $key = $_COOKIE['key'] ?? NULL;
        if($key === null) return false;
        return self::checkKey($key);
    }
    public static function getEmailByKey($key):string | null {
        $db = new Database();
        $prep = $db->prepare("SELECT * FROM sessions WHERE user_key = ?");
        $prep->bind_param('s', $key);
        $prep->execute();
        $res = $prep->get_result();
        $prep->close();
        if($res->num_rows > 0) {
            return $res->fetch_assoc()['email'];
        }
        return null;
    }
    public static function returnUserByEmail($email) {
        $user = self::getUserByEmail($email);
        $user['hash'] = null;
        return $user;
    }
}

