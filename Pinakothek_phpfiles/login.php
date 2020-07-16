<?php

if(!isset($_POST['username']) || !isset($_POST['pass'])) exit;
$user_id = $_POST['username'];
$user_pw = $_POST['pass'];

$connect=mysqli_connect( "localhost",  "team04", "team04");
mysqli_select_db($connect, "team04");
$query= "select * from usertable where id='".$user_id."'";
$result=mysqli_query($connect, $query);
$row=mysqli_fetch_array($result, MYSQLI_ASSOC);

if($user_pw == $row['password']) {
    session_start();
    $_SESSION['user_id'] = $user_id;
    //echo 'Welcome '.$_SESSION['user_id'].'!';
    header('Location: main.html');
    exit;  
}
else {
    echo 'invalid id and password';
}

?>