<!-- <div class="d-sm-flex justify-content-between align-items-center mx-5">
  <b class="mx-3" style="margin-bottom: 5px;">Transactions (<?php echo date('d/m/Y') ?>)</b> 
  <button type="button" class="btn btn-primary btn-sm btn-rounded">View All transactions</button></div> -->
<table class="table" style="line-height:5px; background-color:#3B71CA; color:white; font-weight:bold">
<tbody style="text-align: left;">
    <tr>
      <td width="100">Id</td>
      <td width="200">Admission No.</td>
      <td width="200">Amount</td>
      <td width="200">Time</td>
      <td width="200">Date</td>
</tr>
  </tbody>
</table>
<div style="height: 300px; overflow: auto">
<table class="table">
  <tbody>


  <?php
  $color = 'dark';
  $d = date('Y/m/d');
include "connection.php";
$query_products = "SELECT * FROM transactions WHERE date = '$d' ORDER BY t_id DESC;";
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