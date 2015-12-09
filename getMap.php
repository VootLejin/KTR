<?php
$connection = mysql_connect("localhost","kguest","butts") or die(mysql_error);
mysql_select_db("ktr", $connection);
if (filter_has_var(INPUT_POST, "map")){
	$id = filter_input(INPUT_POST, "map");
	$myQ = "SELECT Node1, Node2 FROM ".$id." ORDER BY Node1 ASC";
	$result = mysql_query($myQ, $connection) or die('query problem(getInfo.php)'.' '.mysql_error());
	if(mysql_num_rows($result)<1){
		echo "Bad Name";
	} else {
		$desc = "";
		//Need to format as, NN EE EE EE ; NN EE ....
		$currentNode = mysql_result($result, 0);//First Node
		$desc = "".$currentNode." ";
		while($row = mysql_fetch_array($result, MYSQL_NUM)){
			if($row[0] != $currentNode){//If we have a new node
				$currentNode = $row[0];//working node is new node
				//Add records to desc
				$desc = $desc.";".$currentNode." ";
			}
			if($row[0]!=$row[1]){//Make sure we don't add same node
				$desc = $desc.$row[1]." ";//Other wise add the neighboring node
			}
		}
		echo $desc;
	
	}
}
?>