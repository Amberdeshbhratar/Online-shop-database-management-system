<?php
require('top.inc.php');
isAdmin();
if(isset($_GET['type']) && $_GET['type']!=''){
	$type=$_GET['type'];
	if($type=='status'){
		$operation=$_GET['operation'];
		$id=$_GET['id'];
		if($operation=='active'){
			$status='1';
		}else{
			$status='0';
		}
		$update_status_sql="update product_review set status='$status' where id='$id'";
		mysqli_query($con,$update_status_sql);
	}
	if($type=='delete'){
		$id=$_GET['id'];
		$delete_sql="delete from product_review where id='$id'";
		mysqli_query($con,$delete_sql);
	}
}

$sql="select users.name,users.email,product_review.id,product_review.rating,product_review.review,product_review.added_on,product_review.status,product.name as pname from users,product_review,product where product_review.user_id=users.id and product_review.product_id=product.id  order by product_review.added_on desc";
$res=mysqli_query($con,$sql);
?>
<div class="card-body">
<h4 class="box-title">Product Reviews </h4>
				   
<table class="styled-table">
    <thead>
        <tr>
        <th>#</th>
            <th>ID</th>
            <th>Name/Email</th>
            <th>Product</th>
            <th>Rating</th>
            <th>Review</th>
            <th>Date</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    <?php
    $i=1;
    while($row=mysqli_fetch_assoc($res)){?>
        <tr>
            <td><?php echo $i?></td>
            <td><?php echo $row['id']?></td>
            <td><?php echo $row['name']?><br><?php echo $row['email']?></td>
            <td><?php echo $row['pname']?></td>
            <td><?php echo $row['rating']?></td>
            <td><?php echo $row['review']?></td>
            <td><?php echo $row['added_on']?></td>
            <td><?php
								if($row['status']==1){
									echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=".$row['id']."'>Active</a></span>&nbsp;";
								}else{
									echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=".$row['id']."'>Deactive</a></span>&nbsp;";
								}
								echo "<span class='badge badge-delete'><a href='?type=delete&id=".$row['id']."'>Delete</a></span>";
								?></td>
        </tr>
    <?php $i++; } ?>    
    </tbody>
</table>
        </div>
      </div>
    </div>
  </body>
</html>
