<?php

namespace core\classes;

session_start();

// core classes
require_once realpath("./core/classes/CzanException.php");
require_once realpath("./core/classes/CzanRequest.php");
require_once realpath("./core/classes/CzanRouter.php");
require_once realpath("./core/classes/CzanResponse.php");
require_once realpath("./core/classes/CzanDB.php");
require_once realpath("./core/classes/CzanAuth.php");
require_once realpath("./core/classes/CzanModelLoader.php");

// libs
require realpath("./core/lib/SimpleImage.php");
require realpath("./core/lib/Validator.php");

$request = new CzanRequest;
$router = new CzanRouter;

$action_name = $router->get_action_name();
$url_vars = $router->get_url_vars();
$controller = $router->get_controller();

if ($action_name == null) {
    (new CzanResponse("", 404))->send();
    die();
}

$response = $controller->{$action_name}($request, $url_vars);


$response->send();
?>