<?php

namespace apps\controllers;
use core\classes\CzanResponse;
use core\classes\CzanAuth;
use core\classes\CzanModelLoader;

class IndexController {

    public function index_page_action($request, $url_vars) {
        $images_model = CzanModelLoader::load("images");
        $context["id_name"] = $images_model->get_id_name();
        $auth = new CzanAuth();
        $response = new CzanResponse();

        if (! $username = $auth->get_username()) {
            $response->redirrect("/signin");
            return $response;
        }

        $context["username"] = $username;
        $response->render("index", $context);

        return $response;
    }
}

return new IndexController();

?>