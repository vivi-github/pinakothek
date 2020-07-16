<?php
    session_start();
    $old_date = $_GET['selectedDate'];
    $museum = $_GET['museumList'];

    if($museum == 'Choose...') {
        echo "<script>alert('Please select a museum.'); history.back();</script>";
        exit;
    }

    if(!$old_date) {
        echo "<script>alert('Please select a date.'); history.back();</script>";
        exit;
    }

    $old_date = explode('/', $old_date); 
    $date = $old_date[2].'-'.$old_date[0].'-'.$old_date[1];
    $amount = intval($_GET['amount']);
    $i = $amount;
    $success = true;

    $connect=mysqli_connect( "localhost",  "team04", "team04");
    mysqli_select_db($connect, "team04");
    
    while($i > 0) {
        $query2 = "select * from ticket where museum ='".$museum."' and date = '".$date."'";
        $result2=mysqli_query($connect, $query2);
        $row2=mysqli_fetch_array($result2, MYSQLI_ASSOC);

        if(($row2['total']-$row2['sold']) < $amount) {
            echo "<script>alert('Please check the amount. There is no available ticket.'); history.back();</script>";
            exit;
        }

        $query1 = "select * from museum where name ='".$museum."'";
        $result1=mysqli_query($connect, $query1);
        $row1=mysqli_fetch_array($result1, MYSQLI_ASSOC);
        $ticket_num = $row1['ticket_id'].$old_date[2].$old_date[0].$old_date[1].($row2['sold']+1);
        $ticket_price = $row1['ticket_price'];
        
        mysqli_query($connect, "START TRANSACTION");
        $query1 = "insert into myReservation (ticket_num, user, date, museum, reviewed) VALUES ('".$ticket_num."', '".$_SESSION['user_id']."', '".$date."', '".$museum."', 0);";
        $result1=mysqli_query($connect, $query1);
        if(!$result1 || mysqli_affected_rows($connect) == 0) $success = false;

        $query1 = "update ticket SET ticket.sold = ticket.sold + 1 WHERE '".$museum."' = ticket.museum and '".$date."' = ticket.date;";
        $result1=mysqli_query($connect, $query1);
        if(!$result1 || mysqli_affected_rows($connect) == 0) $success = false;
    
        $i--;
    }

    $query1 = "update mylist set mylist.reserved = 1 where mylist.museum = '".$museum."';";
    $result1=mysqli_query($connect, $query1);
    if(!$result1 || mysqli_affected_rows($connect) == 0) $success = false;

    if ( $success == true ) {
        mysqli_query( $connect, "COMMIT" );
    } else {
        mysqli_query( $connect, "ROLLBACK" );
        echo "<script>alert('Error happened during purchasing ticket.'); history.back();</script>";
    }

    $paid = $ticket_price*$amount;


    

    mysqli_free_result($result2);
    mysqli_close($connect);

    //-------------------------------------------location url change---------------------------------------------------------
    echo "<script>alert('You paid {$paid}$.'); history.back();</script>";

?>


