<?php
require_once "../config/Database.php";
class API
{
    /**
     * проверка ключа API
     * @param string $key
     * @param string $email
     * @return bool
     */
    public static function checkKey(string $key, string $email): bool{
        $db = new Database();
        $prep = $db->prepare("SELECT email FROM api_keys WHERE key = ?");
        $prep->bind_param('s', $key);
        $prep->execute();
        $res = $prep->get_result();
        $prep->close();
        if($res === false || $res->num_rows != 1) return false;
        $mail = $res->fetch_assoc()[0];
        return $mail === $email;
    }

    /**
     * сгенерировать ключ API
     * @param string $email
     * @param string $password
     * @param string $string
     * @return string
     * @throws Exception
     */
    public static function createKey(string $email,string $password, string $string): string {
        if(Auth::checkPassword($email,$password)) {
            $key = bin2hex(random_bytes(25)) . date("Y-m-d H:i:s");
            $db = new Database();
            $prep = $db->prepare("INSERT INTO api_keys (email, api_key, appName) VALUES(?,?,?)");
            $prep->bind_param('sss', $email, $key, $string);
            $prep->execute();
            $prep->close();
            return $key;
        }
        else throw new Exception("Wrong password!");
    }

}