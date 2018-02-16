<?php

namespace apps\controllers;
use core\classes\CzanResponse;
use core\classes\CzanAuth;
use core\lib\Validator;

class SigninController {


    public function sign_in_action($request, $url_vars) {
        $response = new CzanResponse;
        $auth = new CzanAuth;
        $context = [];
        $context["problems"] = [];
        $username = $_POST["username"];
        $password = $_POST["password"];

        //redirrect to index if aleredy authenticated
        if ($auth->get_username()) {
            $response->redirrect("/");
            return $response;
        }
        
        // GET
        if ($request->get_method() == "get") {
            $response->render("sign_in");
            return $response;
        }

        // POST
        if ($request->get_method() == "post") {
            if (! Validator::validate_password($password)) {
                $context["problems"][] = "Invalid password";
            }
            if (! Validator::validate_username($username)) {
                $context["problems"][] = "Invalid username";
            }
            if (! $auth->sign_in($username, $password)) {
                $context["problems"][] = "Wrong login or password";
            }
            if($context["problems"]) {
                $response->render('sign_in', $context);
                return $response;
            }
            $response->redirrect("/");
            return $response;
        }
    }
}

return new SigninController;

?>