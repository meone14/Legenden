<?php
//Her forbinder vi til databasen
$link = mysql_connect("localhost", "root", "");
//$link = mysql_connect("localhost", "laur4295", "5TwWVtZxzFKSyvWt");
    global $database;
	$database = mysql_select_db("bilkort", $link);
    
    $_SESSION['datab'] = $database;
?>