<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include "db_conn.inc";

if(isset($_GET['emp']))
{
   
$dat= json_decode($_GET['emp']);
 
$name = trim($dat->name);
$email = trim($dat->email);

$query="SELECT * FROM `customers`
WHERE `customerName` like '%$name%' and `email` like '%$email%'";

$cmd=mysqli_query($conn,$query);

$json=array();

while($row=mysqli_fetch_assoc($cmd))
{
    $json[]=$row;
}

echo json_encode($json);
}
else
{
    echo json_encode(["success"=>0,"msg"=>"Please fill all the required fields!"]);
}
?>