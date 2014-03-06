<?PHP
//start the session
session_start();
include('connection.php');

//check if the user is logged in if not redirect him to the sign_in page
if (isset($_SESSION["user_login"])){

//log out code

//destroy the session
session_destroy();

//redirect him to the sign_in page
header("location:index.php");

}else{

header("location:index.php");
}

?>