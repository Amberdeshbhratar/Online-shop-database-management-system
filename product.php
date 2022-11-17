<?php
require_once('top.php');
$product_id=$_GET['id'];
$get_product=get_product($con,'','',$product_id);
if(isset($_POST['review_submit'])){
	$rating=$_POST['rating'];
	$review=$_POST['review'];
	
	$added_on=date('Y-m-d h:i:s');
	mysqli_query($con,"insert into product_review(product_id,user_id,rating,review,status,added_on) values('$product_id','".$_SESSION['USER_ID']."','$rating','$review','1','$added_on')");
	header('location:product.php?id='.$product_id);
	die();
}


$product_review_res=mysqli_query($con,"select users.name,product_review.id,product_review.rating,product_review.review,product_review.added_on from users,product_review where product_review.status=1 and product_review.user_id=users.id and product_review.product_id='$product_id' order by product_review.added_on desc");

?>
<style>
<?php include 'rating.css'; ?>
</style>
<ul class="breadcrumb bc3x">
  <li><a href="index.php">Home</a></li>
  <li><a href="categories.php?id=<?php echo $get_product['0']['categories_id']?> "><?php echo $get_product['0']['categories'] ?> </a></li>
  <li><a href="product.php?id=<?php echo $get_product['0']['id'] ?>"><?php echo $get_product['0']['name'] ?></a></li>
</ul>
<section>  
       <div class="section2">  
         <div class="container" style="background-color:#E0E0E0;"> 
           <div class="items" style="height:230px; width: 230px; padding:15px;">  
             <div class="img img1"><img  style="height: 200px;"  
                 src="<?php echo PRODUCT_IMAGE_SITE_PATH.$get_product['0']['image']?>"  
                 alt="">
             </div>    
           </div>
           <div class="infoTech">
           <div class="name2" style="font-size:xx-large;"><?php echo $get_product['0']['name'] ?></div>  
             <div class="price" style="font-weight: bold;"><del>₹<?php echo $get_product['0']['mrp'] ?></del> <ins>₹<?php echo $get_product['0']['price'] ?></ins></div>  
             <div class="info"><?php echo $get_product['0']['short_desc'] ?></div>
             <div class="">
             <?php
										$productSoldQtyByProductId=productSoldQtyByProductId($con,$get_product['0']['id']);
										
										$pending_qty=$get_product['0']['qty']-$productSoldQtyByProductId;
										
										$cart_show='yes';
										if($get_product['0']['qty']>$productSoldQtyByProductId){
											$stock='In Stock';			
										}else{
											$stock='Not in Stock';
											$cart_show='';
										}
										?>
                                        <p><span>Availability:</span> <?php echo $stock?></p>
             <?php
               if($cart_show!=''){
               ?>
              <p><span>Qty:</span>
                <select id="qty">
                <?php
											for($i=1;$i<=$pending_qty;$i++){
												echo "<option>$i</option>";
											}
											?>
                </select>
            </p>
            <?php } ?>
             </div>

             <div class="">
              <p><span>Categories:</span>
                    <a href="#" style="color:black ;"><?php echo $get_product['0']['categories'] ?></a>
            </p>
             </div>
             <?php
								if($cart_show!=''){
								?>
             <a href="javascript:void(0)" onclick="manage_cart('<?php echo $get_product['0']['id'] ?>','add')"><button type="button" class="btn bg-light px-auto" style=" box-shadow: 0px 5px 10px #212121; border-radius: 0px; color: black;"><i class="fa-solid fa-cart-shopping" ></i>&nbsp;Add to Cart</button></a>
             <?php } ?>
            </div>   
         </div>
         <div style="padding: 20px 20% ;padding-bottom:0px; ">
           <div style="font-weight:bold; font-size: x-large; ">Description:</div>
           <div class="info" style="margin-top:10px; margin-bottom:10px; font-family: Times New Roman, Times, serif; font-size:large;"><?php echo $get_product['0']['description'] ?></div>    
         </div>
       </div>
     </div>  
     
   </section> 
   <!--Testimonials------------------->
   <section id="testimonials">
        <!--heading--->
        <div class="testimonial-heading">
            <span>Comments</span>
            <!-- <h1>Clients Says</h1> -->
        </div>
        <?php 
									if(mysqli_num_rows($product_review_res)>0){
									
									while($product_review_row=mysqli_fetch_assoc($product_review_res)){
									?>
        <!--testimonials-box-container------>
        <div class="testimonial-box-container">
            <!--BOX-1-------------->
            <div class="testimonial-box">
                <!--top------------------------->
                <div class="box-top">
                    <!--profile----->
                    <div class="profile">
                        <!--img---->

                        <!--name-and-username-->
                        <div class="name-user">
                            <strong><?php echo $product_review_row['name']?></strong>
                            <span><?php echo $product_review_row['rating']?></span>
                        </div>
                    </div>
                    <!--reviews------>
                    <!-- <div class="reviews">
                        <span></span> </span>
                    </div> -->
                    <time class="comment-date"> 
<?php
$added_on=strtotime($product_review_row['added_on']);
echo date('d M Y',$added_on);
?>
                </div>
                <!--Comments---------------------------------------->
                <div class="client-comment">
                <p>
												  <?php echo $product_review_row['review']?>
												</p>
                </div>
            </div>
        </div>
        <?php } }else { 
										echo "<h3 class='submit_review_hint'>No review added</h3><br/>";
									}
									?>
    </section>
      <!-- <script src="https://use.fontawesome.com/a6f0361695.js"></script> -->

<h2 id="fh2">WE APPRECIATE YOUR REVIEW!</h2>
<?php
									if(isset($_SESSION['USER_LOGIN'])){
									?>
<form id="feedback" action="" method="post">

<div class="form-group">
  <div class="col-md-100 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="fa fa-heart"></i></span>
   <select class="form-control" id="rate" name="rating">
   <option value="">Select Rating</option>
      <option >Worst</option>
      <option >Bad</option>
      <option >Good</option>
      <option >Very Good</option>
      <option >Fantastic</option>
    </select>
    </div>
  </div>
</div>

 <div class="pinfo">Write your feedback.</div>
  

<div class="form-group">
  <div class="col-md-100 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
  <textarea class="form-control" id="new-review" name="review" rows="3"></textarea>
 
    </div>
  </div>
</div>

 <button type="submit" class="btn btn-primary"  name="review_submit">Submit</button>


</form>
<?php } else {
										echo "<div style='text-align:center;'><span class='submit_review_hint'>Please <a href='login.php'>login</a> to submit your review</span><div>";
									}
									?>
<?php
require_once('footer.php');
?>