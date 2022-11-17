<?php
require_once('connection.inc.php');
function pr($arr){
    echo "<pre>";
    print_r($arr);
}
function prx($arr){
    echo "<pre>";
    print_r($arr);
    die();
}
function get_product($con,$limit='',$cat_id='',$product_id='',$search_str=''){
    $sql="select product.*,categories.categories from product,categories where product.categories_id = categories.id and product.status=1";
    if($cat_id!=''){
        $sql.=" and product.categories_id=$cat_id";
    }
    if($product_id!=''){
        $sql.=" and product.id=$product_id";
    }
    if($search_str!=''){
        $sql.=" and (product.name like '%$search_str%' or product.description like '%$search_str%')";
    }
    $sql.=" order by id desc";
    if($limit!=''){
        $sql.=" limit $limit";
    }
    $res=mysqli_query($con,$sql);
    $data=array();
    while($row=mysqli_fetch_assoc($res)){
        $data[]=$row;
    }
    return $data;
}
function addWishlist($con,$uid,$pid){
    $added_on = date('Y-m-d h:i:s');
    mysqli_query($con,"insert into wishlist(user_id,product_id,added_on)values('$uid','$pid','$added_on')");
}
function productSoldQtyByProductId($con,$pid){
	$sql="select sum(order_detail.qty) as qty from order_detail,`order` where `order`.id=order_detail.order_id and order_detail.product_id=$pid and `order`.order_status!=4 and ((`order`.payment_type='payu' and `order`.payment_status='Success') or (`order`.payment_type='COD' and `order`.payment_status!=''))";
	$res=mysqli_query($con,$sql);
	$row=mysqli_fetch_assoc($res);
	return $row['qty'];
}

function productQty($con,$pid){
	$sql="select qty from product where id='$pid'";
	$res=mysqli_query($con,$sql);
	$row=mysqli_fetch_assoc($res);
	return $row['qty'];
}
?>
