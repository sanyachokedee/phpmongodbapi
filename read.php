<?php

// Allow permission headers 
// เพื่อให้ลองรับ cors และ headers ได้
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


// include database file
require "mongodb_config.php";

$dbname = 'phpeventdb';
$collection = 'users';

// DB connection
$db = new DbManager();
$conn = $db->getConnection();

// read all records
$filter = [];
$option = [];
$read = new MongoDB\Driver\Query($filter, $option);

// fetch records
$records = $conn->executeQuery("$dbname.$collection", $read);

echo json_encode(iterator_to_array($records));