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
		//make query to get hash
		$myQ = "SELECT userID, hash FROM Users WHERE user_name ='".$userName."'";
		$result = mysql_query($myQ, $connection) or die('query problem (login hash)'.' '.mysql_error);
		if (mysql_num_rows($result) > 0){
			$hash = mysql_fetch_assoc($result);
			if(password_verify($pass, $hash['hash'])){
				//success!
				print "<h1> success </h1>";
				//set session ID
				$_SESSION['UID']=$hash['userID'];
				$_SESSION['UserName'] = $userName;
			} else {
			//bad password
			print "<h1> Bad Pass </h1>";
			}
		} else {
		//Bad Username
		print "<h1> Bad Username </h1>";
		}
	} else {
	//missing password
	}	
} else {
//Missing user name
}
?>