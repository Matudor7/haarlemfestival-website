<?php

class Repository {

    protected $connection;

    function __construct() {

        require __DIR__ . '/../config/dbconfig.php';

        try {
            $this->connection = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);
                
            // set the PDO error mode to exception
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
          }
    }       
}