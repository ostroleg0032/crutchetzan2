<?php

namespace apps\controllers;
use core\classes\CzanResponse;
use core\classes\CzanAuth;

class LogoutController {
    public function logout_action($request_holder, $inline_vars) {
        $auth = new CzanAuth();
        $auth->log_out();
        $response = new CzanResponse();
        $response->redirrect("/signin");
        return $response;
    }
}

return new LogoutController();

?>