<?php

class AuthController 
{
    public $session;
    const VIEW = 'Views'; 
    const modelPath = 'Models'; 

  
    
    public function __construct(){

            $this->loadSession('Session');
            $this->session = new Session;

   }
    protected function view($path, array $data = []){

        foreach ($data as $key => $value){
            $$key = $value;
        }

        $path = self::VIEW .'/'.str_replace('.','/',$path).'.php';
        return require ($path);
    }

    protected function loadModel($modelPath){ 
        $modelPath = self:: modelPath .'/'.$modelPath.'.php';
        return require ($modelPath);
    }

    protected function loadSession($sessionPath)
    {
        $sessionPath = self::modelPath .'/Session.php';
        return require ($sessionPath);
    }
}