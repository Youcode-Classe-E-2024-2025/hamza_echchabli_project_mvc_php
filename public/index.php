<?php    
ini_set('display_errors', 1);
error_reporting(E_ALL);


require_once '../app/core/Router.php';
require_once __DIR__ . '/../vendor/autoload.php';



use App\core\DB;



$testDB= new DB;

$testDB->query('select students.name from students ;');


$R = new Router;










