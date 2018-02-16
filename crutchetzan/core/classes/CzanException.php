<?php

namespace core\classes;

class CzanException extends \Exception {

    public function __construct($message) {
        parent::__construct($message);
    }

    public function __toString() {
        $file = basename($this->file).PHP_EOL;
        $class_name = array_pop(explode("\\", get_class($this)));
        return $class_name." [ {$this->message} ]";
    }

}