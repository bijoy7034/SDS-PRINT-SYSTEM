<!-- login -->
<?php
include 'connection.php';

// if(isset($_POST['submit'])){

//     $user = $_POST['user'];
//     $pass = $_POST['pass'];
//     $sql = "SELECT `user_id`, `password` FROM `users` WHERE user_id = '$user' and password = '$pass'";
//     $result = mysqli_query($con,$sql);
//     $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
//     $count = mysqli_num_rows($result); 
//     if($count >=1){  
//     header('Location: home.php?set=home');
//     }  
//     else{  
//     echo "<script>alert('INVALID PASSWORD OR USERNAME');</script>";  
//     }     


// }

session_start();
if(isset($_POST['submit']))
{
            $username1=mysqli_real_escape_string($con,$_POST['user']);
            $password1=mysqli_real_escape_string($con,$_POST['pass']);
            $a = "SELECT * FROM `users` WHERE user_id = '".$username1."'";
            $res = mysqli_query($con, $a);
            $row=mysqli_fetch_assoc($res);
            $user = $row['user_id'];
            $password = $row['password'];
            
            if(mysqli_num_rows($res)>0)
            {
                if(password_verify($password1, $password)){
                  $_SESSION['IS_LOGIN']=true;
                    $_SESSION['username']=$row['user_id'];
                    $flag=0;
                    sleep(1);
                    header('location:home.php?set=home');
                }
                else
                {
                  echo "<center><p class='text-danger'>Invalid Password or Username!!</p></center>";
                }
                    
                    
               
            } else
            {
              echo "<center><p class='text-danger'>Invalid Password or Password!!</p></center>";
            }
           
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="js/animate.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="node_modules/mdbootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="node_modules/mdbootstrap/css/mdb.min.css">
    <link rel="stylesheet" href="node_modules/mdbootstrap/css/style.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href=
"https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity=
"sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
        crossorigin="anonymous">
        

       

    <title>Login</title>
</head>
<body>
    

    <div>
    <center>
        <form class="border form1 border-light p-5" action="index.php" method="post">
        <img src="pics/output-onlinepngtools.png" width="200px" alt=""> <br>
        <!-- <input type="email" id="defaultLoginFormEmail" class="form-control mb-4" placeholder="E-mail"> -->
            <!-- Material input -->
            <div class="md-form">
             <input name="user" required type="text" id="form1" class="form-control">
                <label for="form1">Username</label>
            </div>
            <!-- <input type="password" id="defaultLoginFormPassword" class="form-control mb-4" placeholder="Password"> -->
            <div class="md-form">
                <input required type="password" name="pass" id="form1" class="form-control">
                   <label for="form1">Password</label>
               </div> <br>
            <div class="d-flex justify-content-between">
                <div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="defaultLoginFormRemember">
                        <label class="custom-control-label" for="defaultLoginFormRemember">Remember me</label>
                    </div>
                </div>
                <div>
                    <a href="">Forgot password?</a>
                </div>
            </div>
            <br>
        
            <button name="submit" style="background-color: #b22024; " class="btn btn-block my-4 text-light" type="submit">Sign in</button>
        
        
        </form>


       </center> <br><br><br><br><br><br><br><br>


       <?php include "footer.php" ?>

    </div>

       



<script type="text/javascript" src="node_modules/mdbootstrap/js/jquery.min.js"></script>
<script type="text/javascript" src="node_modules/mdbootstrap/js/popper.min.js"></script>
<script type="text/javascript" src="node_modules/mdbootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="node_modules/mdbootstrap/js/mdb.min.js"></script>
</body>
</html>