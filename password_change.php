<?php
	include ("./inc/header.inc.php");
	if ($user) {
		
	}else{
		die ("You must be logged in to view this page");
	}
?>

<?php
	$senddata = $_POST['senddata'];
	
	//password variables
	$old_password = strip_tags(@$_POST['oldpassword']);
	$new_password = strip_tags(@$_POST['newpassword']);
	$repeat_password = strip_tags(@$_POST['newpassword2']);
	
	
	if ($senddata) {
		
		$password_query = mysql_query("SELECT * FROM users WHERE username='$user'");
		while ($row = mysql_fetch_assoc($password_query)) {
			$db_password = $row['password'];
			
			//md5 the old password before we check if it match
			$old_password_md5 = md5($old_password);
			
			//check whether old password equals the $db_password
			if ($old_password_md5 == $db_password) {
				//continue changing the user's password
				//check if 2 new passwords match
				if ($new_password == $repeat_password) {
					
					$new_password_md5 = md5($new_password);
					
					$password_update_query = mysql_query("UPDATE users SET password='$new_password_md5' WHERE username='$user'");
					
					echo "<font color='red'>Success! Your password has been updated!</font>";
					
				}else{
				echo "<font color='red'>Your two new passwords don't match!</font>";	
				}
				
			}else{
				echo "<font color='red'>The old password is incorrect!</font>";
			}
				
			
		}
		
	}else{
		echo "";
	}
		




?>


<h2> Change Your Password Below</h2>
<hr />
<form action="password_change.php" method="post">
<table width="480" border="0" cellpadding="2" cellspacing="0">
  <tr>
  	<td width="34%">Your Old Password:</td>
    <td width="66%"><input type="password" name="oldpassword" id="oldpassword" size="30" ></td>
  </tr>
  <tr>
  	<td width="34%">Your New Password:</td>
    <td width="66%"><input type="password" name="newpassword" id="newpassword" size="30" ></td>
  </tr>
   <tr>
  	<td width="34%">Confirm-Password:</td>
    <td width="66%"><input type="password" name="newpassword2" id="newpassword2" size="30" ></td>
  </tr>
</table>

<hr />
<input class = "btn btn-large btn-info" id="senddata" name="senddata" type="submit" value="Update" />
</form>