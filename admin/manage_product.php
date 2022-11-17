<?php
require_once('top.inc.php');
$condition='';
$condition1='';
if($_SESSION['ADMIN_ROLE']==1){
	$condition=" and product.added_by='".$_SESSION['ADMIN_ID']."'";
	$condition1=" and added_by='".$_SESSION['ADMIN_ID']."'";
}
$categories_id='';
$name='';
$mrp='';
$price='';
$qty='';
$image='';
$short_desc='';
$description='';
$meta_title='';
$meta_desc='';
$meta_keyword='';
$msg='';
$image_required='required';
if(isset($_GET['id'])&&$_GET['id']!=''){
    $image_required='';
    $id=$_GET['id'];
    $res=mysqli_query($con,"select * from product where id='$id' $condition1");
    $check=mysqli_num_rows($res);
    if($check>0){
        $row=mysqli_fetch_assoc($res);
        // $categories=$row['categories'];    
        $categories_id=$row['categories_id'];
        $name=$row['name'];
        $mrp=$row['mrp'];
        $price=$row['price'];
        $qty=$row['qty'];
        // $image=$row['image'];
        $short_desc=$row['short_desc'];
        $description=$row['description'];
        $meta_title=$row['meta_title'];
        $meta_desc=$row['meta_desc'];
        $meta_keyword=$row['meta_keyword'];
    }else{
        header('location:product.php');
        die();
    }
}
//ID IS A PRIMARY KEY 
if(isset($_POST['submit'])){

  // $name=trim($_POST[name]);
  //   // $categories_id=trim('$_POST[categories_id');
  //   // $mrp=trim('$_POST[mrp');
  //   // $price=trim('$_POST[price');
  //   // $qty=trim('$_POST[qty');
  //   // $image=trim('$_POST[image');
  //   $short_desc=trim($_POST[short_desc]);
  //   $description=trim($_POST[description]);
  //   $meta_title=trim($_POST[meta_title]);
  //   $meta_desc=trim($_POST[meta_desc]);
  //   $meta_keyword=trim($_POST[meta_keyword]);  
  
    $name=trim($_POST['name']);
    $categories_id=trim($_POST['categories_id']);
    $mrp=trim($_POST['mrp']);
    $price=trim($_POST['price']);
    $qty=trim($_POST['qty']);
    // $image=trim($_POST['image']);
    $short_desc=trim($_POST['short_desc']);
    $description=trim($_POST['description']);
    $meta_title=trim($_POST['meta_title']);
    $meta_desc=trim($_POST['meta_desc']);
    $meta_keyword=trim($_POST['meta_keyword']);

    



    // $id=$_POST['id'];
    $res=mysqli_query($con,"select product.* from product where product.name='$name' $condition1");
    $check=mysqli_num_rows($res);
    if($check>0){
        if(isset($_GET['id'])&&$_GET['id']!=''){
            $getData=mysqli_fetch_assoc($res);
            if($id!=$getData['id'])$msg="Product already exists";
    }else{
        $msg="Product already exists";
    }
}       
    // $res2=mysqli_query($con,"select * from categories where id='$id'");
    // $check2=mysqli_num_rows($res2);
    if($_FILES['image']['type']!=''&&($_FILES['image']['type']!='image/png'&&$_FILES['image']['type']!='image/jpg')&&$_FILES['image']['type']!='image/jpeg'){
      $msg="Invalid format! Please submit jpg/jpeg/png file only";
    }
    if($msg==''){
        if(isset($_GET['id'])&&$_GET['id']!=''){
          if($_FILES['image']['name']!=''){
            $image=rand(111111111,999999999)."_".$_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
            $update_sql="update product set categories_id='$categories_id',name='$name',mrp='$mrp',price='$price',qty='$qty',short_desc='$short_desc',description='$description',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword',image='$image' where id='$id'";
          }else{
            $update_sql="update product set categories_id='$categories_id',name='$name',mrp='$mrp',price='$price',qty='$qty',short_desc='$short_desc',description='$description',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword' where id='$id'";
          }  
          mysqli_query($con,$update_sql);
        }else{ 
          $image=rand(111111111,999999999)."_".$_FILES['image']['name'];
          move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
            mysqli_query($con,"insert into product(categories_id,name,mrp,price,qty,image,short_desc,description,meta_title,meta_desc,meta_keyword,status,added_by)values('$categories_id','$name','$mrp','$price','$qty','$image','$short_desc','$description','$meta_title','$meta_desc','$meta_keyword',1,'".$_SESSION['ADMIN_ID']."')");
        }
            header('location:product.php');
        die();
    }
}

?>
<div class="card-header"><strong>Product Management</strong><small> Form</small></div>
<form class="forma" method="post" enctype="multipart/form-data">  
<div ><label for="categories" class="form-label">Categories</label></div>  
<select class="mb-3" name="categories_id">
    <option >Select Category</option>
    <?php
        $res = mysqli_query($con,"select id,categories from categories order by categories asc");
        while($row=mysqli_fetch_assoc($res)){
            if($row['id']==$categories_id)
            echo "<option selected value=".$row['id'].">".$row['categories']."</option>";
            else echo "<option value=".$row['id'].">".$row['categories']."</option>";
        }
    ?>
  </select>

<div class="mb-3">
    <label for="categories" class="form-label">Product Name</label>
    <input type="text" name="name" class="form-control" placeholder="Enter product name" id="exampleInputEmail1" required value="<?php echo $name ?>">
  </div>
  <div class="mb-3">
    <label for="categories" class="form-label">MRP</label>
    <input type="text" name="mrp" class="form-control" placeholder="Enter product mrp" id="exampleInputEmail1" required value="<?php echo $mrp ?>">
  </div>
  <div class="mb-3">
    <label for="categories" class="form-label">Price</label>
    <input type="text" name="price" class="form-control" placeholder="Enter product price" id="exampleInputEmail1" required value="<?php echo $price ?>">
  </div>
  <div class="mb-3">
    <label for="categories" class="form-label">Qty</label>
    <input type="text" name="qty" class="form-control" placeholder="Enter qty" id="exampleInputEmail1" required value="<?php echo $qty ?>">
  </div>
  <div class="mb-3">
    <label for="categories" class="form-label">Image</label>
    <input type="file" name="image" class="form-control" id="exampleInputEmail1" <?php echo $image_required ?>>
  </div>
  <div class="mb-3">
    <label for="categories" class="form-label">Short Description</label>
    <textarea name="short_desc" class="form-control" placeholder="Enter product short description" id="exampleInputEmail1" required ><?php echo $short_desc ?></textarea>
  </div>
  <div class="mb-3">
    <label for="categories" class="form-label">Description</label>
    <textarea name="description" class="form-control" placeholder="Enter product description" id="exampleInputEmail1" required ><?php echo $description ?></textarea>
  </div>

  <div class="mb-3">
    <label for="categories" class="form-label">Meta Title</label>
    <textarea name="meta_title" class="form-control" placeholder="Enter product meta title" id="exampleInputEmail1" ><?php echo $meta_title ?></textarea>
  </div>
  <div class="mb-3">
    <label for="categories" class="form-label">Meta Description</label>
    <textarea name="meta_desc" class="form-control" placeholder="Enter product meta description" id="exampleInputEmail1" ><?php echo $meta_desc ?></textarea>
  </div>
  <div class="mb-3">
    <label for="categories" class="form-label">Meta Keyword</label>
    <textarea name="meta_keyword" class="form-control" placeholder="Enter product meta keyword" id="exampleInputEmail1" ><?php echo $meta_keyword ?></textarea>
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
  <div style="color:red"><?php echo $msg?></div>
</form>