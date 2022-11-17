<?php
require_once("top.php");
?>
<style>
<?php include 'login.css'; ?>
</style>
<div class="containerx">
      <div class="leftx">
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
      </div>  
      <div class="rightx">
      <div class="login-boxx">
      <h1>Login</h1>
      <form id="login-form" method="post">
        <label>Email</label>
        <input type="email" placeholder="" name="login_email" id="login_email"/>
        <span class="field_error" id="login_email_error"></span>
        <label>Password</label>
        <input type="password" placeholder="" name="login_password" id="login_password"/>
        <span class="field_error" id="login_password_error"></span>
        <button type="button" value="Submit" class="btn btn-primary cool" onclick="user_login()">Login</button>
        <div class="login_msg"><p class="field_error"></p></div>
        <!-- <a href="forgot_password.php">Forgot password?</a> -->
      </form>
    </div> 
      </div>
      </div>
<?php
require_once("footer.php");
?>