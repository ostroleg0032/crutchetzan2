<?php

namespace apps\models;
use core\classes\CzanDB;

class UsersModel {

    public function is_name_taken($username) {
        $db = new CzanDB;
        $query = "
        SELECT * FROM users
        WHERE username = ?
        ";
        $row = $db->execute($query, [$username]);
        if ($row) {
            return true;
        }
        return false;
    }

    public function register_new($username, $password) {
        if ($this->is_name_taken($username)) {
            return false;
        }
        $db = new CzanDB;
        $query = "
        INSERT INTO users (username, password)
        VALUES (?, ?)
        ";
        $db->execute($query, [$username, $password]);
        return true;    
    }
}

return new UsersModel;

?>