<?php

class Router {

    protected $currentSide = 'front';  
    protected $currentController = 'Home'; 
    protected $currentMethod = 'index'; 
    protected $params = [];

    public function __construct() {
        $url = $this->getUrl();

       
        if (isset($url[0]) && $url[0] == 'Dashboard') {
            $this->currentSide = 'back'; 
        }

       
        $this->currentController = ucwords($url[0] ?? 'home'); 

        
        if (isset($url[0])) {
            $controllerPath = '../app/controllers/' . $this->currentSide . '/' . $this->currentController . '.php';
           
            if (file_exists($controllerPath)) {
                unset($url[0]); 
            } else {
               
                $this->currentController = 'Home';
            }
        }



        require_once '../app/controllers/' . $this->currentSide . '/' . $this->currentController . '.php';

        $this->currentController = new $this->currentController;  


        if (isset($url[1]) && method_exists($this->currentController, $url[1])) {

            $this->currentMethod = $url[1];  
            unset($url[1]);  
        }

        
        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    
    public function getUrl() {
        $request = $_SERVER['REQUEST_URI'];
        $request = rtrim($request, '/');
        $request = ltrim($request, '/');

        
        $request = explode('/', $request);
        $request = array_filter($request);

        return $request ?: ['home'];
        
    }
}

?>
