<?php
// Connect to server and select databse.
//mysql_connect("eu-cdbr-azure-west-b.cloudapp.net", "be1a7d8c1e05ec", "9b94feea")or die("cannot connect"); 
//mysql_select_db("gamehuba9mv7nxeb")or die("cannot select DB");

// DB connection info
$host = "eu-cdbr-azure-west-b.cloudapp.net";
$user = "be1a7d8c1e05ec";
$pwd = "9b94feea";
$db = "gamehuba9mv7nxeb";
// Connect to database.
try {
    $conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch(Exception $e){
    die(var_dump($e));
}

?>