function showCalendar(str) {
    if (str == "") {
        document.getElementById("calendar-area").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("calendar-area").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","printCalendar.php?q="+str,true);
        xmlhttp.send();
    }
}