<?php
$connection = mysql_connect("localhost","kguest","butts") or die(mysql_error);
mysql_select_db("ktr", $connection);
if (filter_has_var(INPUT_GET, "id")){
	$id = filter_input(INPUT_GET, "id");
	$myQ = "SELECT Name FROM Province WHERE ProvinceID ='".$id."'";
	$result = mysql_query($myQ, $connection) or die('query problem(getInfo.php)'.' '.mysql_error());
	if(mysql_num_rows($result)<1){
		echo "Unnamed";
	} else {
		$name = mysql_result($result, 0);
		echo $name;
	
	}
}
?>