// Some misc. definitions
var sending = false;


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
      return true; // Revert to the regular .php script if there isn't any ajax support. Will throw some JS errors, but hey, what can you do, right? ;)
   }

   return req;

}

// Make the XMLHttpRequest object
var http = createRequestObject();

//	Function used for posting a new entry on the chat page
function sendRequestPost(form_sent, form_user, req_message) {

	var req_username = "";
	var req_email = "";
	var email = "";

	getInput = document.getElementsByTagName("input");
	for (i=0; i< getInput.length; i++) {
			if(getInput[i].name == "req_username") {
				req_username = getInput[i].value;
			}
			if(getInput[i].name == "req_email") {
				req_email = getInput[i].value;
			}
			if(getInput[i].name == "email") {
				email = getInput[i].value;
			}
	}

	// Open PHP script for requests
	http.open('POST', 'chatbox.php', true);
  http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=utf-8');
	var postvars = 'form_sent=' + form_sent + '&form_user=' + form_user.replace(/&/g,"%26") + '&req_message=' + req_message.replace(/&/g,"%26") + '&ajax=1' + '&submit=1' + '&req_username=' + req_username + '&req_email=' + req_email + '&email=' + email;
	http.onreadystatechange = handleResponse;
	http.send(postvars);

	// Disable input fields while posting or refreshing
	disableThis = document.getElementsByTagName("input");
	for (i=0; i< disableThis.length; i++) {
			disableThis[i].disabled = true;
	}

	sending = true; // Let the script know that we're trying to post. Used to empty the textarea afterwards, if successful, while not touching it on a refresh
}


//	Function to refresh the chatbox
function refreshBox() {

	// Open PHP script for requests
	http.open('POST', 'chatbox.php', true);
	http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=utf-8');
	var postvars = 'ajax=1';
	http.onreadystatechange = handleResponse;
	http.send(postvars);

	// Disable input fields while posting or refreshing
	disableThis = document.getElementsByTagName("input");
	for (i=0; i< disableThis.length; i++) {
			disableThis[i].disabled = true;
	}
}


function getHost(hostId) {
	// Open PHP script for requests
	http.open('POST', 'chatbox.php?get_host='+hostId, true);
	http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=utf-8');
	var postvars = 'ajax=1';
	http.onreadystatechange = handleResponse;
	http.send(postvars);
}


// Function to delete specific chatbox posts
function deleteMsg(delThis, usrPostCount) {
	// Open PHP script for requests
	http.open('POST', 'chatbox.php?del='+delThis+'&usr='+usrPostCount, true);
	http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=utf-8');
	var postvars = 'ajax=1';
	http.onreadystatechange = handleResponse;
	http.send(postvars);
	document.getElementById('del'+delThis).innerHTML = 'deleting message&hellip;';
}


//  Function to handle the data we recieve back from the script.
function handleResponse() {

   if(http.readyState == 4 && http.status == 200){

      // Text returned FROM the PHP script
      var response = http.responseText;

      if(response) {
         // UPDATE page with new content
         document.getElementById("scrollbox").innerHTML = response;

        if(window.sending === true) {
         	document.getElementById("req_message").value = "";
        }
				// Re-enable input fields after posting or refreshing
				disableThis = document.getElementsByTagName("input");
				for (i=0; i< disableThis.length; i++) {
						disableThis[i].disabled = false;
				}
      }
   }

}