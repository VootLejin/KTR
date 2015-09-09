<?php


	
if (filter_has_var(INPUT_GET, "node")){
	$connection = mysql_connect("localhost","kguest","butts") or die(mysql_error);
	mysql_select_db("ktr", $connection);
	//initialize variables
	$myNode = mysql_real_escape_string(filter_input(INPUT_GET, "node"));
	$map = mysql_real_escape_string(filter_input(INPUT_GET, "map"));
	$myQ = "SELECT Node2 From ".$map." WHERE Node1=".$myNode." AND Node2 <> Node1";
	
	$result = mysql_query($myQ, $connection) or die('query problem(neighborFind.php)'.' '.mysql_error());
	$neighbors = "";
	if(mysql_num_rows($result)<1){
	 return "-1";
	} else {
		
		while ($row = mysql_fetch_array($result)){
			$neighbors.= $row[0].";";
		}

		$neighbors = substr($neighbors, 0, -1);
		print $neighbors;
		return $neighbors;
	}
}
?>