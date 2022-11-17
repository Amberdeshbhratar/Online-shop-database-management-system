<?php
require_once('top.inc.php');
isAdmin();
?>
<div class="card-body">
<h4 class="box-title">Orders</h4>
				   
<table class="styled-table">
<table class="styled-table">
        <thead>
        <tr>
            <th>ORDER ID</th>
            <th>ORDER DATE</th>
            <th>ADDRESS</th>
            <th>PAYMENT TYPE</th>
            <th>PAYMENT STATUS</th>
            <th>ORDER STATUS</th>
        </tr>
        </thead>
        <tbody>

            <?php
            $res = mysqli_query($con,"select `order`.*,order_status.name as order_status_str from `order`,order_status where order_status.id=order.order_status" );
            while ($row = mysqli_fetch_assoc($res)) {
                ?>
        <tr>
            <td><a href="order_detail.php?id=<?php echo $row['id'] ?>"><?php echo $row['id'] ?></a></td>
            <td><?php echo $row['added_on'] ?></td>
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
