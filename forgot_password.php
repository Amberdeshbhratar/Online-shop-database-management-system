<?php
require_once("top.php");
if(isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN']=='yes'){
	?>
	<script>
	window.location.href='my_order.php';
	</script>
	<?php
}
?>
<style>
<?php include 'login.css'; ?>
</style>
<div class="containerx">
      <!-- <div class="leftx">
        <div class="signup-boxx">
          <h1>Sign Up</h1>
          <h4>It's free and only takes a minute</h4>
          <form method="post" id="register-form">
            <label>Name</label>
            <input type="text" placeholder="" name="name" id="name"/>
            <span class="field_error" id="name_error"></span>
            <label>Email</label>
            <input type="email" placeholder="" name="email" id="email"/>
            <span class="field_error" id="email_error"></span>
            <label>Mobile</label>
            <input type="mobile" placeholder="" name="mobile" id="mobile"/>
            <span class="field_error" id="mobile_error"></span>
            <label>Password</label>
            <input type="password" placeholder="" name="password" id="password"/>
            <span class="field_error" id="password_error"></span>
            <button type="button" value="Submit" class="btn btn-primary cool" onclick="user_register()">Sign Up</button>
            <div class="register_msg"><p class="field_error"></p></div>
          </form>          
        </div>
      </div>   -->
      <div class="rightx">
      <div class="login-boxx">
      <h1>FORGOT PASSWORD</h1>
      <form id="login-form" method="post">
        <label>Email</label>
        <input type="email" placeholder="Your Email*" name="email" id="email"/>
        <span class="field_error" id="email_error"></span>
        
        <button type="button" id="btn_submit" class="btn btn-primary cool" onclick="forgot_password()">Submit</button>
        <div class="login_msg"><p class="field_error"></p></div>
      </form>
    </div> 
      </div>
      </div>
      <script>
		function forgot_password(){
			jQuery('#email_error').html('');
			var email=jQuery('#email').val();
			if(email==''){
				jQuery('#email_error').html('Please enter email id');
			}else{
				jQuery('#btn_submit').html('Please wait...');
				jQuery('#btn_submit').attr('disabled',true);
				jQuery.ajax({
					url:'forgot_password_submit.php',
					type:'post',
					data:'email='+email,
					success:function(result){
						jQuery('#email').val('');
						jQuery('#email_error').html(result);
						jQuery('#btn_submit').html('Submit');
						jQuery('#btn_submit').attr('disabled',false);
					}
				})
			}
		}
		</script>
<?php
require_once("footer.php");
?>