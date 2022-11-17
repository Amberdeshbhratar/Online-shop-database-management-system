<?php
require_once('connection.inc.php');
require_once('functions.inc.php');
require_once('add_to_cart.inc.php');
$cat_res=mysqli_query($con,"select * from categories where status=1 order by categories asc");
while($row=mysqli_fetch_assoc($cat_res)){
    $cat_arr[]=$row;
}
$obj = new add_to_cart();
$totalProduct=$obj->totalProduct();
if(isset($_SESSION['USER_LOGIN'])){
   $uid = $_SESSION['USER_ID'];
   if(isset($_GET['wishlist_id'])){
      $wid = $_GET['wishlist_id'];
      mysqli_query($con,"delete from wishlist where id = '$wid' and user_id = '$uid'");
  }
$wishlist_count = mysqli_num_rows(mysqli_query($con,"select product.name,product.image,product.mrp,product.price,wishlist.id from product,wishlist where wishlist.product_id=product.id and wishlist.user_id ='$uid'"));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="path/to/your/jquery.min.js"></script> -->
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="stylesheet" href="breadcrumb.css">
<link rel="stylesheet" type="text/css" href="contact.css">
<link rel="stylesheet" href="index.css">
<link rel="icon" type="image/x-icon" href="./admin/img/logo.png">
	 <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <title>OSDBMS | Buy everything at low cost </title>
</head>
<body>
<nav>
         <div class="menu-icon">
            <span class="fas fa-bars"></span>
         </div>
         <div class="logo">
            OSDBMS
         </div>
         <div class="nav-items">
            <li><a href="index.php">Home</a></li>
            <?php
            foreach ($cat_arr as $list) {
                ?>
                <li><a href="categories.php?id=<?php echo $list['id']?>"><?php echo $list['categories']?></a></li>
            <?php } ?>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="cart.php"><i class="fa-solid fa-cart-shopping addCart" >&nbsp;<?php echo $totalProduct ?></i></a></li>
            <?php
               if(isset($_SESSION['USER_LOGIN'])){
                  // echo '<li> <a href="profile.php"><i class="fa-solid fa-user" >&nbsp;&nbsp;'echo  '</i></a></li>';
                  ?>
<li>
<div class="dropdown">
  <button class="dropbtn">Account</button>
  <div class="dropdown-content">
    <a href="profile.php">Profile</a>
    <a href="my_order.php">My Orders</a>
    <a href="logout.php">Logout</a>
  </div>
</div>
</li>


                  <!-- <li><div class="dropdown">
                  <button style="background:inherit;color:white;" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Account
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="profile.php">Profile</a>
                    <a class="dropdown-item" href="my_order.php">My Orders</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                  </div>
                </div>
                </li>; -->
                  <!-- <li> <a href="logout.php">Logout</a></li><li> <a href="my_order.php">My Orders</a></li><li> <a href="profile.php">Hi <?php echo $_SESSION['USER_NAME'] ?></a></li>; -->
                  <?php
               }else{
                  echo '<li><a href="login.php">Login/Register</a>';
               }
            ?>
            <?php
         if(isset($_SESSION['USER_ID'])){
         ?>
         <li style=""><a href="wishlist.php"><i class="fa-regular fa-heart dance" style="color: rgb(224, 56, 84);">&nbsp;<?php echo $wishlist_count ?></i></a></li>
               <?php } ?>
            <!-- <li> <a href="profile.php"><i class="fa-solid fa-user" >&nbsp;&nbsp;Name</i></a></li> -->
         </div>
         
         <div class="search-icon">
            <span class="fas fa-search"></span>
         </div>
         <div class="cancel-icon">
            <span class="fas fa-times"></span>
         </div>
         <form action="search.php" method="get">
            <input type="search" class="search-data" name="str" placeholder="Search" required>
            <button type="submit" class="fas fa-search"></button>
         </form>
      </nav>
   </header>  