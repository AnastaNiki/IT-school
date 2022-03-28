<?php

class Database extends mysqli {
    function __construct() {
        parent::__construct('127.0.0.1', 'root', NULL, 'itschool');
    }

    /**
     * Gets user by e-mail
     * @param string $email Email
     * @return array|false|NULL array on success, false if not found, NULL on failure
     */
    public function getUserByEmail(string $email): array|false|NULL {
        $prep = self::prepare("SELECT * FROM users WHERE email = ?");
        $prep->bind_param('s', $email);
        $prep->execute();
        $res = $prep->get_result();
        if ($res === false) return NULL;
        $prep->close();

        if ($res->num_rows != 1) return false;
        return $res->fetch_assoc();
        // $q = self::query("SELECT * FROM users WHERE email = '$email'"); SQL injection
    }

    public function insertUser(string $email, string $password): void {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $prep = self::prepare("INSERT INTO users(email, hash) VALUES (?, ?)");
        $prep->bind_param('ss', $email, $hash);
        $prep->execute();
        $prep->close();
    }
}