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
// $sql = "SELECT * FROM `services` WHERE id = 1";
// $res = mysqli_query($con, $sql);
// $row = mysqli_fetch_assoc($res);
$sql = "SELECT * FROM `service`";
$res = mysqli_query($con, $sql);
$name = array();
$rate = array();
$i = 0;
while($row = mysqli_fetch_array($res)) {
  $name[$i] = $row['name'];
  $rate[$i] = $row['rate'];
  $i = $i+1;
}

if(isset($_POST['edit'])){
  $ser = $_POST['ser'];
  $rate = $_POST['rate'];
  $sql2 = "UPDATE service SET rate = '$rate' WHERE name = '$ser'";
  $res2 = mysqli_query($con,$sql2);
  if($res2){
    header("location:services.php?set=service");
  }
}

if(isset($_POST['add'])){
  $ser = $_POST['item-name'];
  $rate = $_POST['item-rate'];
  echo $ser;
  $sql2 = "INSERT INTO service VALUES ('$ser' , '$rate')";
  $res2 = mysqli_query($con,$sql2);
  if($res2){
    header("location:services.php?set=service");
  }
}

if(isset($_POST['delete'])){
  $ser = $_POST['ser'];
  echo $ser;
  $sql2 = "DELETE FROM service WHERE name = '$ser'";
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
style="background-color: #b22024;"
       id="main-navbar"
       class="navbar navbar-expand-lg navbar-dark fixed-top"
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
  <div class="d-sm-flex justify-content-between" style="height: 0px;">
  <table class="table" style="max-width: 500px;">
  <thead style="background-color: #b22024;" class="text-light">
    <tr>
    <th><b>Services</b></th>
    <th><b>Price</b></th>
    </tr>
  </thead>
  <tbody id='table'>
    <tr>
      </tr>
      </tbody>
</table>
<div class="m-5 px-5" style="min-width: 500px ;">
<h4>Change the rates by selecting the corresponding services from the dropdown</h4>
  <br>
  <form action="services.php?set=service" method="post">
  <select id='select' name="ser" class="form-select" aria-label="Default select example">
  <option selected>Select Service</option>
  
</select> <br>

<div class="form-floating mb-3">
  <input name="rate" type="number" class="form-control" id="floatingInput" placeholder="name@example.com">
  <label for="floatingInput">Price</label>
</div>
<button class="btn text-light btn-lg" style="background-color: #b22024;" type="submit" name="edit">SAVE</button>
<button class="btn text-light btn-lg" style="background-color: #b22024;" type="submit" name="delete">DELETE</button>
</form>
<br>

<br>

<div class="" style="min-width: 500px ;">
<h4>Add</h4>
  <br>
  <form action="services.php?set=service" method="post">
    
  <input id='item-name' name="item-name" class="form-control" aria-label="Default select example" placeholder="Name">
   
  <br>
<div class="form-floating mb-3">
  <input required name="item-rate" type="number" class="form-control" id="floatingInput" placeholder="name@example.com">
  <label for="floatingInput">Price</label>
</div>
<button class="btn text-light btn-lg" style="background-color: #b22024;" type="submit" name="add">SAVE</button>
</form>
  </div>
  </div>
 
  </div>
  


  </div>
  
</main>


<scripts
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"
></scripts>

<script>
  var item_name = <?php echo json_encode($name) ?>;
  var item_rate = <?php echo json_encode($rate) ?>;
  var totalnumber = <?php echo json_encode($i) ?>;
  var tablee = document.getElementById('table');
  var select = document.getElementById('select');
  for(var i=0 ; i<totalnumber ; i++) {
    tr = document.createElement('tr');
    td1 = document.createElement('td');
    td2 = document.createElement('td');
    option = document.createElement('option');
    td1.append(item_name[i]);
    td2.append(item_rate[i]);
    tr.append(td1 , td2);
    tablee.append(tr);
    option.append(item_name[i]);
    select.append(option);

  }
  </script>

</body>
</html>