<?php


require_once '../app/core/Controller.php';


class Home extends Controller{

    public function index(){

        $this->view('homeView', 'front');
    
    }

    public function gg(){


        echo 'gg';

    }

    
    


}








?>