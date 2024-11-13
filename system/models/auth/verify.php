<?php
$CHECK = array();
function clearEmail($value){ 
$value = trim($value); //remove empty spaces
$original = $value;
$value = strip_tags($value); //remove html tags
$value = filter_var($value, FILTER_SANITIZE_EMAIL); //e-mail filter;
$value = filter_var($value, FILTER_VALIDATE_EMAIL);
$value = htmlentities($value, ENT_QUOTES,'UTF-8');
//for major security transform some other chars into html corrispective...
return $value;
}
function clearPassword($value){
$value = trim($value); //remove empty spaces
$original = $value;
$value = strip_tags($value); //remove html tags
$value = filter_var($value, FILTER_SANITIZE_ADD_SLASHES);
$value = filter_var($value, FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW); //remove /t/n/g/s
$value = htmlentities($value, ENT_QUOTES,'UTF-8'); //for major security transform some other chars into html corrispective...
if($original == $value){return $value;}else{return "password_inadatta";}
}
$email = $_POST["email"];
//$_POST["email"] = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
//if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
$email = clearEmail($email);
if((filter_var($email, FILTER_VALIDATE_EMAIL))&&($email != "")) {
echo("0"); $CHECK[0] = "0";
}else{echo("1"); $CHECK[0] = "1"; }
$password = clearPassword($_POST["password"]);
$uppercase = preg_match('@[A-Z]@', $password);
$lowercase = preg_match('@[a-z]@', $password);
$number = preg_match('@[0-9]@', $password);
$specialChars = preg_match('@[^\w]@', $password);
if(!$uppercase || !$lowercase || !$specialChars || !$number || strlen($password) < 8) {
echo("2"); $CHECK[1] = "2";}else{
$CHECK[1] = "0"; echo "0";
}
?>
