<?php

class Application
{
    public static function process()
    {

        $controllerName = "Article";
        $task = "index";

        if (!empty($_GET['controller'])) {

            $controllerName = ucfirst($_GET['controller']);
        }

        if (!empty($_GET['task'])) {

            $task = ucfirst($_GET['task']);
        }

        $controllerName = "\Controllers\\" . $controllerName;
        $controller = new $controllerName();
        $controller->$task();
    }
}
