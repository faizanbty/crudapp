<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include "db_conn.inc";

if (isset($_GET['emp'])) {

    $dat = json_decode($_GET['emp']);

    $name = trim($dat->name);
    $email = trim($dat->email);
    $pwd = trim($dat->pwd);

    $q1 = "SELECT count(*) FROM `customers` WHERE email='$email'";
    $cm = mysqli_query($conn, $q1);
    $row = mysqli_fetch_row($cm);

    $noofrec = $row[0];

    if ($noofrec > 0) {
        echo json_encode(["success" => 0, "msg" => "User email id already exist !"]);
    } else {
        $query = "INSERT INTO `customers` (`customerNumber`, `customerName`, `contactLastName`, `contactFirstName`, `phone`, `addressLine1`, `addressLine2`, `city`, `state`, `postalCode`, `country`, `salesRepEmployeeNumber`, `creditLimit`, `email`, `pwd`, `file`, `type`) VALUES (NULL, '$name', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$email', '$pwd', NULL, 'M')";
        $cmd = mysqli_query($conn, $query);
        if ($cmd) {
            $last_id = mysqli_insert_id($conn);
            echo json_encode(["success" => 1, "msg" => "User Inserted Successfully", "id" => $last_id]);
        } else {
            echo json_encode(["success" => 0, "msg" => "Error in Inserting User"]);
        }
    }
} else {
    echo json_encode(["success" => 0, "msg" => "Please fill all the required fields!"]);
}
