<nav
       id="sidebarMenu"
       class="collapse navbar-danger d-lg-block sidebar collapse bg-white"
       >
    <div class="position-sticky">
      <div class="list-group list-group-flush mx-3 mt-4">
        <a
           href="home.php?set=home"
           class="list-group-item list-group-item-action py-2 ripple <?php 
           if($nav == 'home'){
            echo "active";
           }else{
            echo "";
           }
           ?>"
           >
          <i class="fas fa-home fa-fw me-3"></i
            ><span>Home</span>
        </a>
        <a
           href="dash.php?set=dash"
           class="list-group-item list-group-item-action py-2 ripple <?php 
           if($nav == 'dash'){
            echo "active";
           }else{
            echo "";
           }
           ?>"
           ><i class="fas fa-calendar fa-fw me-3"></i
          ><span>Dashboard</span></a
          >
        
        <a
           href="students.php?set=stud"
           class="list-group-item list-group-item-action py-2 ripple <?php 
           if($nav == 'stud'){
            echo "active";
           }else{
            echo "";
           }
           ?>"
           ><i class="fas fa-users fa-fw me-3"></i><span>Students</span></a
          >
        <a
           href="account.php?set=acc"
           class="list-group-item list-group-item-action py-2 ripple
           <?php 
           if($nav == 'acc'){
            echo "active";
           }else{
            echo "";
           }
           ?>"
           ><i class="fas fa-chart-bar fa-fw me-3"></i><span>Account</span></a
          >
        <a
           href="services.php?set=service"
           class="list-group-item list-group-item-action py-2 ripple <?php 
           if($nav == 'service'){
            echo "active";
           }else{
            echo "";
           }
           ?>"
           ><i class="fas fa-building fa-fw me-3"></i
          ><span>Services</span></a
          >
        
        <a
           href="#"
           class="list-group-item list-group-item-action py-2 ripple"
           ><i class="fas fa-money-bill fa-fw me-3"></i><span>Settings</span></a
          >

          <br><br><br><br><br><br><br><br><br><br><br>
          <h6 class="text-primary mx-4 mt-5"><i class="fa-lg fas fa-user-circle mx-2"></i><?php echo $loggedin_session ?></h6>  
      </div>
      
    </div>
  </nav>
  <!-- Sidebar -->

  <!-- Navbar -->
  
  
  <!-- Navbar -->
</header>
<!--Main Navigation-->

<!--Main layout-->