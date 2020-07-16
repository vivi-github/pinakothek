function deleteticket(){

    var targetnode = event.target;
    var parent = targetnode.parentNode;
    var grandParent = parent.parentNode;
     console.log(event.target);
     console.log(targetnode.parentNode);
     console.log(parent.parentNode);
     console.log(parent.querySelector("#ticket_num").innerHTML);
     console.log(grandParent.querySelector("#MuseumName").innerHTML);
     console.log(grandParent.querySelector(".lead").id);
    var str = parent.querySelector("#ticket_num").innerHTML;
    var Museum = grandParent.querySelector("#MuseumName").innerHTML;
    var date = grandParent.querySelector(".lead").id;

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

        xmlhttp.open("GET","myticket.php?q="+str+"&m="+Museum+"&d="+date,true);
        xmlhttp.send();
    }




}


