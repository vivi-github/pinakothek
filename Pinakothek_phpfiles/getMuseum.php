<!DOCTYPE html>
<html>
    
<head>
    <script src="museum.js"></script>
    <style>
        .list-group-item {
            background-color: transparent;
        }

    </style>
</head>

<body>
    <ul class="list-inline" id="museumList">
        <ul class="list-group list-group-flush" onclick="showMuseumInfo()">
            <?php
                $q = $_GET['q'];
                $connect=mysqli_connect( "localhost",  "team04", "team04");
                mysqli_select_db($connect, "team04");
                $query= "select name from museum where country='".$q."'";
                $result=mysqli_query($connect, $query);
                while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    echo '<li class="list-group-item"><a href="#" class="list-group-item list-group-item-action">'.$row['name'].'</a></li>';
                }
                mysqli_free_result($result);
                mysqli_close($connect);
            ?>
        </ul>
    </ul>
</body>

</html>