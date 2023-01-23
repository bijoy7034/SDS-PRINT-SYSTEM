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
 <form action="dash.php?set=dash" method="post">
  <div class="container px-5" style="display: flex; justify-content:space-between">
  <h5 style="color: #b22024;"><b>Student Details</b></h5>
    <div style="min-width:max-content; display: flex; align-items:center; justify-content:space-around;">
    <div class="input-group">
      
  <div class="form-outline">
    <input id="search-input" min='1/1/2023' name="date" type="date" id="form1" class="form-control" />
    <label class="form-label" for="form1">Select date</label>
  </div>
  <button id="search-button" type="submit" name="search" class="btn text-light" style="background-color: #b22024;">
    <i class="fas fa-search"></i>
  </button>
  
</div><button name="reset" class="btn btn-floating text-light mx-3" style="background-color: #b22024;"><a class="text-light" href="dash.php?set=dash"><i class="fas fa-undo"></i></a></button>
<button onclick="exportpdf()" class="btn btn-floating text-light" style="background-color: #b22024;" type="button"><i class="fas fa-download"></i></button>
    </div>
   

  </div>
  </form>
  
  <div style="height: 450px; overflow-y: auto">

<table class="table" id="example">
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
if(isset($_POST['search'])){
  $date1 = $_POST['date']; 
 $query_products = "SELECT * FROM transactions WHERE date = '$date1' ORDER BY t_id DESC;";
}
else{
  $query_products = "SELECT * FROM transactions ORDER BY t_id DESC;";
}
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
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
        crossorigin="anonymous"></script>
<script src="src/tableHTMLExport.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.5/jspdf.plugin.autotable.min.js"></script>
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"
></script>
<script>
  function exportpdf(){
//     $("#example").tableHTMLExport({

// // csv, txt, json, pdf
// type:'csv',

// // file name
// filename:'sample1.csv'

// });
$("#example").tableHTMLExport({

// csv, txt, json, pdf
type:'csv',

// file name
filename:'sdsprintaccounts.csv',

ignoreColumns: '.ignore',
ignoreRows: '.ignore'

})
// $("#example").tableHTMLExport({

// type:'csv',
// orientation: 'p'

// });
// $("#example").tableHTMLExport({

// // csv, txt, json, pdf
// type:'pdf',

// // default file name
// filename: 'tableHTMLExport.csv',

// // for csv
// separator: ',',
// newline: '\r\n',
// trimContent: true,
// quoteFields: true,

// // CSS selector(s)
// ignoreColumns: '',
// ignoreRows: '',
              
// // your html table has html content?
// htmlContent: false,

// // debug
// consoleLog: false,        

// });
}
 
</script>
</body>
</html>