<?php

namespace core\classes;

class CzanRequest {
    
    private $method = null;
    private $urn = null;
    private $query = null;
    private $body = null;
    private $content_type = null;

    public function __construct() {
        $method = strtolower($_SERVER["REQUEST_METHOD"]);
        $parsed_uri = parse_url($_SERVER["REQUEST_URI"]);
        $urn = trim($parsed_uri["path"], "/");
        $body = file_get_contents("php://input");
        $content_type = getallheaders()["Content-Type"];
        
        $this->content_type = $content_type;
        $this->body = $body;
        $this->urn = $urn;
        $this->method = $method;
    }

    public function get_method() {
        return $this->method;
    }

    public function get_urn() {
        return $this->urn;
    }

    public function get_query() {
        return $this->query;
    }

    public function get_body() {
        return $this->body;
    }
}

?>