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
  <div class="mx-3 pt-4 my-2">
  <form action="students.php?set=stud" method="post">
  <div class="container px-5" style="display: flex; justify-content:space-between">
  <h5 class="text-primary"><b>Student Details</b></h5>
    <div style="min-width:max-content; display: flex; align-items:center; justify-content:space-around;">
    <button type="button" class="btn btn-primary mx-4" data-mdb-toggle="modal" data-mdb-target="#exampleModal">
    Add
</button>
    <div class="input-group">
      
  <div class="form-outline">
    <input id="search-input" name="key" type="search" id="form1" class="form-control" />
    <label class="form-label" for="form1">Search</label>
  </div>
  <button id="search-button" type="submit" name="search" class="btn btn-primary">
    <i class="fas fa-search"></i>
  </button>
</div>
    
    </div>

  </div>
  </form>
  
  <table class="table align-middle mb-0 bg-white">
  <thead class="bg-light">
    <tr>
      <th>Name</th>
      <th>Batch</th>
      <th>Semester</th>
      <th>Balance</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>

  <?php
include "connection.php";
if(isset($_POST['search'])){
  $key = $_POST['key'];
  if($key==''|| $key == null){
    $query_products = "SELECT * FROM `students`;";
  }else{
    $query_products = "SELECT * FROM `students` where name like '$key%' or adm_no like '$key%';";
  }

}else{
  $query_products = "SELECT * FROM `students`;";
}
$result_products = mysqli_query($con,$query_products);

if($result_products):
    if(mysqli_num_rows($result_products)>0){
        while($products = mysqli_fetch_assoc($result_products)):
?>

    <tr>
      <td>
        <div class="d-flex align-items-center">
        <i class="fas fa-user"></i>
          <div class="ms-3">
            <p class="fw-bold mb-1"><?php echo $products['name'] ?></p>
            <p class="text-muted mb-0"><?php echo $products['adm_no'] ?></p>
          </div>
        </div>
      </td>
      <td>
        <p class="fw-normal mb-1"><b><?php echo $products['batch'] ?></b></p>
      </td>
      <td>
      <p class="fw-normal mb-1"><b>S-<?php echo $products['semester'] ?></b></p>
      </td>
      <td><b><?php
      $adm_n = $products['adm_no'];
      $sql3 = "SELECT * FROM `accounts` WHERE adm_no ='$adm_n';";
      $res4 = mysqli_query($con, $sql3);
      $row = mysqli_fetch_assoc($res4);
      echo $row['balance'] ?></b>
      </td>
      <td>
        <button type="button" class="btn btn-success btn-sm btn-rounded" 
        data-mdb-toggle="tooltip"
     data-mdb-html="true"
    title="<b>Add cash to <?php echo $products['name'] ?></b>">
          <a class="text-light" href="addCash.php?set=stud&adm=<?php echo $products['adm_no'] ?>">Add Cash</a>
        </button>
        <button   data-mdb-toggle="tooltip"
        data-mdb-html="true"
        title="<b>Remove Student from database</b>" type="button" class="mx-1 btn btn-danger btn-sm btn-rounded" data-mdb-toggle="modal" data-mdb-target="#remove">
          Remove
        </button>
        <button type="button" class="mx-1 btn btn-primary btn-sm btn-rounded"   data-mdb-toggle="tooltip"
        data-mdb-html="true"
         title="<b>View transactions, balance and student details</b>" >
          <a class="text-light" href="stud_view.php?set=stud&adm=<?php echo $adm_n ?>">View</a>
        </button>
        
      </td>
    </tr>
    <?php
                    endwhile;
                  }else{
                    ?>
                    <center class="m-5"><img src="pics/notfound.svg" class="img-fluid " width="400px" alt="Not Found">
                  <br><br><b><h4>Not data found!</h4></b></center>
                    <?php
                  };
            endif;

            ?>
    
  </tbody>
</table>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      
      <p class="text-muted">Enter the details of the student : </p>
      <form action="addstudent.php" method="post">
 
  <div class="row mb-4">
    <div class="col">
      <div class="form-outline">
        <input required type="text" name="full_name" id="form3Example1" class="form-control" />
        <label class="form-label" for="form3Example1">Full Name</label>
      </div>
    </div>
    <div class="col">
      <div class="form-outline">
        <input required type="text" id="form3Example2" name="adm" class="form-control" />
        <label class="form-label" for="form3Example2">Admission Number</label>
      </div>
    </div>
  </div>

  <!-- Email input -->
  <div class="form-outline mb-4">
    <input required type="text" id="form3Example3" name="batch" class="form-control" />
    <label class="form-label" for="form3Example3">Batch</label>
  </div>
  <div class="form-outline mb-4">
    <input required type="email" id="form3Example3" name="e_mail" class="form-control" />
    <label class="form-label" for="form3Example3">E-mail</label>
  </div>

  <!-- Password input -->
  <div class="form-outline mb-4">
  <select id="sem" name="sem" class="my-3 form-select" aria-label="Default select example">
                    <option>Semester</option>
                     <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>

                </select>
  </div>

  
      </div>
      <div class="modal-footer">
        <button type="button"  class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
        <button type="Submit" name="submit_stud" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>




<!-- remove -->
<div class="modal fade" id="remove" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Remove Student</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="text-danger">Removing the student will erase all the transactions and associated details from the app !</p>


  
      </div>
      <div class="modal-footer">
        <button type="button"  class="btn btn-light" data-mdb-dismiss="modal">Close</button>
        <button type="Submit" name="submit_stud" class="btn btn-danger"><a href="remove.php">Remove</a></button>
        </form>
      </div>
    </div>
  </div>
</div>
  </div>
</main>


<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"
></script>
</body>
</html>