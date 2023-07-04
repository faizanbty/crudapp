<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: DELETE");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include "db_conn.inc";

if (isset($_GET['emp'])) {

    $dat = json_decode($_GET['emp']);

    $id = trim($dat->mid);


    $query = "DELETE FROM `customers` WHERE `customers`.`customerNumber` ='$id'";

    $cmd = mysqli_query($conn, $query);

    if ($cmd) {

        echo json_encode(["success" => 1, "msg" => "User Deleted."]);
    } else {
        echo json_encode(["success" => 0, "msg" => "User Not Deleted!"]);
    }
} else {
    echo json_encode(["success" => 0, "msg" => "Please fill all the required fields!"]);
}
