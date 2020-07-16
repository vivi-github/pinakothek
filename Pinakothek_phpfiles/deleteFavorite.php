<?php
session_start();
$user_id = $_SESSION['user_id'];

$connect=mysqli_connect( "localhost",  "team04", "team04");
mysqli_select_db($connect, "team04");


if(isset($_GET['submit'])){
  if(!empty($_GET['favorite'])){
    foreach($_GET['favorite'] as $selected){
      $query = "delete from mylist where user = '".$user_id."' and museum = '".$selected."'";
      $result = mysqli_query($connect, $query);
      if(!$result) printf("Could not retrieve records: %s\n", mysqli_error($connect));    
    }
  }
}

mysqli_free_result($result);
mysqli_close($connect); 
header('Location: favorite.html');
exit;
?>