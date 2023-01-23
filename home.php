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

$amt = 0;
$view = 0;
$flag =0;
if(isset($_POST['cal'])){
  $sql6 = "SELECT `id`, `b&w`, `color`, `bw&a4`, `col&a4`, `hardbind`, `softbind`, `spiral` FROM `services` WHERE id = 1";
  $qur = mysqli_query($con,$sql6);
  $row2 = mysqli_fetch_assoc($qur);

  $adm = $_POST['adm'];
  $print = $_POST['print'];
  $adons = $_POST['addon'];
  $paper = $_POST['paper'];
  $copies = $_POST['copies'];
  $pg = 0;
  $amt = 0;

  if($print== 'b&w'){
    if($paper == 'a4'){
        $pg = $row2['b&w'];
        if($adons == 'none'){
            $amt = $pg * $copies;
        } else if($adons == 'hard'){
          $amt =( $pg * $copies )+ $row2['hardbind'];
        }
        else if($adons == 'soft'){
          $amt =( $pg * $copies ) + $row2['softbind'];
        }else{
          $amt =( $pg * $copies )+$row2['spiral'];
        }
    }else{
        $pg = $row2['bw&a4'];
        if($adons == 'none'){
          $amt =( $pg * $copies );
        } else if($adons == 'hard'){
          $amt =( $pg * $copies ) + $row2['hardbind'];
        }
        else if($adons == 'soft'){
          $amt =( $pg * $copies ) +$row2['softbind'];
        }else{
          $amt =( $pg * $copies )+$row2['spiral'];
        }
    }

}else{
    if($paper == 'a4'){
        $pg = $row2['color'];
        if($adons == 'none'){
          $amt =( $pg * $copies );
        } else if($adons == 'hard'){
          $amt =( $pg * $copies ) + $row2['hardbind'];
        }
        else if($adons == 'soft'){
          $amt =( $pg * $copies )+$row2['softbind'];
        }else{
          $amt =( $pg * $copies )+$row2['spiral'];
        }
    }else{
        $pg = $row2['col&a4'];
        if($adons == 'none'){
          $amt =( $pg * $copies );
        } else if($adons == 'hard'){
          $amt =( $pg * $copies ) + $row2['hardbind'];
        }
        else if($adons == 'soft'){
          $amt =( $pg * $copies ) +$row2['softbind'];
        }else{
          $amt =( $pg * $copies )+$row2['spiral'];
        }
    }
}

$sql = "SELECT `adm_no`, `name`, `semester`, `balance`, `batch`, `email` FROM `students` WHERE adm_no = '$adm'";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);
if($row > 0){
  $view = 1;
}else{
  $view =2;
}


}else{
  $view = 0;
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
<link rel="stylesheet" href="css/forms.css">
<style>
            @import url('https://fonts.googleapis.com/css2?family=Quicksand&display=swap');
            *{
                font-family: Quicksand;
            }
        </style>
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


<main style="margin-top: 58px">
  <div >
    <div class="d-sm-flex justify-content-around">
        <div class="mt-4">
            <h5 style="color: #b22024;"><b>Enter Student Details</b></h5>
            <small cla>Enter the details of the student and the service provided</small>
            <form action="home.php?set=home" method="post">
            <div class="row mb-3 mt-2">
    <div class="col">
      <div class="form-outline">
        <input  type="text" name="adm" id="admis_no" class="form-control" />
        <label class="form-label" for="form3Example1">Admission No.</label>
      </div>
    </div>
    <div class="col">
    <select  class="form-select" name="print" id="print" required aria-label="Default select example">
                    <option>Select Print Type</option>
                     <option selected value="b&w">Greyscale</option>
                    <option value="col">Color</option>
                    <option value="others">Others</option>
                </select>
    </div>
  </div>
                <select required id="add_ons" name="addon" class="my-3 form-select" aria-label="Default select example">
                    <option>Add Ons</option>
                     <option selected value="none">Normal</option>
                    <option value="hard">Hard Bind</option>
                    <option value="soft">Soft Bind</option>
                    <option value="spiral">Spiral Bind</option>

                </select>
                <div class="row mb-3 mt-2">
    <div class="col">

      <select id="paper" name="paper" class="form-select" required aria-label="Default select example">
                    <option>Select Paper Type</option>
                     <option selected value="a4">A4</option>
                    <option value="a3">A3</option>
                    <option value="3">Others</option>
                </select>

    </div>
    <div class="col">
    <div class="col">
      <div class="form-outline">
        <input required type="number" name="copies" id="copies" class="form-control" />
        <label class="form-label" for="form3Example1">Number of copies</label>
      </div>
    </div>
    </div>
        </div>
        <span class="form-label">Amount : </span> <h2 ><b>&#x20B9;</b><b><?php echo $amt ?></b> <small>.00/-</small></h2>
        

                <button  class="btn text-light" style="background-color: #b22024; min-width: 200px;" name="cal"  type="submit"><b>Submit</b></button>
                <button  class="btn text-light" style="background-color: #b22024; min-width: 200px;" onclick="reset()"  type="reset"><b><a class="text-light" href="home.php?set=home">Reset</a></b></button> <br>
                

            </form>
            
            <button style="min-width: 400px; background-color: #b22024;"  data-mdb-toggle="modal" data-mdb-target="#details" class="btn btn-success my-2" <?php if($view==0){echo 'disabled';} ?> name="submit" type="submit"><b>Save</b></button>
        </div>
        <div>
        <div class="container-fluid" style="display: flex; align-items:center; justify-content:center;">
  <section class="mx-auto" style="width: 25rem;">
    <?php
    if($view == 1){
      include "stud_details.php";
    }
    elseif($view == 0){
      ?>  <center><img src="pics/output-onlinepngtools.png" class="img-fluid mt-5 pt-5" alt=""><br><br>
      <!-- <h4 class="" style="text-transform: uppercase;"><b>SDS Reprography
      </b></h4></center> -->
        
       <?php
    }
    else{
      ?> 
      <center><img src="pics/undraw_not_found.svg" class="img-fluid mt-5" style="max-width: 300px;" alt=""><br><br>
    <b><span class="my-3 text-danger">Student not found enter valid details..!</span></b></center>
     
     <?php
    }
    ?>
    <div>
        
    </div>
    
  </section>
</div>
        </div>
    </div>
    <?php include "transactions.php" ?>
  </div>
</main>


<div class="modal fade" id="details" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Order Details</b></h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="">
      <div class="modal-body">
        <span>Paper Type : <?php echo $paper ?> </span><br>
        <span>Print Type : <?php echo $print ?></span><br>
        <span>Addons &nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $adons ?></span><br>
        <span>Copies &nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $copies ?></span><br>
        <span>Admission No: <?php echo $adm ?></span><br><br>
        <b class="text-danger">
        <?php
        if($flag==1){
          echo "Add cash to $adm to complete the transaction!";
        } ?>
        </b>
      </div>
      <div class="modal-footer">
        <button type="button"  class="btn btn-danger" data-mdb-dismiss="modal">Close</button>
        <button type="submit" <?php if($flag==1){echo 'disabled';} ?>  class="btn btn-success"><a class="text-light" href="minucash.php?amt=<?php echo $amt; ?>&adm=<?php echo $adm; ?>">Save</a></button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="js/calculate.js"></script>
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"
></script>
</body>
</html>