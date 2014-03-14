<?php
	include ("./inc/header.inc.php");
	if ($user) {
		
	}else{
		die ("You must be logged in to view this page");
	}
?>

<?php
	$updateinfo = $_POST['updateinfo'];
	//First name, Last Name and About the user query
	$get_info = mysql_query("SELECT first_name, last_name, email, bio FROM users WHERE username='$user'");
	  $get_row = mysql_fetch_assoc($get_info);
	  $db_firstname = $get_row['first_name'];
	  $db_lastname = $get_row['last_name'];
	  $db_email = $get_row['email'];
	  $db_bio = $get_row['bio'];

	//Submit the updated information
	  if ($updateinfo) {
		  
	   $firstname = strip_tags(@$_POST['fname']);
	   $lastname = strip_tags(@$_POST['lname']);
	   $email = strip_tags(@$_POST['email']);
	   $bio = strip_tags(@$_POST['bio']);
		   
		if (strlen($lastname) < 3 && strlen($firstname) < 3) {
		echo "<font color='red'>Your first & last name must be 3 more more characters long.</font>";
	   }
	   else
	   if (strlen($firstname) < 3) {
		echo "<font color='red'>Your first name must be 3 more more characters long.</font>";
	   }
	   else
	   if (strlen($lastname) < 3) {
		echo "<font color='red'>Your last names must be 3 more more characters long.</font>";
	   }
	   else
	   if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
		echo "<font color='red'>Invalid email format.</font>";
	   }
	   else
	   {
		//Submit the form to the database
		$info_submit_query = mysql_query("UPDATE users SET first_name='$firstname', last_name='$lastname', email='$email', bio='$bio' WHERE username='$user'");
		echo "<font color='red'>Your profile info has been updated!</font>";
		header("Location: $user");
	   }
	  }
	  else
	  {
	   //Do nothing
	  }
	
	//check whether the user has uploaded a profile pic or not
	$check_pic=mysql_query("SELECT profile_pic FROM users WHERE username='$user'");
	$get_pic_row=mysql_fetch_assoc($check_pic);
	$profile_pic_db=$get_pic_row['profile_pic'];
	if($profile_pic_db==""){
		$profile_pic="img/default_pic.jpg";
	}
	else{
	$profile_pic="userdata/profile_pics/".$profile_pic_db;
	}
	
	//Profile image upload script
	if (isset($_FILES['profilepic'])) {
		if (((@$_FILES["profilepic"]["type"]=="image/jpeg") || (@$_FILES["profilepic"]["type"]=="image/png") || (@$_FILES["profilepic"]["type"]=="image/gif"))	&& (@$_FILES["profilepic"]["size"] < 1048576)) {
			$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			$rand_dir_name = substr(str_shuffle($chars), 0, 15);
			mkdir("userdata/profile_pics/$rand_dir_name");
			
			if (file_exists("userdata/profile_pics/$rand_dir_name/".@$_FILES["profilepic"]["name"])){
				echo @$_FILES["profilepic"]["name"]." Already exists";
		}else{
		move_uploaded_file(@$_FILES["profilepic"]["tmp_name"],"userdata/profile_pics/$rand_dir_name/".$_FILES["profilepic"]["name"]);
		//echo "Uploaded and stored in: userdata/profile_pics/$rand_dir_name/".@$_FILES["profilepic"]["name"];
		
		$profile_pic_name=@$_FILES["profilepic"]["name"];
		$profile_pic_query=mysql_query("UPDATE users SET profile_pic='$rand_dir_name/$profile_pic_name' WHERE username = '$user'");
		header("Location: account_settings.php");
		}
		}
		else{
		echo "Invalid File! Your image must be no larger than 1MB and it must be either a .jpg, .jpeg, .png or .gif";
		}
	}
?>

<h2> Edit Your Profile Info Below</h2>
<hr />
<p>UPLOAD YOUR PROFILE PHOTO:</p>
<form action="" method="POST" enctype="multipart/form-data">
<img src="<? echo $profile_pic; ?>" width="114" />
<input type="file" name="profilepic" /><br />
<input class = "btn btn-info" type="submit" name="uploadpic" value="Upload Image">
</form>
<hr />
<form action="account_settings.php" method="post">
<table width="480" border="0" cellpadding="2" cellspacing="0">
  <tr>
  	<td width="34%">First Name:</td>
    <td width="66%"><input type="text" name="fname" id="fname" size="30" value="<?php echo $db_firstname; ?>"></td>
  </tr>
  <tr>
  	<td width="34%">Last Name:</td>
    <td width="66%"><input type="text" name="lname" id="lname" size="30" value="<?php echo $db_lastname; ?>"></td>
  </tr>
   <tr>
  	<td width="34%">Email Address:</td>
    <td width="66%"><input type="text" name="email" id="email" size="30" Value="<?php echo $db_email; ?>"></td>
  </tr>
   <tr>
  	<td width="34%">About You:</td>
    <td width="66%"><textarea name="bio" id="bio" col="70" rows="6"><?php echo $db_bio; ?></textarea></td>
  </tr>
</table>

<hr />
<input class = "btn btn-info" id="updateinfo" name="updateinfo" type="submit" value="Update" />
</form>
<hr />
<form action="close_account.php" method="post">
<h2>CLOSE ACCOUNT:</h2> <br />
<input class = "btn btn-danger" type="submit" name="closeaccount" id="closeaccount" value="Close My Account">
</form>
<hr />
<br />
<br />