function sb_refresh() {
	var ajaxRequest = new XMLHttpRequest();
	var params = "action=" + encodeURIComponent("update");
	ajaxRequest.open("POST", "/shout.php", true);
	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxRequest.onreadystatechange = function() {
		if (!(ajaxRequest.readyState === 4 && ajaxRequest.status === 200)) {
			document.getElementById("shoutbox").innerHTML = ajaxRequest.responseText;	
			return false;
		}
	}	
	ajaxRequest.send(params);	
	var chatbox = document.getElementById("shoutbox");
	chatbox.scrollTop = chatbox.scrollHeight;
	return false;
}

function sb_message() {
	var name = document.getElementById("sbname").value;
	var message = document.getElementById("sbmessage").value;
	var ajaxRequest = new XMLHttpRequest();
	var params = "name=" + encodeURIComponent(name) + "&message=" + encodeURIComponent(message);
	ajaxRequest.open("POST", "/shout.php", true);
	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");	
																								
	ajaxRequest.onreadystatechange = function() {
		if (ajaxRequest.readyState === 4 && ajaxRequest.status === 200) {
			document.getElementById("sbmessage").value = "";	
			sb_refresh();	
		}
	}	
	ajaxRequest.send(params);
	sb_refresh();	
	return false;
}

window.onload = function() {
	var chatbox = document.getElementById("shoutbox");
	chatbox.scrollTop = chatbox.scrollHeight;
};
