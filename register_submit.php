<?php
require_once('connection.inc.php');
$name=trim($_POST['name']);
$mobile=trim($_POST['mobile']);
$email=trim($_POST['email']);
$password=trim($_POST['password']);
$res=mysqli_query($con,"select * from users where email='$email'");
$check_user = mysqli_num_rows($res);
if($check_user>0){
    echo "Email is already present";
}else{
    $added_on=date('Y-m-d h:m:s');
    mysqli_query($con,"insert into users(name,mobile,email,password,added_on)values('$name','$mobile','$email','$password','$added_on')");
    echo "Thank you for your registration";
}
?>
