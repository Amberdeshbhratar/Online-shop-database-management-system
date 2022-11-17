<?php
require_once('top.inc.php');
isAdmin();
$order_id = $_GET['id'];
if(isset($_POST['update_order_status'])){
    $update_order_status=$_POST['update_order_status'];
    mysqli_query($con,"update `order` set order_status = '$update_order_status' where id='$order_id'");
}
?>
<div class="card-body">
<h4 class="box-title">Order Details</h4>

<table class="styled-table">
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
            // $uid = $_SESSION['USER_ID'];
            $res = mysqli_query($con,"select distinct(order_detail.id),order_detail.*,product.name,product.image,order.address,order.city,order.pincode from order_detail,product,`order` where order_detail.order_id = '$order_id' and product.id = order_detail.product_id" );
            $total_price=0;
            while ($row = mysqli_fetch_assoc($res)) {
                $address=$row['address'];$city=$row['city'];$pincode=$row['pincode'];
                $total_price+=$row['price']*$row['qty'];
                ?>
        <tr>
            <td><?php echo $row['name'] ?></td>
            <td><img  style="height: 60px;width: 60px;" 
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
    <div class="address-details">
        <strong>Address: </strong>
        <?php echo $address ?>, <?php echo $city ?>, <?php echo $pincode ?><br/><br/>
        <strong>Order Status: </strong>
        <?php
            $order_status_arr=mysqli_fetch_assoc(mysqli_query($con,"select order_status.name from order_status,`order` where order.id='$order_id' and order.order_status=order_status.id"));
            echo $order_status_arr['name']; 
        ?>
        <div class="">Select Status:</div>
        <div class="">
            <form action="" method="post" class="form-control">
            <select class="mb-3" name="update_order_status">
    <option disabled >Select Status</option>
    <?php
        $res = mysqli_query($con,"select * from order_status");
        while($row=mysqli_fetch_assoc($res)){
            if($row['id']==$categories_id)
            echo "<option selected value=".$row['id'].">".$row['name']."</option>";
            else echo "<option value=".$row['id'].">".$row['name']."</option>";
        }
    ?>
  </select>
  <input type="submit" value="Submit" class="form-control btn btn-primary">
            </form>
        </div>
    </div>
        </div>
      </div>
    </div>
  </body>
</html>
