<?php
require_once('top.inc.php');;
?>
<div class="card-body">
<h4 class="box-title">Orders</h4>
<table class="styled-table">
        <thead>
        <tr>
            <th>ORDER ID</th>
            <th>PRODUCT/QTY</th>
            <th>ADDRESS</th>
            <th>PAYMENT TYPE</th>
            <th>PAYMENT STATUS</th>
            <th>ORDER STATUS</th>
        </tr>
        </thead>
        <tbody>

            <?php
            $res=mysqli_query($con,"select order_detail.qty,product.name,`order`.*,order_status.name as order_status_str from order_detail,product,`order`,order_status where order_status.id=`order`.order_status and product.id=order_detail.product_id and `order`.id=order_detail.order_id and product.added_by='".$_SESSION['ADMIN_ID']."' order by `order`.id desc");
            while ($row = mysqli_fetch_assoc($res)) {
                ?>
        <tr>
            <td><?php echo $row['id'] ?></td>
            <td><?php echo $row['name'] ?></br>Qty:<?php echo $row['qty'] ?></td>
            <td><?php echo $row['address'] ?><br/><?php echo $row['city'] ?><br/><?php echo $row['pincode'] ?></td>
            <td><?php echo $row['payment_type'] ?></td>
            <td><?php echo $row['payment_status'] ?></td>
            <td><?php echo $row['order_status'] ?></td>
        </tr>
        <?php } ?>
</tbody>
    </table>
        </div>
      </div>
    </div>
  </body>
</html>
