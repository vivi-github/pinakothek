function showMuseum(str) {
    if (str == "") {
        document.getElementById("museumPrint").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("museumPrint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","getMuseum.php?q="+str,true);
        xmlhttp.send();
    }
}

function showMuseumInfo() {
    var str = event.target.textContent;
    if (str == "") {
        document.getElementById("content").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("content").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","getMuseumInfo.php?q="+str,true);
        xmlhttp.send();
    }
}