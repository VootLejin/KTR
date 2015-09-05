<?php

//Super HTML is an object built with the title, and then has methods to add 
//Content to the page.
//CSS made with this method should have the same name as their Pages,
// but with Underscores "_" inplace of spaces.

class SuperHTML{
	function __construct($tTitle = "Super HTML"){
	$this->setTitle($tTitle);
	}
	function getPage(){
		return $this -> thePage;
	}
	
	function addText($myText){
		$this->thePage .=$myText;
		$this->thePage .="\n";
	}
	
	function buildTop(){
		$cssFile = str_replace(" ", "_", $this->title);
		$temp=<<<HERE
		<head>
			<title>$this->title</title>
			<link 	rel = "stylesheet"
					type = "text/css"
					href = "$cssFile.css" />
		</head>
		<body>
		<div id="wrapper">
			<div id="map-header">
			Map header sample text! Affrica! Aisa! Austrailia! North America! South America! Euraisa! 
			These should link to the maps of their respective areas.
			</div>
			<div id ="sidebar">
			Sidebar sample text!
			Rules Elements!
			Rules Elements!!
			MORE RULES ELEMENTS!!!
			These should be on individual lines.
			</div>
			<div id = "small-map">
			Small map goes here?!
			</div>
		</div>
HERE;
		$this->addText($temp);
	}
	
	function buildBottom(){
		$temp=<<<HERE
</body>
</html>
HERE;
		$this->addText($temp);
	}
	
}

?>