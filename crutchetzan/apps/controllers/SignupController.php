<?php

namespace apps\controllers;
use core\classes\CzanResponse;
use core\classes\CzanAuth;
use core\classes\CzanModelLoader;
use core\lib\Validator;

class SignupController {

    public function sign_up_action($request, $url_vars) {
        $users_model = CzanModelLoader::load("users");
        $response = new CzanResponse;
        $auth = new CzanAuth;
        $context = [];
        $context["problems"] = [];
        $username = $_POST["username"];
        $password1 = $_POST["password1"];
        $password2 = $_POST["password2"];

        //redirrect to index if aleredy authenticated
        if ($auth->get_username()) {
            $response->redirrect("/");
            return $response;
        }

        // GET
        if ($request->get_method() == "get") {
            $response->render("sign_up");
            return $response;
        }

        // POST
        if ($request->get_method() == "post") {
            if (! Validator::validate_password($password1)) {
                $context["problems"][] = "Invalid password1";
            }
            if (! Validator::validate_password($password2)) {
                $context["problems"][] = "Invalid password2";
            }
            if (! Validator::validate_username($username)) {
                $context["problems"][] = "Invalid username";
            }
            if ($password2 != $password1) {
                $context["problems"][] = "Passwords do not match";
            }
            if ($users_model->is_name_taken($username)) {
                $context["problems"][] = "This name is alredy taken";
            }
            if (! $users_model->register_new($username, $password1)) {
                $context["problems"][] = "Error with register";
            }
            if($context["problems"] != []) {
                $response->render('sign_up', $context);
                return $response;
            }
            $response->redirrect("/");
            return $response;
        }
    }
}

return new SignupController;

?>