<?php

class DbManager {

    // Database configuration
    private $host = "localhost";
    private $port = "27017";
    private $conn;

    function __construct(){

        // Connecting to MongoDB
        try{
            $this->conn = new MongoDB\Driver\Manager('mongodb://'.$this->host.':'.$this->port);
        }catch(MongoDBDriverExceptionException $e){
            echo $e->getMessage();
            echo nl2br("n");
        }
    } 

    function getConnection() {
        return $this->conn;
    }
}