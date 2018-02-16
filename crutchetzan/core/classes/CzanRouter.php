<?php

namespace core\classes;

class CzanRouter {
    
    private $controller_name;
    private $action_name;
    private $url_vars = [];
    
    private function route2regex($route, $converters) {
        $regexed_route = $route;
        foreach ($converters as $converter_name => $repr) {
            $pattern = "/\({$converter_name}->[a-zA-Z][a-zA-Z0-9]*\)/";
            $regexed_route = preg_replace($pattern, $repr, $regexed_route);
        }
        $regexed_route = str_replace("/", "\/", $regexed_route);
        $regexed_route = "/^{$regexed_route}$/";
        return $regexed_route;
    }

    public function get_controller() {
        $controller_name = $this->get_controller_name();
        $controller = require_once realpath("./apps/controllers/{$controller_name}.php");
        return $controller;
    }

    public function __construct() {
        $request = new CzanRequest;
        $routes = require_once realpath("./apps/config/routes.php");
        $converters = require_once realpath("./apps/config/converters.php");
        $urn = $request->get_urn();

        $split_urn = explode("/", $urn);
        if ($split_urn[0] == "") {
            $this->controller_name = "IndexController";
        } else {
            $this->controller_name = ucfirst($split_urn[0])."Controller";
        }
        foreach ($routes as $route => $action_shortname) {
            preg_match($this->route2regex($route, $converters), $urn, $match);
            if ($match) {
                $matched_route = $route;
                $this->action_name = lcfirst($action_shortname)."_action";
            }
        }
        $split_matched_route = explode("/", $matched_route);
        $parts_count = count($split_matched_route);
        $inline_vars = [];
        for ($i = 0; $i < $parts_count; $i++) {
            foreach ($converters as $converter_name => $repr) {
                $pattern = "/^\({$converter_name}->([a-zA-Z][a-zA-Z0-9]*)\)/";
                preg_match($pattern, $split_matched_route[$i], $match);
                if ($match) {
                    $this->url_vars[$match[1]] = $split_urn[$i];
                }
            }
        }
    }

    public function get_controller_name() {
        return $this->controller_name;
    }

    public function get_action_name() {
        return $this->action_name;
    }

    public function get_url_vars() {
        return $this->url_vars;
    }
}

?>