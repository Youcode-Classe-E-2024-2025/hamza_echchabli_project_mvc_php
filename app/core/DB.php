<?php

namespace App\core;

use PDO;
use PDOException;

class DB {
    
    private $host = 'localhost';
    private $user = 'hamza';
    private $pass = 'hamza';
    private $dbname = 'traversy';

    private $dbh;
    private $stmt;
    private $error;

    public function __construct() {
        
        $dsn = 'pgsql:host=' . $this->host . ';dbname=' . $this->dbname;
        
        
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        try {
            
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
            echo 'BD connect';
        } catch (PDOException $e) {
            
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    
    public function query($sql) {
        $this->stmt = $this->dbh->prepare($sql);
    }

    
    public function bind($param, $value, $type = null) {
        if (is_null($type)) {
            switch(true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    
    public function execute() {
        return $this->stmt->execute();
    }

    
    public function resultSet() {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    
    public function single() {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    
    public function rowCount() {
        return $this->stmt->rowCount();
    }
}
