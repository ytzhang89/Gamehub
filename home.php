<?php
	include ("./inc/header.inc.php");
?>
<?php
if (!isset($_SESSION["user_login"])) {
    echo "<meta http-equiv=\"refresh\" content=\"0; >";
}
else
{
?>
<div class="newsFeed">
<h2>Your Newsfeed:</h2>
</div>
<?php
$getposts = mysql_query("SELECT COUNT(*) FROM posts WHERE user_posted_to='$user' ORDER BY id DESC") or die(mysql_error());
$r = mysql_fetch_row($getposts);
$numrows = $r[0];

$rowsperpage = 5;
$totalpages = ceil($numrows / $rowsperpage);

if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
   
   $currentpage = (int) $_GET['currentpage'];
} else {
   
   $currentpage = 1;
} 


if ($currentpage > $totalpages) {
   
   $currentpage = $totalpages;
} 

if ($currentpage < 1) {
   
   $currentpage = 1;
} 

 
$offset = ($currentpage - 1) * $rowsperpage;




//If the user is logged in
$getposts = mysql_query("SELECT * FROM posts WHERE user_posted_to='$user' ORDER BY id DESC LIMIT $offset, $rowsperpage") or die(mysql_error());
while ($row = mysql_fetch_assoc($getposts)) {
						$id = $row['id'];
						$body = $row['body'];	
						$date_added = $row['date_added'];
						$added_by = $row['added_by'];
						$user_posted_to = $row['user_posted_to'];  

                                                $get_user_info = mysql_query("SELECT * FROM users WHERE username='$added_by'");
                                                $get_info = mysql_fetch_assoc($get_user_info);
                                                $profilepic_info = $get_info['profile_pic'];
                                                if ($profilepic_info == "") {
                                                 $profilepic_info = "./img/default_pic.jpg";
                                                }
                                                else
                                                {
                                                 $profilepic_info = "./userdata/profile_pics/".$profilepic_info;
                                                }

                                                ?>

<script language="javascript">
         function toggle<?php echo $id; ?>() {
           var ele = document.getElementById("toggleComment<?php echo $id; ?>");
           var text = document.getElementById("displayComment<?php echo $id; ?>");
           if (ele.style.display == "block") {
              ele.style.display = "none";
           }
           else
           {
             ele.style.display = "block";
           }
         }
</script>

                                               <?php
						echo  "

						<p />
						<div class='newsFeedPost'>
						<div class='newsFeedPostOptions'>
                                                <a href='#' onClick='javascript:toggle$id()'>Show Comments</a>
						</div>
                                                <div style='float: left;'>
                                                <img src='$profilepic_info' width='60'>
                                                </div>
						<div class='posted_by'>$added_by posted this on your profile:</div>
                                                <br /><br />
                                                <div  style='max-width: 600px;'>
                                                $body<br /><p /><p />
                                                </div>
                                                <div id='toggleComment$id' style='display: none;'>
                                                <br />
                                                <iframe src='./comment_frame.php?id=$id' frameborder='0' style='max-height: 150px; width: 100%; min-height: 10px;'></iframe>
                                                </div>
                                                <p />
                                                </div>
						";
}
$range = 5;


if ($currentpage > 1) {
   
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=1'><<</a> ";
   
   $prevpage = $currentpage - 1;
  
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage'><</a> ";
} 


for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
   
   if (($x > 0) && ($x <= $totalpages)) {
   
      if ($x == $currentpage) {
         
         echo " [<b>$x</b>] ";
      
      } else {
        
         echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$x'>$x</a> ";
      } 
   }  
} 
                 
        
if ($currentpage != $totalpages) {
  
   $nextpage = $currentpage + 1;
    
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage'>></a> ";
   
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages'>>></a> ";
} 


}
?>