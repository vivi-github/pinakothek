<?php

session_start();
$user_id = $_SESSION['user_id'];



echo 'send receive';

 $connect=mysqli_connect( "localhost",  "team04", "team04");
 mysqli_select_db($connect, "team04");


if(isset($_GET['submit'])){//to run PHP script on submit
if(!empty($_GET['image'])){
// Loop to store and display values of individual checked checkbox.
foreach($_GET['image'] as $selected){

 $query3 =  "INSERT INTO MyList (user, museum, reserved) SELECT '".$user_id."','".$selected."', 0 WHERE NOT EXISTS (SELECT user, museum FROM mylist WHERE user = '".$user_id."' AND museum='".$selected."') LIMIT 1";



  $result3 = mysqli_query($connect, $query3);
  if($result3){
  }
  else{
      printf("Could not retrieve records: %s\n", mysqli_error($connect));
  }
}
}
}


mysqli_free_result($result3);
mysqli_close($connect); 


header('Location: artist.html');
exit;

?>