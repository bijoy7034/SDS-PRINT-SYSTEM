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
$sql = "SELECT * FROM `services` WHERE id = 1";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);

if(isset($_POST['submit'])){
  $ser = $_POST['ser'];
  $rate = $_POST['rate'];
  $sql2 = "UPDATE `services` SET `$ser`=$rate WHERE id = 1";
  $res2 = mysqli_query($con,$sql2);
  if($res2){
    header("location:services.php?set=service");
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
            body{
              overflow-x: hidden;
            }
        </style>
        <!-- <link rel="stylesheet" href="css/forms.css"> -->
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


<main style="margin-top: 58px;">
  <div class="mx-3 pt-4">
  <center><h5>Services and Rates</h5></center>
  <hr class="mx-5">
  <div class="d-sm-flex justify-content-between">
  <table class="table" style="max-width: 500px;">
  <thead class="bg-primary text-light">
    <tr>
    <th><b>Services</b></th>
    <th><b>Price</b></th>
    </tr>
  </thead>
  <tr>
    <td>Black & White (a4) </td>
    <td><?php echo $row['b&w'] ?></td>
  </tr>
  <tr>
    <td>Colour (a4) </td>
    <td><?php echo $row['color'] ?></td>
  </tr>
  <tr>
    <td>Black & White (a3)  </td>
    <td><?php echo $row['bw&a4'] ?></td>
  </tr>
  <tr>
    <td>Colour (a3)  </td>
    <td><?php echo $row['col&a4'] ?></td>
  </tr>
  <tr>
    <td>Hard Bind</td>
    <td><?php echo $row['hardbind'] ?></td>
  </tr>
  <tr>
    <td>Soft Bind  </td>
    <td><?php echo $row['softbind'] ?></td>
  </tr>
  <tr>
    <td>Spiral Bind  </td>
    <td><?php echo $row['spiral'] ?></td>
  </tr>
</table>
<div class="m-5 px-5" style="min-width: 500px ;">
<h4>Change the rates by selecting the corresponding services from the dropdown</h4>
  <br>
  <form action="services.php?set=service" method="post">
  <select name="ser" class="form-select" aria-label="Default select example">
  <option selected>Select Service</option>
  <option value="b&w">Black & White (a4)</option>
  <option value="color">Color (a4)</option>
  <option value="bw&a4">Black & White (a3)</option>
  <option value="col&a4">Color (a3)</option>
  <option value="hardbind">Hard Bind</option>
  <option value="softbind'">Soft Bind</option>
  <option value="spiral">Spiral Bind</option>
</select> <br>

<div class="form-floating mb-3">
  <input required name="rate" type="number" class="form-control" id="floatingInput" placeholder="name@example.com">
  <label for="floatingInput">Price</label>
</div>
<button class="btn btn-success btn-lg" type="submit" name="submit">SAVE</button>
</form>
  </div>
 
  </div>
  


  </div>
</main>


<scripts
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"
></scripts>
</body>
</html>