///////////////////////////////////////////
// Script by codexp[at]tasarinan[dot]com //
///////////////////////////////////////////

// How often will the content be refreshed (in seconds)
// Don't set it to low, as that might put a lot of extra stress on the server.
var timer = 15;

// Header text. change this to your liking (default text is from PunBB's common.php).
var loadTxtNo = '<span>Active public topics</span>'; // Text when not loading
var loadTxt = '<span>Active public topics: Refreshing&hellip;</span>'; // Text while refreshing

// This var is used to help prevent IE from caching the results.
var rnd = Math.random;

// The query to run agains extern.php (incl. the scripname itself).
// I would recomment you to add the following to your extern.php, so that you can choose
// how long the topic titles displayed can be:
//
// Directly after line 104, add:
//
// if(isset($_GET['length']))
//    $max_subject_length = intval($_GET['length']);
//
var extern_query = 'extern.php?action=active&show=10&length=100&rnd='+rnd;

//	Check if our browser will support this...
function createRequestObject() {

   var req;

   if(window.XMLHttpRequest){
      // Firefox, Safari, Opera...
      req = new XMLHttpRequest();
   } else if(window.ActiveXObject) {
      // Internet Explorer 5+
      req = new ActiveXObject("Microsoft.XMLHTTP");
   } else {
      return false;
   }
   return req;
}


// Make the XMLHttpRequest object
var http = createRequestObject();

AJAX_BLOCK: {

if(http===false) {
	break AJAX_BLOCK; // We'll break the script here if the browser doesn't support AJAX
}

// Write out the block only if browser supports AJAX
document.write('<div id="rssbox" class="block"><h2 id="rsshead">'+loadTxt+'</h2><div class="box"><div class="inbox"><ul id="rsslist"></ul></div></div></div>');

function getTopics() {

	http.open('GET', extern_query, true);
	http.setRequestHeader("If-Modified-Since", "Sat, 1 Jan 1990 00:00:00 GMT"); // Prevent IE from caching the results
	http.onreadystatechange = handleResponse_extern;
	http.send(null);
	document.getElementById('rsshead').innerHTML = loadTxt;
	// Refresh list of topics ever X*1000msec.
	window.setTimeout(getTopics, timer*1000);
}


//  Function to handle the data we recieve back from the script.
function handleResponse_extern() {

   if(http.readyState == 4 && http.status == 200){

      var response = http.responseText;

      if(response) {
         // UPDATE page with new content
         document.getElementById("rsslist").innerHTML = response;
				 document.getElementById('rsshead').innerHTML = loadTxtNo;
      }
   }
}

// Update the active topics list when the page loads
window.onload = getTopics;

}