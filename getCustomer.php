<?php
header("Acces-Control-Allow-Origin: *");
header("Acces-Control-Allow-Headers: access");
header("Acces-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include "db_conn.inc";

// QUERY
$query = "select * from customers";
$cmd = mysqli_query($conn, $query);

$json = array();

while ($row = mysqli_fetch_assoc($cmd)) {
    $json[] = $row;
}

echo json_encode($json);

?>
