// BROWSER DETECTION
// This is a standard-ish browser detection script
// based on something fished off the internet somewhere...

var detect = navigator.userAgent.toLowerCase();
var OS,browser,version,total,thestring;

if (checkIt('konqueror'))
{
	browser = "Konqueror";
	OS = "Linux";
}
else if (checkIt('safari')) browser = "Safari"
else if (checkIt('omniweb')) browser = "OmniWeb"
else if (checkIt('opera')) browser = "Opera"
else if (checkIt('webtv')) browser = "WebTV";
else if (checkIt('icab')) browser = "iCab"
else if (checkIt('msie')) browser = "Internet Explorer"
else if (!checkIt('compatible'))
{
	browser = "Netscape Navigator"
	version = detect.charAt(8);
}
else browser = "An unknown browser";

if (!version) version = detect.charAt(place + thestring.length);

if (!OS)
{
	if (checkIt('linux')) OS = "Linux";
	else if (checkIt('x11')) OS = "Unix";
	else if (checkIt('mac')) OS = "Mac"
	else if (checkIt('win')) OS = "Windows"
	else OS = "an unknown operating system";
}

function checkIt(string)
{
	place = detect.indexOf(string) + 1;
	thestring = string;
	return place;
}


// And this is a multi-browser getobject thing - don't really know if it works though
// Again, the source is lost on me...


function mbgetobject(objectname){

	if (document.getElementById) {
		// Standard Browsers
		var ourobject = document.getElementById(objectname);
	} else if (document.all) {
		// Old msinternetexploiter
		var ourobject = document.all[objectname];
	} else if (document.layers) {
		// nn4
		var ourobject = document.layers[objectname];
	}
	return ourobject;
}
