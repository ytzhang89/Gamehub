<?php
session_start();
include('connection.php');

$submit = @$_POST['submit'];
//declaring variables to prevent errors
$un = "";
$fn = "";
$ln = "";
$em = "";
$pswd = "";
$pswd2 = "";
$d = "";
$u_check = "";

//registration form
$un = strip_tags(@$_POST['username']);
$fn = strip_tags(@$_POST['first_name']);
$ln = strip_tags(@$_POST['last_name']);
$em = strip_tags(@$_POST['email']);
$pswd = strip_tags(@$_POST['password']);
$pswd2 = strip_tags(@$_POST['password2']);
$d = date("Y-m-d");//year-month-day


if ($submit) {
$u_check = mysql_query("SELECT username FROM users WHERE username='$un'");
$check = mysql_num_rows($u_check);
//check if the user exists
if ($check == 0) {
//check all of the fields
if ($un && $fn && $ln && $em && $pswd && $pswd2) {
//check email address
if (filter_var($em, FILTER_VALIDATE_EMAIL)) {
//check passwords match
if ($pswd=$pswd2) {
//check the length of username/firstname/lastname does not exceed 25 characters
if (strlen($un)>25 || strlen($fn)>25 || strlen($ln)>25) {
header("location: index.php?remarks=strlength");
}else{
	echo 1;
//check the length of password does not exceed 25 characters
if (strlen($pswd)>25 || strlen($pswd2)>25) {
header("location: index.php?remarks=strlength");
}else{
	echo 2;
$pswd = md5($pswd);
$pswd2 = md5($pswd2);

$query = mysql_query("INSERT INTO users VALUES ('', '$un', '$fn', '$ln', '$em', '$pswd', '$d', '0', 'Write something about you!', '', '')");
header("location: index.php?remarks=success");
}
}
}else{
header("location: index.php?remarks=pswdmatch");
}
}else{
header("location: index.php?remarks=emailmatch");
}
}else{
header("location: index.php?remarks=allfields");
}
}else{
header("location: index.php?remarks=failure");
}
}
mysql_close($con);
?>
