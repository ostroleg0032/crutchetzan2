<?php

namespace core\classes;

class CzanModelLoader {

    public static function load($model_name) {
        $model_name = ucfirst($model_name)."Model.php";
        $model = require realpath("./apps/models/{$model_name}");
        return $model;
    }
}


?>