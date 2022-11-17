<?php
require_once('connection.inc.php');
require_once('functions.inc.php');
$email=trim($_POST['email']);
$password=trim($_POST['password']);
$res=mysqli_query($con,"select * from users where email='$email' and password='$password'");
$check_user = mysqli_num_rows($res);
if($check_user>0){
    $row=mysqli_fetch_assoc($res);
    $_SESSION['USER_LOGIN']='yes';
    $_SESSION['USER_ID']=$row['id'];
    $_SESSION['USER_NAME']=$row['name'];
    echo 'valid';
    if(isset($_SESSION['WISHLIST_ID']) && $_SESSION['WISHLIST_ID']!=''){
        addWishlist($con,$_SESSION['USER_ID'],$_SESSION['WISHLIST_ID']);
        unset($_SESSION['WISHLIST_ID']);
    }
}else{
    echo 'wrong';
}
?>
