<?php

namespace core\classes;

class CzanAuth {

    public function get_username() {
        if (isset($_SESSION["username"])) {
            return $_SESSION["username"];
        }
        return null;
    }

    public function sign_in($username, $password) {
        $db = new CzanDB();
        $query = "
        SELECT username, password
        FROM users WHERE username = ? AND password = ?
        ";
        $row = $db->execute($query, [$username, $password]);
        if ($row) {
            $this->log_out();
            $_SESSION["username"] = $username;
            $_SESSION["password"] = $password;
            return true;
        } else {
            return false;
        }
    }

    public function log_out() {
        unset($_SESSION["username"]);
        unset($_SESSION["password"]);
    }
}