function populateMessage(name, password, content) {
    //ajax to update page and populate chat content 1
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            document.getElementById('error').value = this.responseText;
        }
    };
    xmlhttp.open("GET", "ajaxchat.php?type=write&name=" + name + "&password=" + password + "&content=" + content, true);
    xmlhttp.send();
}

function listenButton(name) {
    if(name == '') return;
    //ajax to retrieve chat content 2
    var xmlhttp2 = new XMLHttpRequest();
    xmlhttp2.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            document.getElementById('content2').value = this.responseText;
        }
    };
    //setInterval to wait a few seconds before chat updates; no need to click Listen
    setInterval(function () {
        xmlhttp2.open("GET", "ajaxchat.php?type=read&name=" + name, true);
        xmlhttp2.send();
    }, 4000);
    
}

function retrieveNames() {
    //ajax to get the chat content based on name entered from online chatters
    var xmlhttp3 = new XMLHttpRequest();
    xmlhttp3.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            document.getElementById('names').innerHTML = this.responseText;
        }
    };
    xmlhttp3.open("GET", "ajaxchat.php?type=name", true);
    xmlhttp3.send();
}
