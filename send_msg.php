<?
include ("./inc/header.inc.php");

if (isset($_GET['u'])) {
	$username = mysql_real_escape_string($_GET['u']);
	if (ctype_alnum($username)) {
 	//check user exists
	$check = mysql_query("SELECT username FROM users WHERE username='$username'");
	if (mysql_num_rows($check)===1) {
	$get = mysql_fetch_assoc($check);
	$username = $get['username'];
	
	//Check user isn't sending themself a private message
	if ($username != $user) {
          if (isset($_POST['submit'])) {
            $msg_title = strip_tags(@$_POST['msg_title']);
            $msg_body = strip_tags(@$_POST['msg_body']);
            $date = date("Y-m-d");
            $opened = "no";
            $deleted = "no";
            
            if ($msg_title == "Enter the message title here ...") {
             echo "<font color='red'>Please give your message a title.</font>";
            }
            else
            if (strlen($msg_title) < 3) {
             echo "<font color='red'>Your message title cannot be less than 3 characters in length!</font>";
            }
            else
            if ($msg_body == "Enter the message you wish to send ...") {
             echo "<font color='red'>Please write a message.</font>";
            }
            else
            if (strlen($msg_body) < 3) {
             echo "<font color='red'>Your message cannot be less than 3 characters in length!</font>";
            }
            else
            {

            $send_msg = mysql_query("INSERT INTO pvt_messages VALUES ('','$user','$username','$msg_title','$msg_body','$date','$opened', '$deleted')");
           echo "<font color='red'>Your message has been sent!</font>";
            }
          }
        echo "
        
        <form action='send_msg.php?u=$username' method='POST'>
        <h2>Send a Message to: ($username)</h2>
        <input type='text' name='msg_title' size='30' onClick=\"value=''\" value='Enter the message title here ...'><p />
        <textarea cols='50' rows='12' name='msg_body'>Enter the message you wish to send ...</textarea><p />
        <input class = 'btn btn-large btn-info' type='submit' name='submit' value='Send Message'>
        </form>

        ";
        }
        else
        {
         header("Location: $user");
        }
	}
	}
}
?>