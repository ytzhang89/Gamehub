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
				
             	$username = $results['username'];
                echo "<p><h3><a href='$username'>".$results['username']."</a></h3>".$results['email']."</p>";
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

