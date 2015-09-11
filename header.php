<?php session_start();
//For now print all maps
print <<<HERE
<div id="map-header">
	<div id="maps">
	<a href = "ktr.php?content=default">Main!</a> 
	<a href = "ktr.php?content=map-afr">Africa!</a>
	<a href = "ktr.php?content=map-aus">'Straya mate!</a> 
	<a href = "ktr.php?content=map-na">North America!</a>
	<a href = "ktr.php?content=map-sa">South America!</a>
	<a href = "ktr.php?content=map-eusa">Euraisa!</a>
	<a href = "ktr.php?content=todo"> List of Features to be. </a>
	</div>
HERE;

if(!isset($_SESSION['UID'])){
print <<<HERE
	<div id="login">
	<a href = "ktr.php?content=login"> Login </a> |
	<a href = "ktr.php?content=register">Register</a>
	</div>
HERE;
} else {
	print <<<HERE
	<div id="login">
	User Name: {$_SESSION['UserName']}
	</div>
HERE;
}
	print "</div>";

?>