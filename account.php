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

if(isset($_POST['submit'])){
    $pass = $_POST['pass'];
    $email = $_POST['user'];

    $encr_pass = password_hash($pass, PASSWORD_BCRYPT);

    $check_user = mysqli_query($con, "SELECT user_id FROM users where user_id = '$email' ");
        if(mysqli_num_rows($check_user) > 0){
                 echo('Username Already exists');
        }

    else{
        $query = "INSERT into `users` (user_id, password) VALUES ( '$email', '$encr_pass');";
        $result = mysqli_query($con,$query);
         if($result){
          header('Location: account.php?set=acc');
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
<nav style="background-color: #b22024"
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
    <center><h3><b>ACCOUNTS</b></h3></center>
    
    <hr class="mx-5">

    <div class="container px-5" style="display: flex; justify-content:space-between">
  <h5 style="color:#b22024"><b>Admin accounts details</b></h5>
    <div style="min-width:max-content; display: flex; align-items:center; justify-content:space-around;">
    <button type="button" class="btn text-light mx-4" style="background-color: #b22024;" data-mdb-toggle="modal" data-mdb-target="#exampleModal">
    Add
</button>
  
    
    </div>

  </div>

  <br>
  <div class="d-sm-flex justify-content-between">
  <table class="table mx-5" style="max-width: 700px;">
    <thead>
        <tr>
            <th><b>#</b></th>
            <th><b>USER_ID</b></th>
            <th><b>OPERATIONS</b></th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $flag = 1;
        $sql = "SELECT * FROM users;";
        $res = mysqli_query($con,$sql);
        if($res):
            if(mysqli_num_rows($res)>0):
                while($products = mysqli_fetch_assoc($res)):
        ?>
        <tr>
            <td><?php echo $flag ?></td>
            <td><?php echo $products['user_id'] ?></td>
            <td><button type="button" <?php if($products['user_id'] == $loggedin_session) {
              echo "disabled";
            }?>  class="btn btn-outline-danger btn-sm btn-rounded"><a class="text-danger" href="removeAcc.php?user=<?php echo $products['user_id'] ?>">Remove</a></button></td>
            
        </tr>
        <?php
        $flag++;
        endwhile;
    endif;
endif;
         ?>
    </tbody>
  </table>

  <div class="m-5" style="padding-right: 100px;">
  <center><i class="fa-3x fas fa-user-tie mx-2"></i></center><br>
  <h5 class="text-success" >Current User : <span class="text-dark"><?php echo $loggedin_session; ?></span></h5>
  </div>

  </div>

  </div>
</main>













<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-light" style="background-color: #b22024;">
        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      
      <form action="account.php?set=acc" method="post">
  <!-- Email input -->
  <div class="form-outline mb-4">
    <input required type="text" id="form1Example1" name="user" class="form-control" />
    <label class="form-label" for="form1Example1">Username</label>
  </div>

  <!-- Password input -->
  <div class="form-outline mb-4">
    <input required type="password" name="pass" id="form1Example2" class="form-control" />
    <label class="form-label" for="form1Example2">Create Password</label>
  </div>
  <div class="form-outline mb-4">
    <input required type="password" id="form1Example2" class="form-control" />
    <label class="form-label" for="form1Example2">Re-enter Password</label>
  </div>

  <br>

  <!-- Submit button -->
  <button type="submit" name="submit" class="btn btn-block text-light" style="background-color: #b22024;">ADD USER</button>
</form>
<br>

  
      </div>
    </div>
  </div>
</div>


<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"
></script>
</body>
</html>