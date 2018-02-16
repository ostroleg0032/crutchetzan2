<?php

namespace apps\controller;
use core\classes\CzanResponse;
use core\classes\CzanDB;
use core\classes\CzanModelLoader;
use core\classes\CzanAuth;
use core\lib\SimpleImage;

class ImagesController {

    public function delete_action($request, $url_vars) {
        $auth = new CzanAuth;
        $response = new CzanResponse;
        if (! $auth->get_username()) {
            $response->redirrect("/");
            return $response;
        }
        $id = $url_vars["id"];
        $images_model = CzanModelLoader::load("images");
        if ($images_model->delete($id)) {
            $response->redirrect("/images/settings");
        }
        $response->set_code(404);
        return $response;
    }

    public function get_image_action($request, $url_vars) {
        $auth = new CzanAuth;
        $response = new CzanResponse;
        if (! $auth->get_username()) {
            $response->redirrect("/");
            return $response;
        }
        $images_model = CzanModelLoader::load("images");
        $id = $url_vars["id"];
        $data = $images_model->get_data($id)[0]["data"];
        $response->add_header("Content-type: image/png");
        $response->set_data($data);
        return $response;
    }

    public function add_image_action($request, $url_vars) {
        $images_model = CzanModelLoader::load("images");
        $response = new CzanResponse;
        $auth = new CzanAuth;
        if (! $auth->get_username()) {
            $response->redirrect("/");
            return $response;
        }
        // POST
        if($request->get_method() == "post") {
            $image = new SimpleImage("user_picture");
            $name = $_POST["name"];
            $data = $image->get_data();
            $images_model->add_new($name, $data);
            $response->redirrect("../images/settings");
            return $response;
        }
        return new CzanResponse("", 404);
    }

    public function moveup_action($request, $url_vars) {
        $images_model = CzanModelLoader::load("images");
        $id = $url_vars["id"];
        $response = new CzanResponse;
        $auth = new CzanAuth;
        if (! $auth->get_username()) {
            $response->redirrect("/");
            return $response;
        }
        $answer = $images_model->move($id);
        if (! $answer) {
            $response->set_code(404);
            return $response;
        }
        $response->redirrect("/images/settings");
        return $response;
    }

    public function movedown_action($request, $url_vars) {
        $images_model = CzanModelLoader::load("images");
        $id = $url_vars["id"];
        $response = new CzanResponse;
        $auth = new CzanAuth;
        if (! $auth->get_username()) {
            $response->redirrect("/");
            return $response;
        }
        $answer = $images_model->move($id, $direction = "down");
        if (! $answer) {
            $response->set_code(404);
            return $response;
        }
        $response->redirrect("/images/settings");
        return $response;
    }

    public function settings_action($request, $url_vars) {
        $response = new CzanResponse;
        $auth = new CzanAuth;
        if (! $auth->get_username()) {
            $response->redirrect("/");
            return $response;
        }
        $images_model = CzanModelLoader::load("images");
        $context["id_name"] = $images_model->get_id_name();
        $response->render("settings", $context);
        return $response;
    }
}

return new ImagesController();

?>