<?php session_start();
//connect to db
$connection = mysql_connect("localhost","kguest","butts") or die(mysql_error);
mysql_select_db("ktr", $connection);
//get Variables
$userName = mysql_real_escape_string(filter_input(INPUT_POST, "username"));
$pass = filter_input(INPUT_POST,"pass");
//Get information from post
if(filter_has_var(INPUT_POST, "username")){
	if (filter_has_var(INPUT_POST, "pass")){
		//check if user name taken
		if (!user_name_taken($userName, $connection)){
		//Need to make sure pass isn't more then 72 characters
		//apparently bcrypt truncs it to that
		$hash = password_hash($pass, PASSWORD_BCRYPT);
		//the password_verify function can take the whole hash, so just save it as that.
		//Hash already includes salt
		$myQ = "INSERT INTO users (UserName,hash) VALUES ('".$userName."','".$hash."')";
		$result = mysql_query($myQ, $connection) or die('query problem (submit register)'.' '.mysql_error);
		
		//For now, just see if everything worked
		print "<h1> It seems to have worked <h1>";
		} else {
		//user name taken
		print "User name taken";
		}
	} else {
	//missing password
	}
	
} else {
//Missing user name
}

function user_name_taken($usr, $connection){
	//query DB
	$myQ = "SELECT UserName FROM users WHERE UserName LIKE '".$usr."'";
	
	//send query
	$result = mysql_query($myQ, $connection) or die('query problem (register)'.' '.mysql_error);
	//if query has less then 1 result: good
	if(mysql_num_rows($result)<1){
		return false;
	} else {
		return true;
	}
}


?>