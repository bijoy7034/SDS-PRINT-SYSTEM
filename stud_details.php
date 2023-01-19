<div class="card testimonial-card mt-2 mb-3">
      <div class="card-up aqua-gradient bg-primary"></div>
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
         if ($balc < $amt){
          $color = 'danger';
          include "insufficient.php";
          $view = 2;
          $flag = 1;
        } else{
          $color = 'success';
        } ?>
        <b><h5 class="text-<?php echo $color ?>"><i class="far fa-money-bill-alt mx-2"></i></i>Balance : <?php 
        
        echo $balc ?>    
        </p></b>
      </div>
    </div>