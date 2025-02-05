<?php


require_once '../app/core/Controller.php';


class Home extends Controller{

    public function index(){


        // $res = $this->model('Test');

        

        $this->view('homeView', 'front',['num'=> 3452345]);
    
    }

    public function gg(){


        echo 'gg';

    }

    
    


}








?>