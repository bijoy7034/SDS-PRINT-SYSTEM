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
if(isset($_POST['submit_stud'])){
    $name = $_POST['full_name'];
    $adm = $_POST['adm'];
    $email = $_POST['e_mail'];
    $batch = $_POST['batch'];
    $sem = $_POST['sem'];

    $sql = "INSERT INTO `students`(`adm_no`, `name`, `semester`, `balance`, `batch`, `email`) VALUES ('$adm','$name',$sem,0,'$batch','$email');";
    $res = mysqli_query($con,$sql);
    echo $sem;
        if($res){
        
        $sql2 = "INSERT INTO `accounts`(`adm_no`, `balance`) VALUES ('$adm',0)";
        $res2 = mysqli_query($con,$sql2);
        if($res2){
            header("location:students.php?set=stud");
        }
    }else{
        echo "<script>alert('error')</script>";
    }

}

?>