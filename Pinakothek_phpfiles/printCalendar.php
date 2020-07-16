<!DOCTYPE html>
<html>
<body>

<?php
    $q = $_GET['q'];
    $connect=mysqli_connect( "localhost",  "team04", "team04");
    mysqli_select_db($connect, "team04");
?>

<h1 class="display-4 mb-3">Ticket</h1>
<table class="table table-bordered w-75">
    <thead class="thead-dark">
        <tr>
        <?php
            $query= "select date from ticket where museum='".$q."'";
            $result=mysqli_query($connect, $query);
            while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                echo '<th scope="col" style="text-align: center;">'.date('m-d',strtotime($row['date'])).'</th>';
            }
            mysqli_free_result($result);
        ?>
        </tr>
    </thead>
    <tbody>
        <tr>
        <?php
            $query= "select * from ticket where museum='".$q."'";
            $result=mysqli_query($connect, $query);
            while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                echo '<td style="padding-top:70px; text-align: right;">('.($row['total']-$row['sold']).'/'.$row['total'].')</td>';
            }
            mysqli_free_result($result);
            mysqli_close($connect);
        ?>
        </tr>
    </tbody>
</table>

</body>
</html>