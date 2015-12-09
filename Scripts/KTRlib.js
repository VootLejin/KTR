//KTR Javascript Library

function intersectRect(rect1, rect2){
	var r1 = r1.getBoundingClientRect();    //BOUNDING BOX OF THE FIRST OBJECT
    var r2 = r2.getBoundingClientRect();    //BOUNDING BOX OF THE SECOND OBJECT
 
    //CHECK IF THE TWO BOUNDING BOXES OVERLAP
  return !(r2.left > r1.right || 
           r2.right < r1.left || 
           r2.top > r1.bottom ||
           r2.bottom < r1.top);
}

//+ Jonas Raoni Soares Silva
//@ http://jsfromhell.com/math/is-point-in-poly [rev. #0]
 
function isPointInPoly(poly, pt){
    for(var c = false, i = -1, l = poly.length, j = l - 1; ++i < l; j = i)
        ((poly[i].y <= pt.y && pt.y < poly[j].y) || (poly[j].y <= pt.y && pt.y < poly[i].y))
        && (pt.x < (poly[j].x - poly[i].x) * (pt.y - poly[i].y) / (poly[j].y - poly[i].y) + poly[i].x)
        && (c = !c);
    return c;
}

function roughCheckAdjacent (path, svgParent){
	//Checks for intersections
	console.info("This is the value of path: ", path[0]);
	console.info("SVGParent: ", svgParent[0]);
	var box = path[0].getBBox();
	console.info("BBox: ", box);
	
	var xmlns = "http://www.w3.org/2000/svg";
	var elem = document.createElementNS(xmlns, "rect");
	 
	elem.setAttributeNS(null,"x",box.x);
	elem.setAttributeNS(null,"y",box.y);
	elem.setAttributeNS(null,"width",box.width);
	elem.setAttributeNS(null,"height",box.height);
	elem.setAttributeNS(null,"fill", "blue");
	 
	console.log("should be g: ", svgParent[0].lastChild.previousSibling);
	svgParent[0].lastChild.previousSibling.appendChild(elem);

/*	var amt = 1.1;
	var newX = box.x - ((box.x*amt)/2);
	var newY = box.y - ((box.y*amt)/2);
	var newH = box.height * amt;
	var newW = box.width * amt;
	
	
	box.height=newH;
	box.width=newW;
	box.x=newX;
	box.y=newY;
	console.info("after Scale: ", box);*/
	var list = svgParent[0].getIntersectionList(box, svgParent[0]);
	
	console.info("List stuff: ", list);
}

function lazyCheckAdjacent(r1, r2){
	var r1 = r1.getBoundingClientRect();    //BOUNDING BOX OF THE FIRST OBJECT
    var r2 = r2.getBoundingClientRect();    //BOUNDING BOX OF THE SECOND OBJECT
 
    //CHECK IF THE TWO BOUNDING BOXES OVERLAP
    var fudge = 5 //10 is a little high but seems to get the job done
  return !(r2.left-fudge > r1.right+fudge || 
           r2.right+fudge < r1.left-fudge || 
           r2.top-fudge > r1.bottom+fudge ||
           r2.bottom+fudge < r1.top-fudge);
}

function collisionDetection(r1){
	//Collision detection
	var record = "";
	$("path").each(function(index){
		console.log( index + " " + $(r1).attr('id')+", " + $(this).attr('id') + ": " + lazyCheckAdjacent(r1[0],$(this)[0]));
		if(lazyCheckAdjacent(r1[0],$(this)[0])){
			record = recordGraph(r1[0], $(this)[0], record);
		}
		//if(index > 10) {return false};
	});
	
	return record;
}

function recordGraph( node1, node2, rec){
	rec=rec.concat( $(node1).attr('id') + " " + $(node2).attr('id') +";");
	
	return rec;
}

function submitData(datums, map){
	var response = "";
	/*
	var xmlhttp = new XMLHttpRequest(); //Make AJAX Request
				xmlhttp.onreadystatechange = function(){ //When its ready state changes do the thing
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
					response = xmlhttp.responseText; //Shorten variable name
					$('sidebar').html = response;
					}
				}
				xmlhttp.open("POST", "saveMapGraph.php?data=" + data + "&map="+map, true);
				xmlhttp.send();
				*/
				
	$.ajax({
		type: 'POST',
		url: 'saveMapGraph.php',
		data: {'data': datums, 'map': map}
	})
	.done(function(data){
		//Response
		$('#debug').text(data);
	})
	.fail(function(){
		//fail
		$('#debug').text("Failer?");
	});
							
	//window.location.href = "saveMapGraph.php?data=" + data.substring(0,data.length-1) + "&map="+map;
}

function findNeighbor(path, map){
	window.location.href = "neighborFind.php?node=" + path.substring(0,4) + "&map="+map;
}

function scale(box, amt){
	var newX = box.x - ((box.x*amt)/2);
	var newY = box.y - ((box.y*amt)/2);
	var newH = box.height * amt;
	var newW = box.width * amt;
	
	
	box.height=newH;
	box.width=newW;
	box.x=newX;
	box.y=newY;
}