<?php
include_once 'top.inc.php';
isAdmin();
if(isset($_GET['type'])&& $_GET['type']!=''){
    $type=$_GET['type'];
    if($type=='delete'){
        $id=$_GET['id'];
        $delete_sql="delete from contact_us where id='$id'";
        mysqli_query($con,$delete_sql);
    }

}

$sql="select * from contact_us order by id desc";
$res=mysqli_query($con,$sql);

?>
<div class="card-body">
<h4 class="box-title">Contact Us </h4>
   
<table class="styled-table">
    <thead>
        <tr>
        <th>#</th>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Query</th>
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
            <td><?php echo $row['name']?></td>
            <td><?php echo $row['email']?></td>
            <td><?php echo $row['mobile']?></td>
            <td><?php echo $row['comment']?></td>
            <td><?php echo $row['added_on']?></td>
            <td><?php
                echo "<a href='?type=delete&id=".$row['id']."'>Delete</a>";
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
