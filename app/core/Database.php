<?php

namespace app\core;

use PDO;
use PDOException;

class Database {
    private PDO $connection;

    public function __construct() {
        

        $dsn = "pgsql:host=localhost;dbname=mvc";

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $this->connection = new PDO($dsn, 'hamza', 'hamza', $options);
            
            // Set the search path to public schema
            $this->connection->exec('SET search_path TO public');
            
            // Verify connection
            $this->connection->query('SELECT 1');
        } catch (PDOException $e) {
            throw new \Exception("Database connection error: " . $e->getMessage());
        }
    }

    public function getConnection(): PDO {
        return $this->connection;
    }
}
