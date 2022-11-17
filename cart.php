<?php
require_once('top.php');
?>
<style>
<?php include 'cart.css'; ?>
</style>
<ul class="breadcrumb bc3x">
  <li><a href="index.php">Home</a></li>
  <li><a href="cart.php">Cart</a></li>
</ul>

<div class="table-wrapper">
    <table class="fl-table">
        <thead>
        <tr>
            <th>PRODUCTS</th>
            <th>NAME OF PRODUCTS</th>
            <th>PRICE</th>
            <th>QUANTITY</th>
            <th>TOTAL</th>
            <th>REMOVE</th>
        </tr>
        </thead>
        <tbody>

        <?php
										if(isset($_SESSION['cart'])){
											foreach($_SESSION['cart'] as $key=>$val){
											$productArr=get_product($con,'','',$key);
											$pname=$productArr[0]['name'];
											$mrp=$productArr[0]['mrp'];
											$price=$productArr[0]['price'];
											$image=$productArr[0]['image'];
											$qty=$val['qty'];
											?>

        <tr>
            <td><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$image?>" alt=""></td>
            <td><div><?php echo $pname ?></div>
                <span><del>₹<?php echo $mrp ?></del></span>
                <span><ins>₹<?php echo $price ?></ins></span></td>
            <!-- <td><?php echo $price ?></td> -->

            <td>₹<?php echo $price ?></td>
            <td><div id="incdec">
                <!-- <i class="fa-solid fa-up-long" id="<?php echo $key ?>up"></i> -->
    <input type="text" style="text-align:center;" value="<?php echo $qty ?>" id="<?php echo $key ?>qty"/>
    <!-- <i class="fa-solid fa-down-long" id="<?php echo $key ?>down"></i> -->
</div><div><a href="javascript:void(0)" onclick="manage_cart('<?php echo $key ?>','update')">Update</a></div></td>

            <td>₹<?php echo $qty*$price ?></td>
            <td><a href="javascript:void(0)" onclick="manage_cart('<?php echo $key ?>','remove')"><i class="fa-solid fa-trash"></i></a></td>
        </tr>
        <?php } } ?>
</tbody>
    </table>
    <a href="checkout.php"><button type="button" class="btn btn-secondary" style="border:1px solid black">Checkout</button></a>
    <a href="index.php"><button type="button" class="btn btn-secondary" >Continue Shopping</button></a>
</div>
<?php
require_once('footer.php');
?>