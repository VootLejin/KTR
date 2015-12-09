<?php
	$response ="";
	if (filter_has_var(INPUT_POST, "map")){
	
	$connection = mysql_connect("localhost","kguest","butts") or die(mysql_error);
	mysql_select_db("ktr", $connection);
	
	//get Vars
	$mapname=mysql_real_escape_string(filter_input(INPUT_POST, "map"));
	$node1=mysql_real_escape_string(filter_input(INPUT_POST, "node1"));
	$node2=mysql_real_escape_string(filter_input(INPUT_POST, "node2"));
	
	$myQ = <<<HERE
		DELETE FROM $mapname
		WHERE 
		(Node1 =$node1 and
		Node2 =$node2) OR
		(Node1 =$node2 and
		Node2 =$node1)
HERE;
	//Submit Query
	mysql_query($myQ, $connection)or die('query problem (map)'.' '.mysql_error());
	//echo $myQ;
	}
	