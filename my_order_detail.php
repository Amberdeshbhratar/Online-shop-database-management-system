<?php
require_once('top.php');
$order_id = $_GET['id'];
?>

<style>
<?php include 'cart.css'; ?>
</style>

<div class="table-wrapper">
    <table class="fl-table">
        <thead>
        <tr>
            <th>PRODUCT NAME</th>
            <th>PRODUCT IMAGE</th>
            <th>QTY</th>
            <th>PRICE</th>
            <th>TOTAL PRICE</th>
        </tr>
        </thead>
        <tbody>

            <?php
            $uid = $_SESSION['USER_ID'];
            $res = mysqli_query($con,"select distinct(order_detail.id),order_detail.*,product.name,product.image from order_detail,product,`order` where order_detail.order_id = '$order_id' and `order`.user_id='$uid' and product.id = order_detail.product_id" );
            $total_price=0;
            while ($row = mysqli_fetch_assoc($res)) {
                $total_price+=$row['price']*$row['qty'];
                ?>
        <tr>
            <td><?php echo $row['name'] ?></td>
            <td><img  
                 src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image']?>"  
                 alt=""></td>
            <td><?php echo $row['qty'] ?></td>
            <td>₹<?php echo $row['price'] ?></td>
            <!-- <td><?php echo $row['total_price'] ?></td> -->
            <td>₹<?php echo $row['price']*$row['qty'] ?></td>
        </tr>
        <?php } ?>
        <tr>
            <td colspan="3" ></td>
            <td>Total Price</td>
            <td>₹<?php echo $total_price?></td>
        </tr>
</tbody>
    </table>
</div>
<?php
require_once('footer.php');
?>