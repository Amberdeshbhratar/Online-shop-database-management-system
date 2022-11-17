<footer>  
     <div class="footer0">  
       <h1>OSDBMS</h1>  
     </div>  
     <div class="footer1 ">  
       Connect with us at<div class="social-media">  
         <a href="javascript:void(0)">  
         <i class="fa-brands fa-facebook"></i> 
         </a>  
         <a href="javascript:void(0)">  
         <i class="fa-brands fa-linkedin"></i>
         </a>  
         <a href="javascript:void(0)">  
         <i class="fa-brands fa-square-youtube"></i> 
         </a>  
         <a href="javascript:void(0)">  
         <i class="fa-brands fa-square-instagram"></i> 
         </a>  
         <a href="javascript:void(0)">  
         <i class="fa-brands fa-square-twitter"></i>
         </a>  
       </div>  
     </div>  
     <div class="footer2">  
       <div class="product">  
         <div class="heading">Products</div>  
         <div class="div">Sell your Products</div>  
         <div class="div">Advertise</div>  
         <div class="div">Pricing</div>  
         <div class="div">Product Buisness</div>  
       </div>  
       <div class="services">  
         <div class="heading">Services</div>  
         <div class="div">Return</div>  
         <div class="div">Cash Back</div>  
         <div class="div">Affiliate Marketing</div>  
         <div class="div">Others</div>  
       </div>  
       <div class="Company">  
         <div class="heading">Company</div>  
         <div class="div">Complaint</div>  
         <div class="div">Careers</div>  
         <div class="div">Affiliate Marketing</div>  
         <div class="div">Support</div>  
       </div>  
       <div class="Get Help">  
         <div class="heading">Get Help</div>  
         <div class="div">Help Center</div>  
         <div class="div">Privacy Policy</div>  
         <div class="div">Terms</div>  
         <div class="div">Login</div>  
       </div>  
     </div>  
     <div class="footer3">Copyright © <h4>OSDBMS</h4> 2022</div>  
   </footer> 
   <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
   <script>function user_register(){
    jQuery('.field_error').html('');
    var name=jQuery('#name').val();
    var email=jQuery('#email').val();
    var mobile=jQuery('#mobile').val();
    var password=jQuery('#password').val();
    var is_error="";
    if(name==""){
      jQuery('#name_error').html('Please enter name');
      is_error='yes';
    } if(email==""){
      jQuery('#email_error').html('Please enter email');
      is_error='yes';
    } if(mobile==""){
      jQuery('#mobile_error').html('Please enter mobile');
      is_error='yes';
    } if(password==""){
      jQuery('#password_error').html('Please enter password');
      is_error='yes';
    }
    
    if(is_error==''){
      $.ajax({
        url:'register_submit.php',
        type:'post',
        data:'name='+name+'&email='+email+'&mobile='+mobile+'&password='+password,
        success:function(result){
            jQuery('.register_msg p').html(result);
        }
      });
    }
  }
  function user_login(){
    jQuery('.field_error').html('');
    var email=jQuery('#login_email').val();
    var password=jQuery('#login_password').val();
    var is_error="";
    if(email==""){
      jQuery('#login_email_error').html('Please enter email');
      is_error='yes';
    } if(password==""){
      jQuery('#login_password_error').html('Please enter password');
      is_error='yes';
    }
    
    if(is_error==''){
      $.ajax({
        url:'login_submit.php',
        type:'post',
        data:'email='+email+'&password='+password,
        success:function(result){
          if(result==' wrong'){
            jQuery('.login_msg p').html('Please enter valid login details');
          }
          if(result==' valid'){
            window.location.href='checkout.php';
          }
        }
      });
    }
  }

  function manage_cart(pid,type){
    if(type=='update'){
      var qty = jQuery('#'+pid+'qty').val();  
    }else var qty = jQuery('#qty').val();
      $.ajax({
        url:'manage_cart.php',
        type:'post',
        data:'pid='+pid+'&qty='+qty+'&type='+type,
        success:function(result){
          if(type=='update'||type=='remove'){
            window.location.href=window.location.href;
          }
          if(result==' not_avaliable'){
				    alert('Qty not avaliable');	
			    }else{
				    jQuery('.addCart').html(result);
			    }
          
        }
      });
  }
  function manage_wishlist(pid,type){
      $.ajax({
        url:'manage_wishlist.php',
        type:'post',
        data:'pid='+pid+'&type='+type,
        success:function(result){
          if(result=='not_login'){
            window.location.href='login.php';
          }else{
          jQuery('.dance').html(result);
        }
        }
      });
  }

</script>
<!-- <script>
  $(document).ready(function(id){
    $("#"+id).on('click',function(){
        $("#incdec input").val(parseInt($("#incdec input").val())+1);
    });

    $("#"+id).on('click',function(){
        $("#incdec input").val(parseInt($("#incdec input").val())-1);
    });

});
    </script> -->

   <script>
         const menuBtn = document.querySelector(".menu-icon span");
         const searchBtn = document.querySelector(".search-icon");
         const cancelBtn = document.querySelector(".cancel-icon");
         const items = document.querySelector(".nav-items");
         const form = document.querySelector("form");
         menuBtn.onclick = ()=>{
           items.classList.add("active");
           menuBtn.classList.add("hide");
           searchBtn.classList.add("hide");
           cancelBtn.classList.add("show");
         }
         cancelBtn.onclick = ()=>{
           items.classList.remove("active");
           menuBtn.classList.remove("hide");
           searchBtn.classList.remove("hide");
           cancelBtn.classList.remove("show");
           form.classList.remove("active");
           cancelBtn.style.color = "#ff3d00";
         }
         searchBtn.onclick = ()=>{
           form.classList.add("active");
           searchBtn.classList.add("hide");
           cancelBtn.classList.add("show");
         }
      </script>
   <script src="script.js"></script>
   <script src="https://kit.fontawesome.com/49e1ee22ec.js" crossorigin="anonymous"></script>
   <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>