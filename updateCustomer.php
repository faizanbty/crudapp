<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include "db_conn.inc";

if (isset($_GET['emp'])) {

    $dat = json_decode($_GET['emp']);

    
    $id = trim($dat->mid);
    $name = trim($dat->name);
    $email = trim($dat->email);
    $pwd = trim($dat->pwd);

    $q1 = "UPDATE `customers` SET `customerName` = '$name', `email` = '$email', `pwd` = '$pwd' WHERE `customers`.`customerNumber` ='$id'";

    $cmd = mysqli_query($conn, $q1);

    if ($cmd) {
        echo json_encode(["success" => 1, "msg" => "User Updated Successfully !"]);
    } else {
        echo json_encode(["success" => 0, "msg" => "User Not Updated !"]);
    }
} else {
    echo json_encode(["success" => 0, "msg" => "Please fill all the required fields!"]);
}
