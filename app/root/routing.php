<?php

function routeExecute($route)
{
    $route = explode("@", $route);
    $controller_filename = CONTROLLERPATH . "controller_{$route[0]}.php";
    $action_name = "action_{$route[1]}";
    include $controller_filename;
    return call_user_func($action_name);
}

function getCurentAdrr()
{
    $url = $_SERVER["REQUEST_URI"];
    return trim(explode("?", $url)[0], "/");
}

function isfilteredUrl()
{
    $filtered = include ROOTPATH . "filter_config.php";
    $url = getCurentAdrr();
    foreach ($filtered as $f)
        if (trim($f, "/") === $url) return true;
    return false;
}

function navigate()
{

    $routes = include ROOTPATH . "routing_config.php";

    if(isfilteredUrl() && !auth_isAuth())
        return routeExecute("error@404");

    $url = getCurentAdrr();
    foreach ($routes as $key => $value) {
        if ($url === trim($key, "/"))
            return routeExecute($value);
    }

    return routeExecute("error@404");

}