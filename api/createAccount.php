<?php

$root = $_SERVER['DOCUMENT_ROOT'];
include "$root/auth.php";
$ret = array();

$name = $_POST["name"];
$email = $_POST["email"];
$passwd = $_POST["passwd"];
$gauth = $_POST["g-recaptcha-response"];

if($_SESSION['id']){
    returnJson(array("error"=>"Cannot create an account while logged in"));
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

$prep = $conn->prepare("SELECT * FROM `users_basic` WHERE email LIKE ?");
$prep->bind_param("s",$email);
$prep->execute();

if(mysqli_num_rows($prep->get_result()) > 0){
    returnJson(array('error'=>'Account with this email already exists'));
}

if(!$name || strlen(trim($name)) < 1){
    returnJson(array('error'=>'Missing paramter: name'), 400);
}

if(!$email){
    returnJson(array('error'=>'Missing paramter: email'), 400);
}

if(!$passwd){
    returnJson(array('error'=>'Missing paramter: password'), 400);
}

if(strlen($passwd) < 8){
    returnJson(array('error'=>'Password should contain at least 8 characters'));
}

if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
    returnJson(array('error' => "Only letters and white space allowed in name"),400);
}

if(strlen($name) > 64){
    returnJson(array('error'=>"Name can only contain up to 64 characters"),400);
}

$email = strtolower($email);

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    returnJson(array('error'=>"Invalid email"),400);
}

$domain = array_pop(explode('@', $email));
if($domain != "stu.pulaski.kyschools.us" and $domain != "pulaski.kyschools.us"){
    returnJson(array('error'=>"Only emails associated with Pulaski County Schools are accepted. Example: john.doe@pulaski.kyschools.us, or, john.doe@stu.pulaski.kyschools.us $logic"),400);
}

if(strlen($passwd) < 8){
    returnJson(array('error'=>"Password must be at least 8 characters"),400);
}

if(strlen($passwd) > 32){
    returnJson(array('error'=>"Password can only contain up to 32 characters"),400);
}

$hash = password_hash($passwd,PASSWORD_DEFAULT);
$name = htmlspecialchars_decode($name);
$email = htmlspecialchars_decode($email);
$prep = $conn->prepare("INSERT INTO users_basic (displayname, email, passwd) VALUES (?,?,?)");
$prep->bind_param("sss",$name,$email,$hash);
$prep->execute();

$prep = $conn->prepare("SELECT * FROM `users_basic` WHERE email LIKE ?");
$prep->bind_param("s",$email);
$prep->execute();
$_SESSION["id"] = (mysqli_fetch_array($prep->get_result()))['id'];


returnJson(array('success'=>"Account successfully created"));

die();

?>