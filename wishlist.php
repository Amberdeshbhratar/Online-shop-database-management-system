<?php
require_once('top.php');
if(!isset($_SESSION['USER_LOGIN'])){
    ?>
    <script>
        window.location.href='index.php';
    </script>
    <?php 
}
$uid = $_SESSION['USER_ID'];
// if(isset($_GET['id'])){
//     $wid = $_GET['id'];
//     mysqli_query($con,"delete from wishlist where id = '$wid' and user_id = '$uid'");
// }
$res = mysqli_query($con,"select product.name,product.image,product.mrp,product.price,wishlist.id from product,wishlist where wishlist.product_id=product.id and wishlist.user_id ='$uid'");
?>
<style>
<?php include 'cart.css'; ?>
</style>
<ul class="breadcrumb bc3x">
  <li><a href="index.php">Home</a></li>
  <li><a href="wishlist.php">Wishlist</a></li>
</ul>

<div class="table-wrapper">
    <table class="fl-table">
        <thead>
        <tr>
            <th>PRODUCTS</th>
            <th>NAME OF PRODUCTS</th>
            <th>REMOVE</th>
        </tr>
        </thead>
        <tbody>

            <?php
            while($row=mysqli_fetch_assoc($res)){
                
                // $qty=$val['qty'];
            ?>

        <tr>
            <td><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image']?>" alt=""></td>
            <td><div><?php echo $row['name'] ?></div>
                <span><del>₹<?php echo $row['mrp'] ?></del></span>
                <span><ins>₹<?php echo $row['price'] ?></ins></span></td>
            <!-- <td><?php echo $price ?></td> -->

            <!-- <td>₹<?php echo $price ?></td> -->
            <!-- <td><div id="incdec"> -->
                <!-- <i class="fa-solid fa-up-long" id="<?php echo $key ?>up"></i> -->
    <!-- <input type="text" style="text-align:center;" value="<?php echo $qty ?>" id="<?php echo $key ?>qty"/> -->
    <!-- <i class="fa-solid fa-down-long" id="<?php echo $key ?>down"></i> -->
<!-- </div><div><a href="javascript:void(0)" onclick="manage_cart('<?php echo $key ?>','update')">Update</a></div></td> -->

            <!-- <td>₹<?php echo $qty*$price ?></td> -->
            <td><a href="wishlist.php?wishlist_id=<?php echo $row['id'] ?>"><i class="fa-solid fa-trash"></i></a></td>
        </tr>
       <?php } ?>
</tbody>
    </table>
    <!-- <a href="checkout.php"><button type="button" class="btn btn-secondary" style="border:1px solid black">Checkout</button></a>
    <a href="index.php"><button type="button" class="btn btn-secondary" >Continue Shopping</button></a> -->
</div>
<?php
require_once('footer.php');
?>