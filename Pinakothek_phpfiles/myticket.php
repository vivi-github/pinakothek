
<html>

<body>
  
  <div class="content" id="content" ></div>

<?php
    $q = $_GET['q'];
    $m = $_GET['m'];
    $d = $_GET['d'];

    $success = true;
    mysqli_query("start Transaction");

          $connect=mysqli_connect( "localhost",  "team04", "team04");
          mysqli_select_db($connect, "team04");
          $query= "delete from MyReservation where ticket_num='".$q."';";
          $affected_rows = 1;
          $result1-mysqli_query($connect, $query);
          if(!$result1 || mysqli_affected_rows($connect) == $affected_rows) $success = false;

          $recover = "update ticket set ticket.sold = ticket.sold - 1 where ticket.museum = '".$m."' AND ticket.date = '".$d."';";
          $result1-mysqli_query($connect, $recover);
          if(!$result1) $success = false;


          if ( $success == true ) {
            mysqli_query( $connect, "COMMIT" );
        } else {
            mysqli_query( $connect, "ROLLBACK" );
            echo "<script>alert('Error happened during canceling ticket.'); history.back();</script>";
        }

          mysqli_free_result($result);
          mysqli_close($connect);

          header('Location: myticket.html');
          exit;
?>
</body>

</html>
