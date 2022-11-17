<?php
require_once("top.php");
?>
<style>
<?php include 'login.css'; ?>
</style>
<div class="containerx">
  <div class="leftx">
  <div class="signup-boxx">
      <h1>Change Password</h1>
      <form method="post"  id="frmPassword">
        <label>Current Password</label>
        <input type="password" name="current_password" id="current_password"/>
        <span class="field_error" id="current_password_error"></span>

        <label>New Password</label>
        <input type="password" name="new_password" id="new_password"/>
        <span class="field_error" id="new_password_error"></span>

        <label>Confirm New Password</label>
        <input type="password" name="confirm_new_password" id="confirm_new_password"/>
        <span class="field_error" id="confirm_new_password_error"></span>        
        
        <button type="button" id="btn_update_password" class="btn btn-primary cool" onclick="update_password()">Update</button>
        <!-- <div class="login_msg"><p class="field_error"></p></div> -->
      </form>
    </div> 
      </div>
      <div class="rightx">
      <div class="login-boxx">
      <h1>Profile</h1>
      <form id="login-form" method="post">
        <label>Name</label>
        <input type="text" placeholder="Your name*" name="name" id="name" value="<?php echo $_SESSION['USER_NAME']?>"/>
        <span class="field_error" id="name_error"></span>
        
        <button type="button" id="btn_submit" class="btn btn-primary cool" onclick="update_profile()">Update</button>
        <!-- <div class="login_msg"><p class="field_error"></p></div> -->
      </form>
    </div> 
      </div>
      </div>
      <script>
		function update_profile(){
			jQuery('.field_error').html('');
			var name=jQuery('#name').val();
			if(name==''){
				jQuery('#name_error').html('Please enter your name');
			}else{
				jQuery('#btn_submit').html('Please wait...');
				jQuery('#btn_submit').attr('disabled',true);
				jQuery.ajax({
					url:'update_profile.php',
					type:'post',
					data:'name='+name,
					success:function(result){
						jQuery('#name_error').html(result);
						jQuery('#btn_submit').html('Update');
						jQuery('#btn_submit').attr('disabled',false);
					}
				})
			}
		}
		function update_password(){
			jQuery('.field_error').html('');
			var current_password=jQuery('#current_password').val();
			var new_password=jQuery('#new_password').val();
			var confirm_new_password=jQuery('#confirm_new_password').val();
			var is_error='';
			if(current_password==''){
				jQuery('#current_password_error').html('Please enter password');
				is_error='yes';
			}if(new_password==''){
				jQuery('#new_password_error').html('Please enter password');
				is_error='yes';
			}if(confirm_new_password==''){
				jQuery('#confirm_new_password_error').html('Please enter password');
				is_error='yes';
			}
			
			if(new_password!='' && confirm_new_password!='' && new_password!=confirm_new_password){
				jQuery('#confirm_new_password_error').html('Please enter same password');
				is_error='yes';
			}
			
			if(is_error==''){
				jQuery('#btn_update_password').html('Please wait...');
				jQuery('#btn_update_password').attr('disabled',true);
				jQuery.ajax({
					url:'update_password.php',
					type:'post',
					data:'current_password='+current_password+'&new_password='+new_password,
					success:function(result){
						jQuery('#current_password_error').html(result);
						jQuery('#btn_update_password').html('Update');
						jQuery('#btn_update_password').attr('disabled',false);
						jQuery('#frmPassword')[0].reset();
					}
				})
			}
			
		}
		</script>
<?php
require_once("footer.php");
?>