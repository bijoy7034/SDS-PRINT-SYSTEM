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
$amt = $_GET['amt'];
$adm = $_GET['adm'];
$date = date("Y/m/d");
date_default_timezone_set('Asia/Calcutta');
$time = date('h:i:s a', time());

$sql0= "SELECT * FROM `accounts` WHERE adm_no ='$adm';";
  $res0 =mysqli_query($con, $sql0);
  if($res0){
    $row = mysqli_fetch_assoc($res0);
    $prev = $row['balance'];
    $bal = $prev - $amt;
    echo $bal;
    $sql ="UPDATE `accounts` SET `balance`= $bal WHERE adm_no = '$adm';";
    $res1=mysqli_query($con,$sql);
    if($res1){
        $sql4="INSERT INTO `transactions`(`t_id`, `amt`, `time`, `date`, `adm_no`) VALUES (null,-$amt,'$time','$date','$adm');";
        $res4 = mysqli_query($con,$sql4);
        if($res4){
            header("location:home.php?set=home");
        }
    }
  }


?>