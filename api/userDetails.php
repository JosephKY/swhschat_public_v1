<?php

$root = $_SERVER['DOCUMENT_ROOT'];
include "$root/auth.php";
$ret = array();

$id = $_GET["id"];

if(!$id){
    returnJson(array("error"=>"Missing parameter: id"));
}

if(!is_numeric($id)){
    returnJson(array("error"=>"Invalid id"));
}

$id = round(intval($id));

$collected = $conn->query("SELECT * FROM users_basic WHERE id LIKE $id");

if(mysqli_num_rows($collected) == 0){
    returnJson($ret);
}

$collected = $collected->fetch_assoc();

$getting = array("displayname","created");

foreach($getting as &$the){
    $ret[$the] = $collected[$the];
}

returnJson($ret);

?>