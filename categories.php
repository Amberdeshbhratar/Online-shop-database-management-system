<?php
require_once('top.php');
$cat_id=$_GET['id'];
$get_product=get_product($con,'',$cat_id);
?>
<ul class="breadcrumb bc3x">
  <li><a href="index.php">Home</a></li>
  <?php if(count($get_product)>0){?><li><a href="categories.php?id=<?php echo $get_product['0']['categories_id']?> "><?php echo $get_product['0']['categories'] ?> </a></li><?php } ?>  
  <!-- <li><a href="product.php?id=<?php echo $get_product['0']['id'] ?>"><?php echo $get_product['0']['name'] ?></a></li> -->
</ul>
<section>  
     <div class="section">  
         
       </div>  
       <?php if(count($get_product)>0){?>
       <div class="section2">  
         <div class="container"> 
          <?php
          foreach ($get_product as $list) {
            ?>
           <div class="items" style="border-radius: 0px; width: 350px;
          height:100%; border-width:thin;">  
             <div class="img img1" style=" aspect-ratio: 1/1; padding:4px; "><a href="product.php?id=<?php echo $list['id'] ?>"><img  style="border-radius: 0px;  margin:auto; object-fit: scale-down; height: -webkit-fill-available;"
                 src="<?php echo PRODUCT_IMAGE_SITE_PATH.$list['image'] ?>"  
                 alt=""></a></div>  
             <div class="name" style="background: A9A9A9; padding: 10px; height:100%;font-weight:700;font-size:20px"><?php echo $list['name'] ?></div>  
             <div class="price" style="padding: 10px;"><del>₹<?php echo $list['mrp'] ?></del> <ins>₹<?php echo $list['price'] ?></ins></div>  
             <div class="wish2" style="text-align:center;"><a href="javascript:void(0)" onclick="manage_wishlist('<?php echo $list['id'] ?>','add')" ><i class="fa-regular fa-heart" style="color: rgb(224, 56, 84);"></i></a></div>
             <div style="text-align:center;margin-top:5px;padding:10px;margin-bottom:5px;" class="wish"><a href="javascript:void(0)" onclick="manage_wishlist('<?php echo $list['id'] ?>','add')" class="btnx">+ Add to Wish List</a>
             <!-- <a  href="javascript:void(0)" onclick="manage_cart('<?php echo $list['id'] ?>','add')"><i class="fa-solid fa-bag-shopping"></i></a></div>  --></div>
           </div>  
           <?php } ?>  
         </div>  
       </div> 
       <?php }else echo "Data Not Found" ?>  
     </div>  
   </section> 
<?php
require_once('footer.php');
?>