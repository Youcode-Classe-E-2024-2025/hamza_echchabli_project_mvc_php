<?php

class Controller {

    public $data = [
        'test' => ['firstName', 'secondName', 'age'],
    ]; 

    
    public function model($model) {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }

    
    public function view($view, $side ,$data = []) {

        require_once '../app/viewsfront/homeView.php';

        if (file_exists('../app/views'.$side.'/' . $view . '.php')) {
            extract($data); 
            require_once '../app/views'.$side.'/' . $view . '.php';
        } else {
            die('View does not exist');
        }
    }

    public function redirect($url) {
        header('Location: ' . $url);
        exit();
    }

}

?>
