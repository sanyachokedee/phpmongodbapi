<?php

// Allow permission headers 
// เพื่อให้ลองรับ cors และ headers ได้
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database file
require 'mongodb_config.php';

// กำหนดตัวแปรเก็บชื่อ database และ ชื่อ collection
$dbname = "phpeventdb";
$collection = "users";

// Database Connection
$db = new DbManager();
$conn = $db->getConnection();

// print_r($conn);  // แสดงค่าออกมาแบบ Array
 
// รับค่าจาก php
$data = json_decode(file_get_contents("php://input",true));

// บันทึกข้อมูลลงใน Collection
$insert = new MongoDB\Driver\BulkWrite();
$insert->insert($data);

$result = $conn->executeBulkWrite("$dbname.$collection",$insert);

// ตรวจสอบว่าบันทึกสำเร็จหรือไม่
if($result->getInsertedCount() ==1 ){
    echo json_encode(
        array("message" => "Record successfully created")
    );    
} else{
    echo json_encode(
        array("message" => "Error while saving record")
    );
}

