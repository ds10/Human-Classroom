var prevobject;
var prevyear;

function toggleLayer(whichLayer) {
	
	
	
	if (document.getElementById) {
		// Standard Browsers
		var ourobject = document.getElementById(whichLayer).style;
	} else if (document.all) {
		// Old msinternetexploiter
		var ourobject = document.all[whichLayer].style;
	} else if (document.layers) {
		// nn4
		var ourobject = document.layers[whichLayer].style;
	}
	
	if (ourobject.display == "none") {
		ourobject.display="block";
	} else {
		if (ourobject!=prevobject){
		ourobject.display="none";
		}
	}
	

	if (prevobject){
		if (prevobject!=ourobject){
		if (prevobject.display != "none") {
			prevobject.display="none";
		}}
	}
	
	prevobject=ourobject;
	

	
	hidesearchobject();
}

function toggleYear(whichYear){


	whichLayer=whichYear;
	
	if (document.getElementById) {
		// Standard Browsers
		var ourobject = document.getElementById(whichLayer).style;
	} else if (document.all) {
		// Old msinternetexploiter
		var ourobject = document.all[whichLayer].style;
	} else if (document.layers) {
		// nn4
		var ourobject = document.layers[whichLayer].style;
	}
	
	if (ourobject.display == "none") {
		ourobject.display="block";
	} else {
		//if (ourobject!=prevyear){
		ourobject.display="none";
		//}
	}
	

	if (prevyear){
		if (prevyear!=ourobject){
		if (prevyear.display != "none") {
			prevyear.display="none";
		}}
	}
	
	prevyear=ourobject;
	
}

function hidesearchobject(){

	whichLayer="searchresults";
	
	if (document.getElementById) {
		// Standard Browsers
		var ourobject = document.getElementById(whichLayer).style;
	} else if (document.all) {
		// Old msinternetexploiter
		var ourobject = document.all[whichLayer].style;
	} else if (document.layers) {
		// nn4
		var ourobject = document.layers[whichLayer].style;
	}
	ourobject.display="none";
}