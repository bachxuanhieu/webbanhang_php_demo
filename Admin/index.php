<?php

include('Controllers/BaseController.php');
include('Models/BaseModel.php');
// 


if (isset($urlParts[1])) {
    if (isset($urlParts[2])) {
        if (isset($urlParts[3])) {
            $controllerName = ucfirst(strtolower($urlParts[1])) . 'Controller';
            $actionName = $urlParts[2];
            require "Admin/Controllers/${controllerName}.php";

            $controllerObject = new $controllerName;
            $controllerObject->$actionName($urlParts[3]);
        } else {
            $controllerName = ucfirst(strtolower($urlParts[1])) . 'Controller';
            $actionName = $urlParts[2];
            require "Admin/Controllers/${controllerName}.php";

            $controllerObject = new $controllerName;
            $controllerObject->$actionName();
        }
    } else {
      
        $controllerName = ucfirst(strtolower($urlParts[1])) . 'Controller';
        $actionName = "index";
        require "Admin/Controllers/${controllerName}.php";

        $controllerObject = new $controllerName;
        $controllerObject->$actionName();

 
    }
} else {
   
    include("Core/Database.php");
    $actionName = "index";
    require 'Admin/Controllers/LoginController.php';

    $controllerObject = new $controllerName;
    $controllerObject->$actionName();
}
