<?php
include('Admin/Core/Database.php');
include('Controllers/AuthController.php');
include('Models/AuthModel.php');
define('BASE_URL','http://localhost/demo');


if (isset($_GET['url'])) {
    $urlParts = explode('/', $_GET['url']);
    
    if (isset($urlParts[0]) && $urlParts[0] == 'Admin') {
        require('admin/index.php');
    } else {
        if (isset($urlParts[1])) {
            $controllerName = ucfirst(strtolower($urlParts[0])) . 'Controller';
            $actionName = $urlParts[1];
            require "Controllers/${controllerName}.php";

            $controllerObject = new $controllerName;

            if (isset($urlParts[2])) {
                if(isset($urlParts[3]))
                {
                    $controllerObject->$actionName($urlParts[2],$urlParts[3]);
                }else{
                    $controllerObject->$actionName($urlParts[2]);
                }
                
            } else {
                $controllerObject->$actionName();
            }
        }elseif($urlParts[0] != "home"){
            $controllerName = ucfirst(strtolower($urlParts[0])) . 'Controller';
            $actionName = "index";
            require "Controllers/${controllerName}.php";
            $controllerObject = new $controllerName;
            $controllerObject->$actionName();

        }
        else {
            require('Controllers/HomeController.php');
            $controllerObject = new HomeController();
            $controllerObject->index();
        }
    }
} else {
    require('Controllers/HomeController.php');
    $controllerObject = new HomeController();
    $controllerObject->index();
}


   


