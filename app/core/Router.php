<?php

class Router {

    protected $currentSide = 'front';  // Default side is 'front'
    protected $currentController = 'Home'; 
    protected $currentMethod = 'index'; 
    protected $params = [];

    public function __construct() {
        $url = $this->getUrl();

        // Check if $url[0] == 'dashboard' to switch to 'back' side
        if (isset($url[0]) && $url[0] == 'dashboard') {
            $this->currentSide = 'back';  // Set to 'back' side
        }

        // Set the current controller to the value of $url[0]
        $this->currentController = ucwords($url[0] ?? 'home'); // Default to 'Home' if no controller is set

        // Check if the controller file exists
        if (isset($url[0])) {
            $controllerPath = '../app/controllers/' . $this->currentSide . '/' . $this->currentController . '.php';
            // echo $this->currentController;
            if (file_exists($controllerPath)) {
                unset($url[0]);  // Remove the controller from the URL if the file exists
            } else {
                // Fallback to a default controller if the file doesn't exist
                $this->currentController = 'Home';
            }
        }

        // Require the controller


        require_once '../app/controllers/' . $this->currentSide . '/' . $this->currentController . '.php';

        $this->currentController = new $this->currentController;  // Instantiate the controller

        // Check if $url[1] exists and if the controller has the method
        if (isset($url[1]) && method_exists($this->currentController, $url[1])) {
            // echo $this->currentMethod ;
            $this->currentMethod = $url[1];  // Set the method if it exists
            unset($url[1]);  // Remove the method from the URL
        }

        // Set the parameters (the rest of the URL)
        $this->params = $url ? array_values($url) : [];

        // echo $this->params[0] ;

        // Call the method with the parameters
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    // Method to get the URL from the request
    public function getUrl() {
        $request = $_SERVER['REQUEST_URI'];
        $request = rtrim($request, '/');
        $request = ltrim($request, '/');

        // Split the URL by '/'
        $request = explode('/', $request);
        $request = array_filter($request);

        return $request ?: ['home']; // Default to 'home' if the URL is empty
    }
}

?>
