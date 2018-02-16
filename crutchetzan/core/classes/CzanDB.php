<?php

namespace core\classes;

class CzanDB {

    private static $db = null;

    public function __construct() {
        $settings = require_once realpath("./apps/config/settings.php");
        $db_name = $settings["db_name"];
        if (self::$db == null) {
            self::$db = new \PDO("sqlite:".realpath("./db/{$db_name}"));
        }
    }

    public function execute($query, $params = []) {
        $settings = require_once realpath("./apps/config/settings.php");
        $db_name = $settings["db_name"];
        if (! $stmt = self::$db->prepare($query)) {
            $error_message = self::$db->errorInfo()[2];
            throw new CzanException($error_message);   
        }
        for ($i = 1; $i < count($params) + 1; $i++) {
            if (! $stmt->bindParam($i, $params[$i - 1])) {
                $error_message = $stmt->errorInfo()[2];
                throw new CzanException($error_message);  
            }
        }
        if (! $stmt->execute()) {
            $error_message = $stmt->errorInfo()[2];
            throw new CzanException($error_message);
        }
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }
}

?>