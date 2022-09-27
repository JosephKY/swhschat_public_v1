<?php

$root = $_SERVER['DOCUMENT_ROOT'];
include "$root/auth.php";
$ret = array();

$amount = $_GET["amount"];

if(!$amount){
    returnJson(array("error"=>"Amount parameter not satisfied"));
}

if(!is_numeric($amount)){
    returnJson(array("error"=>"Amount parameter must be a number"));
}

$amount = floor(intval($amount));

if($amount < 1 || $amount > 10){
    returnJson(array("error"=>"Amount must be between 1 and 10"));
}

$usrs = $conn->query("SELECT * FROM users_basic ORDER BY id DESC LIMIT $amount");
while ($row = mysqli_fetch_assoc($usrs)) {
    $push = array();
    $push['id'] = $row['id'];
    $push['displayname'] = $row['displayname'];
    $push['created'] = $row['created'];
    array_push($ret, $push);
}

returnJson($ret);

?>