<?php
	include ("./inc/header.inc.php");
?>
<?php
    $query = $_GET['query']; 
     
    $min_length = 1;
     
    if(strlen($query) >= $min_length){ 
         
        $query = htmlspecialchars($query); 
        // changes characters used in html to their equivalents, for example: < to &gt;
         
        $query = mysql_real_escape_string($query);
        // makes sure nobody uses SQL injection
         
        $raw_results = mysql_query("SELECT * FROM users
            WHERE (`username` LIKE '%".$query."%') OR (`email` LIKE '%".$query."%')") or die(mysql_error());
			
            
         
        // '%$query%' is what we're looking for, % means anything, for example if $query is Hello
        // it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
        // or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'
         
        if(mysql_num_rows($raw_results) > 0){ 
             
            while($results = mysql_fetch_array($raw_results)){
				
                                                $get_user_info = mysql_query("SELECT * FROM users WHERE username='$username'");
                                                $get_info = mysql_fetch_assoc($get_user_info);
                                                $profilepic_info = $get_info['profile_pic'];
                                                if ($profilepic_info == "") {
                                                 $profilepic_info = "./img/default_pic.jpg";
                                                }
                                                else
                                                {
                                                 $profilepic_info = "./userdata/profile_pics/".$profilepic_info;
                                                }				
				
				
             	$username = $results['username'];
                echo "<div style='float: left;'>
                      	<img src='$profilepic_info' width='60'>
                      </div>
					  <div class='posted_by'>
					  	<h3><a href='$username'>".$results['username']."</a></h3>".$results['email']."</div>";
                // can also show id ($results['id'])
            	echo "<br />";
				echo "<hr />";
				echo "<br />";
			}
             
        }
        else{ 
            echo "No results";
        }
         
    }
    else{ 
        echo "Minimum length is ".$min_length;
    }
?>

