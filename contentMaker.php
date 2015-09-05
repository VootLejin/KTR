<?php
//Set up Connection to MySQL Server


//Generate Page Functions:
//province
function makeProvincePage($cont){
	$connection = mysql_connect("localhost","kguest","butts") or die(mysql_error);
	mysql_select_db("ktr", $connection);
	//Displays ID and Name
	//If it doesn't exist: option to add
	
	//clear out kruft
	$cont = mysql_real_escape_string(substr($cont, 4));
	
	//make query for finding name
	$myQ = "SELECT Name FROM Province WHERE ProvinceID =".$cont;//In the future see what "Forms" are for SQL
	if(!$connection){
		die('No connection boss. '.mysql_error);
	}
	$result = mysql_query($myQ, $connection) or die('query problem'.' '.mysql_error);
	if(mysql_num_rows($result)<1){
		//Need to make new record so...
		//Make a form
		$formStart="<form action=\"MakeProvince.php\">";//TODO: Change to AJAX
		
		//Province Number
		$number="ProvinceID=".$cont."<br>"."<input type=\"hidden\" name=\"id\" value=\"".$cont."\" />";
		
		//Make box to get name
		$name="Province Name: <input type=\"text\" name=\"pname\"><br>";
		
		//Add button to submit change
		$button="<input type=\"submit\" value=\"Submit\">";
		$formEnd="</form>";
		print $formStart.$number.$name.$button.$formEnd;
	} else {
		//Province info
		print "<h1>ProvinceID: ".$cont."</h1><br>";
		print "<h2>Province Name: ".mysql_result($result, 0)."</h2><br>";
		//Change Name Button
		//Submit Name Change button
		
	}
}

//Map
function makeMapPage($cont){
	$connection = mysql_connect("localhost","kguest","butts") or die(mysql_error);
	mysql_select_db("ktr", $connection);
	//Temporarily...
	//include ("aus.html");
	
	//clear out kruft
	$cont = mysql_real_escape_string(substr($cont, 4));
	
	//Name for CSS
	//$map .= "<h1> Drop Bears! </h1> <br>";
	//add Map --Hope this works
	$map = file_get_contents(strtoupper($cont).".svg");
	
	return $map;
	
}
//rules
//overview
//error
?>