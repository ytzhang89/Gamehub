<?php
	include ("./inc/header.inc.php");
?>


<div class = "container">

	<div class = "row-fluid">
    
    	<div class = "span4 pull-right">
        	<a class = "btn btn-large btn-info" href = "#login" role= "button" data-toggle = "modal">Log In</a>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>


<h4>Interested?</h4>
<h4>Getting Started Here</h4>


<form name="reg" action="code_exec.php" onsubmit="return validateForm()" method="post">
<table width="480" border="0" cellpadding="2" cellspacing="0">
  <tr>
    <td colspan="2">
		<div>
		<?php 
		$remarks=$_GET['remarks'];
		if ($remarks==null and $remarks=="")
		{
		echo 'Sign up with your Email Address';
		}
        if ($remarks=='failure')
		{
		echo "<font color='red'>User Already Exists</font>";
		}
		if ($remarks=='success')
		{
		echo "<font color='red'>Sign up Successful</font>";
		}
		if ($remarks=='allfields')
		{
		echo "<font color='red'>Please fill in all fields</font>";
		}
		if ($remarks=='pswdmatch')
		{
		echo "<font color='red'>Passwords do not match</font>";
		}
		if ($remarks=='emailmatch')
		{
		echo "<font color='red'>Please enter a vaild email address</font>";
		}
		if ($remarks=='strlength')
		{
		echo "<font color='red'>The maximun limit for this field is 25 characters</font>";
		}
		?>	
	    </div></td>
  </tr>
  <tr>
    <td width="66%"><input type="text" name="username" placeholder="Username..."/></td>
  </tr>
  <tr>
    <td><input type="text" name="first_name" placeholder="First Name..."/></td>
  </tr>
  <tr>
    <td><input type="text" name="last_name" placeholder="Last Name..."/></td>
  </tr>
  <tr>
    <td><input type="text" name="email" placeholder="Email Addreess.."/></td>
  </tr>
  <tr>
    <td><input type="password" name="password" size="10" maxlength="15" placeholder="Password..." /></td>
    </tr>
    <tr>
    <td><input type="password" name="password2" size="10" maxlength="15" placeholder="Confirm-Password..." /></td>
  </tr>
</table>
	<p>&nbsp;</p>
    <p><input class = "btn btn-large btn-success" name="submit" type="submit" value="Create Account" /></p>
</form>
        </div>
    
    </div>

</div>


<div class = "navbar navbar-fixed-bottom">
	<div class = "navbar-inner">
    	<div class = "container footer-margin-top">
        	<p class = "muted pull-right"> Created by ZYT CS LF</p>   
        </div>
    </div> 
</div>
    
<div id = "login" class = "modal hide fade">

	<div class = "modal-header">
    	<h3>Log In</h3>
    </div>
    <div class = "modal-body">
    <form name="loginform" action="login_exec.php" method="post">
<table width="480" border="0"  cellpadding="2" cellspacing="5">
  <tr>
    <td colspan="2">
		 <?php
		 	//session_start();
			if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {	
			echo '<ul class="err">';
			foreach($_SESSION['ERRMSG_ARR'] as $msg) {
				echo '<li>',$msg,'</li>'; 
				}
			echo '</ul>';
			unset($_SESSION['ERRMSG_ARR']);
			}
		?>
	</td>
  </tr>
  <tr>
    <td ><div align="left">Username:</div></td>
    <td ><input name="user_login" type="text" /></td>
  </tr>
  <tr>
    <td><div align="left">Password:</div></td>
    <td><input type="password" name="password_login" size="10" maxlength="15"  /></td>
  </tr>
</table>
	<p>&nbsp;</p>
	<input class = "btn btn-large btn-info" name="" type="submit" value="Log In" />
	<button class = "btn btn-large btn-info" data-dismiss = "modal" style="float: right;">Close</button>
</form>
</div>


</body>
</html>
