<?php session_start();
  //Simple CMS
  //Extremely Simple CMS system
  //Andy Harris for PHP/MySQL Adv. Beg 2nd Ed.
  

  //retrieve variables
  if (filter_has_var(INPUT_GET, "menu")){ //Chooose suitable Sidebar Menu
    $menu = filter_input(INPUT_GET, "menu");
  } else {
    $menu = "sidebar.html";
  } // end if

  if (filter_has_var(INPUT_GET, "content")){ //Choose Content
    $content = filter_input(INPUT_GET, "content");
  } else {
    $content = "default";
  } // end if
  
  //Load Libraries
  include ("start.html");
  
  //check for UserLogin actions
  if (filter_has_var(INPUT_GET, "action")){
	if(filter_input(INPUT_GET, "action")=="logout"){
		//logout
		$_SESSION = array();//Unset all session variables
		
		//Kill Sesion and delete session cookie
		if (ini_get("session.use_cookies")) {
			$params = session_get_cookie_params();
			setcookie(session_name(), '', time() - 42000,
				$params["path"], $params["domain"],
				$params["secure"], $params["httponly"]);
		}
	//destroy Session
	session_destroy();
	include ("header.php");
	}
  } else {
	include ("header.php");
  }
  //print "<div class = \"menuPanel\"> \n";
  include ($menu);
  //print "</div> \n";

  print "<div id=\"small-map\"> \n";
  makeContent($content);
  //include ($content);
  print "</div> \n";
  include ("./Scripts/InfoFloater.html");
  include("./Scripts/CollideButton.html");//tears
	//Add after admin stuff is working
		include("debug.html");
	function makeContent($cont){
		
		//Check content type: Rules Element, province, overview, default
		//Check for default
		if ($cont=="default"){
			include("default.html");
		} elseif (substr_compare($cont, "prov", 0, 4)==0){//Looks for "prov" prefix
			include ("contentMaker.php");
			makeProvincePage($cont);
		} elseif (substr_compare($cont, "map-", 0, 4)==0){
			include ("contentMaker.php");
			//include("aus.html");
			print(makeMapPage($cont));
			include("./Scripts/Pathfinding.html");
		} else if ($cont=="todo"){
			include("todo.html");
		} else if ($cont=="login"){
			//Login
			include ("loginPage.html");
		} else if ($cont=="register"){
			include ("registerPage.html");
		} else {
			echo "<h1> Whoops! </h1> <br>";
			//include("aus.html");
		}
		// else if (/*rules element check*/){
			//serve rules element
			//makeRulesPage($cont);
		//} else if (/*overview check*/){
			//serve overview
			//makeOverviewPage($cont);
		//} else { //Error message
			//makeErrorPage($cont);
		//}
	}
?>
</body>
</html>