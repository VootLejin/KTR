
<?php
	//Conection shizwa
	$connection = mysql_connect("localhost","kguest","butts") or die(mysql_error);
	mysql_select_db("ktr", $connection);
	
	//This all can probably be not a seperate page
	include ("start.html");//temp
	include ("header.html");
	print "<div id=\"small-map\"> \n";
	//Adds Provinces-- This can probably be streamlined a bit better
	if (filter_has_var(INPUT_GET, "id")){
		if(filter_has_var(INPUT_GET, "pname")){	
			//Final version should do various sanity checks:
			//Proper user
			//Proper permissions
			//etc.
			//But this is test so add that later
			
			//Fetch variables
			$ID = mysql_real_escape_string(filter_input(INPUT_GET, "id"));
			$name = mysql_real_escape_string(filter_input(INPUT_GET, "pname"));
			
			$query = "INSERT INTO Province (ProvinceID, Name) VALUES (".$ID.", '".$name."')";
			
			if (mysql_query($query, $connection)){
				//Works
				echo "Success! <a href=\"ktr.php\">Back to main</a>";
			} else {
				//Doesn't work
				echo "Failure. <a href=\"ktr.php\">Back to main</a>";
			}
		}
	}
	print "</div> \n";
?>
</body>
</html>