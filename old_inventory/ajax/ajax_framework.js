/* ---------------------------- */
/* XMLHTTPRequest Enable 	*/
/* ---------------------------- */

function createObject() {
	var request_type;
	var browser = navigator.appName;
	if(browser == "Microsoft Internet Explorer"){
		request_type = new ActiveXObject("Microsoft.XMLHTTP");
	}else{
		request_type = new XMLHttpRequest();
	}
	return request_type;
}

var http = createObject();

/* -------------------------- */
/* SEARCH		      */
/* -------------------------- */

function autosuggest() {
	q = document.getElementById('search-q').value;
	document.getElementById('msg').style.display = "block";
	document.getElementById('msg').innerHTML = "Searching for <strong>" + q+"";
	// Set te random number to add to URL request
	nocache = Math.random();
	http.open('get', 'in-search.php?q='+q+'&nocache = '+nocache);
	http.onreadystatechange = autosuggestReply;
	http.send(null);
}

function autosuggestReply() {
	if(http.readyState == 4){
		var response = http.responseText;
		if(response!=""){
			document.getElementById('results').innerHTML=response;
			document.getElementById('results').style.display="block";
		} else {
		document.getElementById('results').style.display="none";
		}
	}
}
