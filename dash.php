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


$sql ="SELECT count(*) as total from students";
$result=mysqli_query($con,$sql);
$data= mysqli_fetch_assoc($result);

$date = date('Y/m/d');
$sql2 ="SELECT count(*) as total from transactions where date= '$date'";
$result2=mysqli_query($con,$sql2);
$data2= mysqli_fetch_assoc($result2);


$date = date('Y/m/d');
$sql3 ="SELECT sum(amt) as total from transactions where date= '$date' and amt < 0";
$result3=mysqli_query($con,$sql3);
$data3= mysqli_fetch_assoc($result3);

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
    <center><h3><b>DASHBOARD</b></h3></center>
    
    <hr class="mx-5">
    <p class="container mx-4">Admin's dashboard</p>
  <div class="d-sm-flex justify-content-around">
    <div style="min-width: 350px;" class=" my-3 p-5 bg-success text-light dash_box rounded dash_box">
      <center>
      <h3><b><?php echo $data2['total']; ?></b></h3>
      <small>Total Transactions today</small>
      </center>
    </div >
    <div style="min-width: 350px;" class= " my-3 p-5 bg-primary text-light dash_box rounded">
      <center>
      <h3><b><?php echo $data['total']; ?></b></h3>
      <small>Total Students</small>
      </center>
    </div>
    <div style="min-width: 350px;" class="my-3 p-5 bg-warning text-light dash_box rounded">
      <center>
      <h3><b><?php $tot = $data3['total'];
      $tot = $tot * -1;
      echo $tot;
      ?>.<small>00</small></b></h3>
      <small>Total Collection Today</small>
      </center>
    </div>
  </div>

  
 <br><br>
  <center><h5><b>All Transactions</b></h5></center>
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
  $d = date('Y/m/d');
include "connection.php";
$query_products = "SELECT * FROM transactions ORDER BY t_id DESC;";
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



  </div>
</main>


<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"
></script>
</body>
</html>