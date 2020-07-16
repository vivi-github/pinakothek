
function showArtistInfo() {

    console.log(event.target.querySelector("input").value);
    var str = event.target.querySelector("input").value;
    console.log(event.target.querySelector("#country").value);
    var country = event.target.querySelector("#country").value;
    console.log(event.target.querySelector("#popularity").value);
    var pop = event.target.querySelector("#popularity").value;

    if (str == "") {
        document.getElementById("content").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("content").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","getArtistInfo.php?q="+str+"&c="+country+"&p="+pop ,true);
        xmlhttp.send();
    }
}


