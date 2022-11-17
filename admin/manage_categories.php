<?php
require_once('top.inc.php');
isAdmin();
$categories='';
// $id='';
$msg='';
if(isset($_GET['id'])&&$_GET['id']!=''){
    $id=$_GET['id'];
    $res=mysqli_query($con,"select * from categories where id='$id'");
    $check=mysqli_num_rows($res);
    // $row=mysqli_fetch_assoc($res);
    // $categories=$row['categories'];
    if($check>0){
        $row=mysqli_fetch_assoc($res);
        $categories=$row['categories'];    
    }else{
        header('location:categories.php');
        die();
    }
}
//ID IS A PRIMARY KEY 
if(isset($_POST['submit'])){
    $categories=$_POST['categories'];
    $categories=trim($categories);
    // $id=$_POST['id'];
    $res=mysqli_query($con,"select * from categories where categories='$categories'");
    $check=mysqli_num_rows($res);
    if($check>0){
        if(isset($_GET['id'])&&$_GET['id']!=''){
            $getData=mysqli_fetch_assoc($res);
            if($id!=$getData['id'])$msg="Category already exists";
    }else{
        $msg="Category already exists";
    }
}       
    // $res2=mysqli_query($con,"select * from categories where id='$id'");
    // $check2=mysqli_num_rows($res2);
    if($msg==''){
        if(isset($_GET['id'])&&$_GET['id']!=''){
            mysqli_query($con,"update categories set categories ='$categories' where id='$id'");
        }else{ 
            mysqli_query($con,"insert into categories(categories,status)values('$categories','1')");
        }
            header('location:categories.php');
        die();
    }
}

?>
<div class="card-header"><strong>Categories Management</strong><small> Form</small></div>
<form class="forma" method="post">  
<div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Categories</label>
    <input type="text" name="categories" class="form-control" placeholder="Enter categories name" id="exampleInputEmail1" required value="<?php echo $categories ?>">
  </div>
  
  
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
  <div style="color:red"><?php echo $msg?></div>
</form>