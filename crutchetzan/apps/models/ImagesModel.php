<?php

namespace apps\models;
use core\classes\CzanDB;

class UsersModel {

    public function delete($id) {
        if (! $this->is_exists($id)) {
            return false;
        }
        $db = new CzanDB;
        $query = "
        DELETE FROM images
        WHERE id = ?
        ";
        $db->execute($query, [$id]);
        return true;
        
    }

    public function add_new($name, $data) {
        $db = new CzanDB;
        $query = "
        INSERT INTO images (name, data)
        VALUES (?, ?)
        ";
        $db->execute($query, [$name, $data]);
    }

    public function get_data($id) {
        $db = new CzanDB;
        $query = "
        SELECT data FROM images
        WHERE id = ?
        ";
        $data = $db->execute($query, [$id]);
        return $data;
    }

    public function get_id_name() {
        $db = new CzanDB;
        $query = "
        SELECT id, name FROM images
        ";
        $rows = $db->execute($query);
        return $rows;
    }

    public function is_exists($id) {
        $db = new CzanDB;
        $query = "
        SELECT * FROM images
        WHERE id = ?
        ";
        $rows = $db->execute($query, [$id]);
        if ($rows) {
            return true;
        }
        return false;
    }

    public function move($id, $direction="up") {
        if (! $this->is_exists($id)) {
            return false;
        }
        $db = new CzanDB;
        if ($direction == "up") {
            $op = "<";
        } elseif ($direction == "down") {
            $op = ">";
        }
        $query = "
        SELECT id FROM images
        WHERE id {$op} ?
        ";
        $rows = $db->execute($query, [$id]);
        $new_id = ($direction == "up") ? array_pop($rows)["id"] : array_shift($rows)["id"];
        if ($new_id == null) {
            return false;
        }
        $query = "
        SELECT * FROM images
        WHERE id = ?
        ";
        $row = $db->execute($query, [$new_id])[0];
        $query = "
        DELETE FROM images
        WHERE id = ?
        ";
        $db->execute($query, [$new_id]);
        $query = "
        UPDATE images
        SET id = ?
        WHERE id = ?
        ";
        $db->execute($query, [$new_id, $id]);
        $query = "
        INSERT INTO images (id, name, data)
        VALUES (?, ?, ?)
        ";
        $db->execute($query, [$id, $row["name"], $row["data"]]);
        return true;
    }
}

return new UsersModel;

?>