<?php

namespace core\classes;

class CzanResponse {

    private $headers = [];
    private $data;
    private $code;

    public function __construct($data="", $code=200) {
        $this->data = $data;
        $this->code = $code;
    }

    public function send() {
        http_response_code($this->code);
        if ($this->headers) {
            foreach($this->headers as $header_string) {
                header($header_string);
            }
        }
        
        echo $this->data;
    }

    public function render($template_name, $context = []) {
        ob_start();
        require realpath("./apps/templates/{$template_name}_template.php");
        $content = ob_get_contents();
        ob_end_clean();
        $this->data = $content;
    }

    public function add_header($header) {
        array_push($this->headers, $header);
    }

    public function redirrect($url) {
        $this->add_header("Location: {$url}");
    }

    public function set_code($code) {
        $this->code = $code;
    }

    public function set_data($data) {
        $this->data = $data;
    }
}