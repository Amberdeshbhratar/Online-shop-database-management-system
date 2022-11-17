<?php
include_once 'connection.inc.php';
include_once 'functions.inc.php';
$msg='';
if(isset($_POST['submit'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $sql="select * from admin_users where username='$username' and password='$password'";
$res=mysqli_query($con,$sql);
$count=mysqli_num_rows($res);
if($count>0){
  $row=mysqli_fetch_assoc($res);
		if($row['status']=='0'){
			$msg="Account deactivated";	
		}else{
			$_SESSION['ADMIN_LOGIN']='yes';
			$_SESSION['ADMIN_ID']=$row['id'];
			$_SESSION['ADMIN_USERNAME']=$username;
			$_SESSION['ADMIN_ROLE']=$row['role'];
			header('location:categories.php');
			die();
		}
}else{
    $msg="Please enter correct login details";
}
}
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Login Page with Background Image Example</title>
  <link rel="stylesheet" href="./style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div id="bg"></div>

<form method="post">
  <div class="form-field">
    <input type="text" name="username" placeholder="Username" required/>
  </div>
  
  <div class="form-field">
    <input type="password" name="password" placeholder="Password" required/>                         
  </div>  
  <div class="form-field">
    <button class="btn" name="submit" type="submit">Login</button>
  </div>
  <div style="color:red"><?php echo $msg?></div>
</form>
<!-- partial -->
</body>
</html>
