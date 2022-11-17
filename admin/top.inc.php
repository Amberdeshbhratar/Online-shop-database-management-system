<?php
include_once 'connection.inc.php';
include_once 'functions.inc.php';
if(isset($_SESSION['ADMIN_LOGIN'])&&$_SESSION['ADMIN_LOGIN']!=''){
}else{
   header('location:login.php'); // redirecting to an ander ka page  
   die();
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>OSDBMS | Admin Panel</title>
    <!-- Import bootstrap cdn -->
    <link rel="stylesheet" href="categories.css">
    <link rel="stylesheet" href="manage_categories.css">
    <link rel="icon" type="image/x-icon" href="./img/logo.png">
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
      integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
      crossorigin="anonymous"
    />
    <!-- Import jquery cdn -->
    <script
      src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
      crossorigin="anonymous"
    ></script>
    <!-- Import popper.js cdn -->
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
      integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
      crossorigin="anonymous"
    ></script>
    <!-- Import javascript cdn -->
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
      integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
      crossorigin="anonymous"
    ></script>
    <!-- CSS stylesheet -->
    <style type="text/css">
      html,
      body {
        height: 100%;
      }
      #green {
        height: 100%;
        background: antiquewhite;
        text-align: center;
        color: black;
        padding: 15px;
      }
    </style>
  </head>
  <body>
    <!-- h-100 takes the full height of the body-->
    <div class="container-fluid " style="height:1200px;">
      <!-- h-100 takes the full height
				of the container-->     
      <div class="row h-100">
        <div class="col-2" id="green" style="background: rgba(102, 97, 97, 0.224);;">
            <img src="./img/logo.png" style="width:100px;height:100px;" alt="Logo" style="margin-bottom:15px;">   
          <h4 style="margin-bottom:15px ;">Menu</h4>
          <!-- Navigation links in sidebar-->
          
          <a href="product.php">Product</a><br />
          <br />

          <?php 
					 if($_SESSION['ADMIN_ROLE']==1){
						echo '<a href="order_master_vendor.php" >Order Master</a>';
					 }else{
						echo '<a href="order.php" >Order Master</a>';
					 }
					 ?>
          <br />
          <br />
          <?php if($_SESSION['ADMIN_ROLE']!=1){?>
            <a href="vendor_management.php">Vendor Management</a><br />
          <br />  
          <a href="categories.php">Categories</a><br />
          <br />
          <a href="users.php">User</a><br /><br />
          <a href="product_review.php">Product Reviews</a><br />
          <br />
          <a href="contact_us.php">Contact Us</a><br />
          <br />
          <?php } ?>
        </div>
        <div class="col-10" style="padding: 0">
          <!-- Top navbar -->
          <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="javascript:void(0)">Welcome <?php echo ucfirst($_SESSION['ADMIN_USERNAME'])?></a>
            <!-- Hamburger button that toggles the navbar-->
            <button
              class="navbar-toggler"
              type="button"
              data-toggle="collapse"
              data-target="#navbarNavAltMarkup"
              aria-controls="navbarNavAltMarkup"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span class="navbar-toggler-icon"></span>
            </button>
            <!-- navbar links -->
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
              <div class="navbar-nav">
                
                <a class="nav-item nav-link" href="logout.php">Logout</a>
              </div>
            </div>
          </nav>