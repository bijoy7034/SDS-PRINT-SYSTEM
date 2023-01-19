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
$adm = $_GET['adm'];
$sql = "SELECT `adm_no`, `name`, `semester`, `balance`, `batch`, `email` FROM `students` WHERE adm_no = '$adm'";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);

$sql2 ="SELECT count(*) as total from transactions where adm_no= '$adm'";
$result2=mysqli_query($con,$sql2);
$data2= mysqli_fetch_assoc($result2);

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
<nav style="background-color: #b22024;"
       id="main-navbar"
       class="navbar navbar-expand-lg navbar-dark  fixed-top"
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
  <div class="mx-3 pt-4 my-2">

 <div class="container-fluid d-sm-flex align-item-center justify-content-between">

 <div class="card testimonial-card mx-5" style="width: 400px;">
      <div class="card-up aqua-gradient" style="
background: #14167D;
background: -webkit-linear-gradient(right, #b22024, #939598);
background: -moz-linear-gradient(right, #b22024, #939598);
background: linear-gradient(to left, #b22024, #939598);"></div>
      <div class="avatar mx-auto white">
        <img src="pics/pngegg (1).png" class="rounded-circle img-fluid"
          alt="avatar">
      </div>
      <div class="card-body text-center">
        <b><h4 class="card-title font-weight-bold"><?php echo $row['name'] ?></h4></b>
        <hr>
        <p><i class="fas fa-user mx-2"></i></i><b>Admission Number</b> : <b><?php echo $row['adm_no'] ?></b></p>
        <?php
        $color = 'dark';
        $adm_n = $row['adm_no'];
        $sql3 = "SELECT * FROM `accounts` WHERE adm_no ='$adm_n';";
        $res4 = mysqli_query($con, $sql3);
        $row1 = mysqli_fetch_assoc($res4);
        $balc =$row1['balance'];
         if ($balc < 1){
          $color = 'danger';
          include "insufficient.php";
          $view = 2;
          $flag = 1;
        } else{
          $color = 'success';
        } ?>
        
       </div>
    </div>

    <div class="mx-5" style=" margin-top:30px">
    <center>
        <br><br>
    <h5><b>AVAILABLE BALANCE <br><h2 class="text-<?php echo $color ?>"><b><?php echo $balc ?>.00</b></h2></b></h5>
    </center>
</div>
<div class="mx-5" style=" margin-top:30px">
    <center><br><br>
    <h5><b>TOTAL TRANSACTIONS <br><h2 class="text-primary"><b><?php echo $data2['total'] ?></b></h2></b></h5>
    </center>
</div>
 </div>


 <center><h5 class="mt-4"><b>All Transactions of <?php echo $row['name'] ?></b></h5></center>
  <div style="height: 450px; overflow-y: auto">

<table class="table">
<tbody class="" style="text-align: left;">
    <tr>
      <td width="100"><b>Id</b></td>
      <td width="200"><b>Admission No.</b></td>
      <td width="200"><b>Amount</b></td>
      <td width="200"><b>Time</b></td>
      <td width="200"><b>Date</b></td>
</tr>
  </tbody>
  <tbody>


  <?php
  $color = 'dark';
  $d = date('Y/m/d');
include "connection.php";
$query_products = "SELECT * FROM transactions WHERE adm_no = '$adm' ORDER BY t_id DESC;";
$result_products = mysqli_query($con,$query_products);

if($result_products):
    if(mysqli_num_rows($result_products)>0):
        while($products = mysqli_fetch_assoc($result_products)):
          if($products['amt'] < 0){
            $color = 'danger';
          }else{
            $color = 'success';
          }
?>
    <tr>
      <td width="100"><?php echo $products['t_id'] ?></td>
      <td width="200"><?php echo $products['adm_no'] ?></td>
      <td width="200"><b class="text-<?php echo $color; ?>"><?php echo $products['amt'] ?></b></td>
      <td width="200"><?php echo $products['time'] ?></td>
      <td width="200"><?php echo $products['date'] ?></td>
    </tr>
    <?php
                    endwhile;
                endif;
            endif;

            ?>
    
    
  </tbody>
</table>
</div>




<!-- remove -->

  </div>
</main>


<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"
></script>
</body>
</html>