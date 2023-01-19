<?php

include "connection.php";
session_start();
$user_check=$_SESSION['username'];
$ses_sql  = mysqli_query($con,"select user_id from users where user_id='$user_check'");
$row  = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

$loggedin_session = $row['user_id'];

if($loggedin_session==NULL) {
            echo "Go back";
            header("Location: index.php");
}
$user = $_GET['user'];
$sql = "DELETE FROM users WHERE user_id = '$user'";
$res = mysqli_query($con,$sql);
if($res){
    header("location:account.php?set=acc");
}else{
    echo "error in removing";
}

?>