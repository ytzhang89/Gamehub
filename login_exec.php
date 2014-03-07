<?php
	//Start session
	session_start();
 
	//Include database connection details
	require_once('connection.php');
 
	//Array to store validation errors
	$errmsg_arr = array();
 
	//Validation error flag
	$errflag = false;
 
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
 
	//Sanitize the POST values
	$user_login = clean($_POST['user_login']);
	$password_login = clean($_POST['password_login']);
	$encrypted_password_login=md5($password_login);
 
	//Input Validations
	if($user_login == '') {
		$errmsg_arr[] = "<font color='red'>Username missing</font>";
		$errflag = true;
	}
	if($password_login == '') {
		$errmsg_arr[] = "<font color='red'>Password missing</font>";
		$errflag = true;
	}
 
	//If there are input validations, redirect back to the login form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: index.php");
		exit();
	}
 
	//Check whether the query was successful or not
	if (isset($_POST["user_login"]) && isset($_POST["password_login"])) {
		//Create query
		$qry="SELECT * FROM users WHERE username = '$user_login' AND password = '$encrypted_password_login' LIMIT 1";
		$sql=mysql_query($qry);
		
		$userCount = mysql_num_rows($sql);
		if ($userCount == 1) {
			while($row = mysql_fetch_array($sql)){
			$id = $row["id"];
			}
			$_SESSION["id"] = $id;
			$_SESSION["user_login"] = $user_login;
			$_SESSION["password_login"] = $password_login;
			header("location: home.php");
			exit();
		}else{
		//Login failed
			$errmsg_arr[] = "<font color='red'>Username and Password not found</font>";
			$errflag = true;
			if($errflag) {
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				header("location: index.php");
				exit();
			}
		}
	}else {
		die("Query failed");
	}

?>