<?php

//if(!array_key_exists("HTTPS",$_SERVER)){
//    http_response_code(403);
//    die();
//}

$siteKey = '6LfweyUiAAAAAO5in_yCtI16Jf8YPrpuCJLNI2vP';
$secretKey = '';

$cry = true;

error_reporting(FALSE);
if($cry){
    error_reporting(E_ERROR | E_PARSE);
}

session_start();

$conn = new mysqli("31.22.4.109","redacted","redacted","redacted");

if ($conn -> connect_errno) {
    if($cry){
        echo "Failed to connect to MySQL: " . $conn -> connect_error;
    }
    exit();
}

$usr = array();

$usr['id'] = 0;
$usr['login'] = false;
if($_SESSION["id"]){
    $usr['id'] = $_SESSION['id'];
    $usr['login'] = true;
} 

$idTemp = $usr['id'];
$usrData = $conn->query("SELECT * FROM `users_basic` WHERE id LIKE $idTemp");

if(mysqli_num_rows($usrData) > 0){
    $usrData = mysqli_fetch_array($usrData);
} else {
    $usrData = array();
}

$fetch = array("displayname","email","created");

if(count($usrData) > 0){
    foreach($fetch as &$get){
        if(array_key_exists($get, $usrData)){
            $usr[$get] = $usrData[$get];
        }
    }
}

function returnJson($arr,$code=200){
    http_response_code($code);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($arr);
    die();
}

?>