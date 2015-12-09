//Path Finding

//Computer F(n)
//f = g + h
//Open set
//Closed Set
var selected = "none";
var ActiveMap;
populateGraph(document.URL.split('-')[1]);


$(document).ready(function(){
	//Pathing
	$('path').click(function(){
		//Check if something selected already
		if(selected = "none"){
			selected = $(this.attr('id').slice(4)); //Designate Selected
		} else { //we already have something selected
			//Find Start and end nodes
			var strt = getNode(selected);
			var nd = getNode($(this.attr('id').slice(4)));
			showPath(moveTo(strt,nd));
		}
	})
})

function getNode(ref){
		for(int i = 0; i < ActiveMap.length; i++){
			if(ActiveMap[i].ID ==ref){
				return ActiveMap[i].ID;
			} 
		}
}

function showPath(path){
	//for now just put in console
	console.info("Path: ", path);
}


//Get info from DB
function populateGraph(mapName){
	var response = "";
	$.ajax({
		type: 'POST',
		url: 'getMap.php',
		data: {'map': mapName}
	})
	.done(function(data){
		//Response
		$('#debug').text(data);
		//Make Data
		//Format NN EE EE EE ;...
		var map = data;
		var start = 0;
		var activeRec = "";
		var done = false;
		var map = [];
		while(!done){
			var SemiPos = map.indexOf(";");
			if(SemiPos == -1){//No more Records
				done = true;
			} else {
				activeRec = map.substr(start, (SemiPos-start));
				//get active node
				var node = {ID: activeRec.substr(0,activeRec.indexOf(" ")), edges:[]};
				activeRec = activeRec.substr(0,activeRec.indexOf(" "));
				//get edges for active node (Edges funtion as two node combo, XX YY)
				while(activeRec.indexOf(" ")!=-1){
					node.edge.push(activeRec.substr(0,activeRec.indexOf(" ")));
				}
			}
			//Move Start forward
			start = SemiPos;
			//add node
			map.push(node);
		}
		ActiveMap = map;
	})
	.fail(function(){
		//fail
		$('#debug').text("Failer? on pupulate Graph");
	});
}

function moveTo(start, end){
	//We have start ID and End ID
	int lowTime = 100;
	var open = [];
	var closed = [];
	open.push(start);
	
	var activeNode = start;
	for(int i = 0; i < open.length; i++){//For every node in open
		//Check distance to exit
		
		//Found it
		if(activeNode == end){
			var current = activeNode;
			var path = [];
			while(current.parent){
				path.push(curent);
				current = current.parent;
			}
			return path.reverse();
		}
		//Searching ... Move active from open to closed
		//remove active from open
		for(int j = 0; j<open.length;j++){
			//Find node
			if(open.[j].ID == activeNode.ID){ //I hope Javascript doesn't do something weird
				open.splice(j,1);
			}
		}
		closed.push(activeNode);
		
		//generate neighbors
		var neighbors = activeNode.edge.slice();
		
		//Move Neighbors to Open, if not closed
		for(int j = 0; j<neighbors.length;j++){
			var activeNeighbor = neighbors[j];
			if(!nodeInList(activeNeighbor,close)){//If the node is not already in the closed list
				var currentDistance = activeNode.dist+1;
				var bestDistance = false;
				if(!nodeInList(activeNeighbor, open)){//if not already in open
					bestDistance = true; //Its adjacent, so its score is best atm
					open.push(activeNeighbor);
				} else if(currentDistance < activeNeighbor.dist){//if current distance better then neighbor distance
				//then best distance
					bestDistance = true;
				}
				if(bestDistance){
					//If we've found a best path
					activeNeighbor.parent = activeNode;
					activeNeighbor.dist = CurrentDistance;
				}
			}
		}
		//No path found
		return [];
	}
}
	function nodeInList(node, list){
		for(int j = 0; j<list.length;j++){
			//Find node
			if(list.[j].ID == node.ID){ //I hope Javascript doesn't do something weird
				return true;
			} else{
				return false;
			}
		}
	}
}