<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include "$root/auth.php";
$ret = array();

$email = $_POST["email"];
$passwd = $_POST["passwd"];
$gauth = $_POST["g-recaptcha-response"];

if($_SESSION['id']){
    returnJson(array("error"=>"Already logged in"));
}

if(!$gauth){
    returnJson(array("error"=>"reCAPTCHA challenge failed or not completed"));
}

$gResponse = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$gauth");



if(!$gResponse){
    returnJson(array("error"=>"Problem verifying reCAPTCHA. Please try again later"));
}

$gResponse = json_decode($gResponse);

if(!$gResponse->success){
    returnJson(array("error"=>"reCATPCHA challenge failed"));
} 


if(!$email){
    returnJson(array("error"=>"Missing parameter: email"));
}

if(!$passwd){
    returnJson(array("error"=>"Missing parameter: password"));
}

$prep = $conn->prepare("SELECT * FROM `users_basic` WHERE email LIKE ?");
$prep->bind_param("s",$email);
$prep->execute();
$prep = $prep->get_result();

if(mysqli_num_rows($prep) == 0){
    returnJson(array("error"=>"Account doesn't exist"));
}

$prep = mysqli_fetch_array($prep);

if(password_verify($passwd, $prep['passwd']) == false){
    returnJson(array("error"=>"Incorrect password"));
} 

$_SESSION['id'] = $prep['id'];

returnJson(array("success"=>"Logged in successfully"));


?>