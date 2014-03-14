<?php
// Connect to server and select databse.
mysql_connect("localhost", "arsenalchem", "thisisarsenal")or die("cannot connect"); 
mysql_select_db("game_database")or die("cannot select DB");
?>