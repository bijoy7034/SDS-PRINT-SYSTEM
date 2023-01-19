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
if(isset($_POST['add'])){
  
  $cash = $_POST['amt'];
  $date = date("Y/m/d");
date_default_timezone_set('Asia/Calcutta');
$time = date('h:i:s a', time());
  $adm = $_GET['adm'];
  $sql0= "SELECT * FROM `accounts` WHERE adm_no ='$adm';";
  $res0 =mysqli_query($con, $sql0);
  if($res0){
    $row = mysqli_fetch_assoc($res0);
    $prev = $row['balance'];
    $tot = $cash +$prev;
    $sql = "UPDATE `accounts` SET `balance`=$tot WHERE adm_no = '$adm';";
  $res = mysqli_query($con,$sql);
  $sql4="INSERT INTO `transactions`(`t_id`, `amt`, `time`, `date`, `adm_no`) VALUES (null,+$cash,'$time','$date','$adm');";
        $res4 = mysqli_query($con,$sql4);
  if($res){
    header("location:students.php?set=stud");
  }
  }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saintgits Design School</title>
    <link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.css"
  rel="stylesheet"
/>
<link rel="stylesheet" href="css/sideNav.css">

<link rel="stylesheet" href="style.css">
<style>
            @import url('https://fonts.googleapis.com/css2?family=Quicksand&display=swap');
            *{
                font-family: Quicksand;
            }
        </style>
        <link rel="stylesheet" href="css/forms.css">
    <title>Document</title>
</head>
<body>

<?php
$nav = $_GET['set'];
include 'nav.php';
?>
<nav
       id="main-navbar"
       class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top"
       >
    <!-- Container wrapper -->
    <div class="container">
      <!-- Toggle button -->
      <button
              class="navbar-toggler"
              type="button"
              data-mdb-toggle="collapse"
              data-mdb-target="#sidebarMenu"
              aria-controls="sidebarMenu"
              aria-expanded="false"
              aria-label="Toggle navigation"
              >
        <i class="fas fa-bars"></i>
      </button>

      <!-- Brand -->
      <a class="navbar-brand" href="#">
      
      <b style="text-transform:uppercase">Saintgits Design School</b>
      </a>
      <!-- Search form -->

      <!-- Right links -->
      <div class="navbar-nav ms-auto">

        
        <form action="home.php?set=home" method="post">
                  <button type="submit" name="logout" class="btn btn-outline-light" style="margin-left: 10px;">Logout</button>

                  </form> 
                  <?php
        if(isset($_POST['logout'])){
          session_destroy();
          header('location:index.php');
        }
        ?>
               </div>
    </div>
    <!-- Container wrapper -->
  </nav>


<main style="margin-top: 58px">
<div class="mx-5 pt-4">
   <b><h3>Admission Number : <?php echo $_GET['adm']; ?></h3></b> <br>
<form action="addCash.php?set=stud&adm=<?php echo $_GET['adm']; ?>" method="post">
  <!-- Email input -->
  <p>Enter the amount:</p>
  <div class="form-outline mb-4">
    <input required type="number" name="amt" id="form1Example1" class="form-control" />
    <label class="form-label" for="form1Example1">Amount</label>
  </div>

  <!-- Submit button -->
  <button type="button" class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#remove">Add Amount</button>


  <div class="modal fade" id="remove" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Cash to <?php echo $_GET['adm']; ?></h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="text-danger">Once added cannot be redone!!</p>


  
      </div>
      <div class="modal-footer">
        <button type="button"  class="btn btn-light" data-mdb-dismiss="modal">Close</button>
        <button type="submit" name="add" class="btn btn-success">Add</button>
        </form>
      </div>
    </div>
  </div>
</div>
</form>

  </div>
</main>


<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"
></script>
</body>
</html>