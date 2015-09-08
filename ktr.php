<?php 
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
  include ("start.html");
  include ("header.html");

  //print "<div class = \"menuPanel\"> \n";
  include ($menu);
  //print "</div> \n";

  print "<div id=\"small-map\"> \n";
  makeContent($content);
  //include ($content);
  print "</div> \n";
  include ("./Scripts/InfoFloater.html");
  include("./Scripts/CollideButton.html");//tears

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
		} else if ($cont=="todo"){
			include("todo.html");
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