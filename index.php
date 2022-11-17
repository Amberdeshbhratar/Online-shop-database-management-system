<?php
require_once('top.php');
?>
<section>  
     <div class="section">  
       <div class="section1">  
         <div class="img-slider">  
           <img src="https://images.pexels.com/photos/6347888/pexels-photo-6347888.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"  
             alt="" class="img">  
           <img src="https://images.pexels.com/photos/3962294/pexels-photo-3962294.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"  
             alt="" class="img">  
           <img src="https://images.pexels.com/photos/2292953/pexels-photo-2292953.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500"  
             alt="" class="img">  
           <img src="https://images.pexels.com/photos/1229861/pexels-photo-1229861.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"  
             alt="" class="img">  
           <img src="https://images.pexels.com/photos/1598505/pexels-photo-1598505.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"  
             alt="" class="img">  
         </div>  
       </div>  
       <div class="section2">  
         <div class="container" style="margin-top:30px" ;> 
          <?php
          $get_product=get_product($con,4);
          foreach ($get_product as $list) {
            ?>
           <div class="items" style="border-radius: 0px; width: 350px;
          height:100%; border-width:thin;">  
             <div class="img img1" style=" aspect-ratio: 1/1; padding:4px; "><a href="product.php?id=<?php echo $list['id'] ?>"><img style="border-radius: 0px;  margin:auto; object-fit: scale-down; height: -webkit-fill-available;"
                 src="<?php echo PRODUCT_IMAGE_SITE_PATH.$list['image'] ?>"  
                 alt=""></a></div>  
             <div class="name" style="background: A9A9A9; padding: 10px; height:100%;font-weight:700;font-size:20px"><?php echo $list['name'] ?></div>  
             <div class="price" style="padding: 10px;"><del>₹<?php echo $list['mrp'] ?></del> <ins>₹<?php echo $list['price'] ?></ins></div>  
             <?php
             if(isset($_SESSION['USER_LOGIN'])){
                  // echo '<li> <a href="profile.php"><i class="fa-solid fa-user" >&nbsp;&nbsp;'echo  '</i></a></li>';
                  ?>
                  <div class="wish2" style="text-align:center;"><a href="javascript:void(0)" onclick="manage_wishlist('<?php echo $list['id'] ?>','add')" ><i class="fa-regular fa-heart" style="color: rgb(224, 56, 84);"></i></a></div>
                  <div style="text-align:center;margin-top:5px;padding:10px;margin-bottom:5px;" class="wish"><a href="javascript:void(0)" onclick="manage_wishlist('<?php echo $list['id'] ?>','add')" class="btnx">+ Add to Wish List</a>
             <!-- <a  href="javascript:void(0)" onclick="manage_cart('<?php echo $list['id'] ?>','add')"><i class="fa-solid fa-bag-shopping"></i></a></div> -->
            </div>
                  <?php
               }
             ?>
             <!-- <a href="javascript:void(0)" onclick="manage_cart('<?php echo $list['id']?>','add')"><i class="icon-handbag icons"></i></a> -->
           </div> 
           <?php } ?>  
         </div>  
       </div>  
     </div>  
   </section> 
<?php
require_once('footer.php');
?>