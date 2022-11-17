<?php
require_once('connection.inc.php');
$name=trim($_POST['name']);
$mobile=trim($_POST['mobile']);
$email=trim($_POST['email']);
$comment=trim($_POST['comment']);
$added_on=date('Y-m-d h:m:s');
mysqli_query($con,"insert into contact_us(name,mobile,email,comment,added_on)values('$name','$mobile','$email','$comment','$added_on')");
echo "Thank you";
?>
