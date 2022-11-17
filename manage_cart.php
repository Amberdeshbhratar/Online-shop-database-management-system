<?php
require_once('connection.inc.php');
require_once('functions.inc.php');
require_once('add_to_cart.inc.php');
$pid=trim($_POST['pid']);
$qty=trim($_POST['qty']);
$type=trim($_POST['type']);

$productSoldQtyByProductId=productSoldQtyByProductId($con,$pid);
$productQty=productQty($con,$pid);

$pending_qty=$productQty-$productSoldQtyByProductId;

if($qty>$pending_qty && $type!='remove'){
	echo "not_avaliable";
	die();
}
$obj = new add_to_cart();
if($type=='add'){
    $obj->addProduct($pid,$qty);
}
if($type=='remove'){
    $obj->removeProduct($pid);
}
if($type=='update'){
    $obj->updateProduct($pid,$qty);
}
echo $obj->totalProduct();

?>
