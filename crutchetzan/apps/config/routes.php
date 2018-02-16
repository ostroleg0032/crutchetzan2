<?php

$routes = [

    ""                          => "index_page",
    "signin"                    => "sign_in",
    "logout"                    => "logout",
    "signup"                    => "sign_up",

    "images/add"                => "add_image",
    "images/(num->id)"          => "get_image",
    "images/(num->id)/moveup"   => "moveup",
    "images/(num->id)/movedown" => "movedown",
    "images/(num->id)/delete"   => "delete",
    
    "images/settings"           => "settings"
];

return $routes;

?>