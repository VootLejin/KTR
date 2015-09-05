<?php
	$response ="";
	if (filter_has_var(INPUT_GET, "map")){
	
	$connection = mysql_connect("localhost","kguest","butts") or die(mysql_error);
	mysql_select_db("ktr", $connection);
	
	
		//get Vars
		$mapname=mysql_real_escape_string(filter_input(INPUT_GET, "map"));
		//Make Table
		$myQ = <<<HERE
		CREATE TABLE $mapname (
		Node1 int,
		Node2 int)
HERE;
		//Submit Query
		//response.= "MAP QUERY: ".
		mysql_query($myQ, $connection)or die('query problem (map)'.' '.mysql_error());
		
		//Data time
		$rawdata = mysql_real_escape_string(filter_input(INPUT_GET, "data"));
		$datums = explode(";", $rawdata);
		foreach($datums as $fullLine){
			$edges = explode(" ", $fullLine);
			$Q2 = "INSERT INTO " .$mapname . " (Node1, Node2) VALUES(".substr($edges[0],4) . ",". substr($edges[1],4).")";
			echo $Q2;
			mysql_query($Q2, $connection) or die('query problem (data)'.' '.mysql_error());
		}
	}
	//return response;
?>