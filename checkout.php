<?php
require_once('top.php');
if(!isset($_SESSION['cart'])||count($_SESSION['cart'])==0){
    ?>
    <script>
        window.location.href='index.php';
    </script>
    <?php    
}
$cart_total=0; 
$errMsg="";
if(isset($_POST['submit'])){
  $address = $_POST['address'];
  $pincode = $_POST['pincode'];
  $payment_type = $_POST['payment_type'];
  $city = $_POST['city'];
  $user_id = $_SESSION['USER_ID'];
  foreach($_SESSION['cart'] as $key=>$val){
		$productArr=get_product($con,'','',$key);
		$price=$productArr[0]['price'];
		$qty=$val['qty'];
		$cart_total=$cart_total+($price*$qty);
		
	}
  $total_price = $cart_total;
  $payment_status = 'pending';
  if($payment_type=='COD'){
  $payment_status = 'success';
  }
  $order_status='1';
  $added_on=date('Y-m-d h:i:s');
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
  mysqli_query($con,"insert into `order`(user_id,
  address,
  pincode,
  payment_type,
  total_price,
  added_on,
  payment_status,
  order_status,
  city,txnid)values('$user_id',
  '$address',
  '$pincode',
  '$payment_type',
  '$total_price',
  '$added_on',
  '$payment_status',
  '$order_status',
  '$city','$txnid')");
  $order_id=mysqli_insert_id($con);
foreach ($_SESSION['cart'] as $key => $val) {
  $productArr = get_product($con,'','',$key);
    $price=$productArr[0]['price'];
    $qty=$val['qty'];
    
    mysqli_query($con,"insert into order_detail(order_id,product_id,price,qty)values('$order_id','$key','$price','$qty')");
    
  }
  // unset($_SESSION['cart']);
  if($payment_type=='instamojo'){
		
		$userArr=mysqli_fetch_assoc(mysqli_query($con,"select * from users where id='$user_id'"));
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($ch, CURLOPT_HTTPHEADER,
			array("X-Api-Key:test_e8da2fc9d217773c6d82353bdaa","X-Auth-Token:test_58ba91e708cddd20eeb6830ae23")
		);
		
		$payload = Array(
			'purpose' => 'Buy Product',
			'amount' => $total_price,
			'phone' => $userArr['mobile'],
			'buyer_name' => $userArr['name'],
			'redirect_url' => 'http://localhost/Project/payment_complete.php',
			'send_email' => false,
			'send_sms' => false,
			'email' => $userArr['email'],
			'allow_repeated_payments' => false
		);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
		$response = curl_exec($ch);
		curl_close($ch); 
		$response=json_decode($response);
		if(isset($response->payment_request->id)){
			//unset($_SESSION['cart']);
			$_SESSION['TID']=$response->payment_request->id;
			mysqli_query($con,"update `order` set txnid='".$response->payment_request->id."' where id='".$order_id."'");
			?>
			<script>
			window.location.href='<?php echo $response->payment_request->longurl?>';
			</script>
			<?php
		}else{
			if(isset($response->message)){
				$errMsg.="<div class='instamojo_error'>";
				foreach($response->message as $key=>$val){
					$errMsg.=strtoupper($key).' : '.$val[0].'<br/>';				
				}
				$errMsg.="</div>";
			}else{
				echo "Something went wrong";
			}
		}
	}else{	
		//sentInvoice($con,$order_id);
		?>
		<script>
			window.location.href='thank_you.php';
		</script>
		<?php
	}

  
  
}

?>
<style>
<?php include 'login.css'; ?>
</style>
<style>
<?php include 'cart.css'; ?>
</style>
<div class="ultra" style="display:flex;">
<?php
               if(isset($_SESSION['USER_LOGIN'])){
                  ?>
<div class="containerx" style="padding:10px;margin:0px;width:70%;">
    <div class="leftx">
      <div class="signup-boxx"  style="height:400px;" >
          <h1>Address Information</h1>
          <form method="post">
          <div id="address-form">
            <label>Address</label>
            <input type="text" placeholder="Enter address" name="address" id="address" required/>
            <!-- <span class="field_error" id="address_error"></span> -->
            <label>City</label>
            <input type="text" placeholder="Enter city" name="city" id="city" required/>
            
            <label>Pincode</label>
            <input type="text" placeholder="Enter pincode" name="pincode" id="pincode" required/>
            <!-- <span class="field_error" id="pincode_error"></span> -->
          </div>          
        </div>
        <div >Payment Information</div>
      <div class="paymentinfo">
        <div class="single-method">
            COD <input type="radio" name="payment_type" value="COD" required/>
        </div>
        <div class="single-method">
            Instamojo <input type="radio" name="payment_type" value="instamojo" required/>
        </div>
        <div class="single-method">
            <input type="submit" class="btn btn-secondary" name="submit">
        </div>
        <?php echo $errMsg?>
        </form>
      </div>
      </div>  
      </div>                  <?php
               }else{
                  ?>
<div class="containerx" style="padding:10px;margin:0px;width:70%">
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
      </form>
    </div> 
      </div>
      </div>

                  <?php
               }
            ?>
      
<div class="table-wrapper" style="width:30%">
    <table class="fl-table">
        <thead>
        <tr>
            <th>PRODUCTS</th>
            <th>NAME OF PRODUCTS</th>
            <!-- <th>PRICE</th>
            <th>QUANTITY</th>
            <th>TOTAL</th> -->
            <th>REMOVE</th>
        </tr>
        </thead>
        <tbody>

            <?php
            $cart_total=0;
            foreach($_SESSION['cart'] as $key=>$val){
            $productArr=get_product($con,'','',$key);
            $pname=$productArr[0]['name'];
            $mrp=$productArr[0]['mrp'];
            $price=$productArr[0]['price'];
            $image=$productArr[0]['image'];
            $qty=$val['qty'];
            $cart_total=$cart_total+($price*$qty);
            ?>

        <tr>
            <td><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$image?>" alt=""></td>
            <td><div><?php echo $pname ?></div>
            <span>₹<?php echo $qty*$price ?></span>
                <!-- <span><del>₹<?php echo $mrp ?></del></span> -->
                <!-- <span><ins>₹<?php echo $price ?></ins></span></td> -->
            <!-- <td><?php echo $price ?></td> -->

            <!-- <td>₹<?php echo $price ?></td> -->
            <!-- <td><div id="incdec">
                <i class="fa-solid fa-up-long" id="<?php echo $key ?>up"></i>
    <input type="text" style="text-align:center;" value="<?php echo $qty ?>" id="<?php echo $key ?>qty"/>
    <i class="fa-solid fa-down-long" id="<?php echo $key ?>down"></i> -->
<!-- </div><div><a href="javascript:void(0)" onclick="manage_cart('<?php echo $key ?>','update')">Update</a></div></td> -->

            
            <td><a href="javascript:void(0)" onclick="manage_cart('<?php echo $key ?>','remove')"><i class="fa-solid fa-trash"></i></a></td>
        </tr>
        <?php } ?>
</tbody>
    </table>
    <!-- <a href="checkout.php"><button type="button" class="btn btn-secondary" style="border:1px solid black">Checkout</button></a>
    <a href="index.php"><button type="button" class="btn btn-secondary" >Continue Shopping</button></a> -->
    <div class="" style="text-align:center;font-weight:700;">Order Total:&nbsp;₹<?php echo $cart_total ?></div>
</div>
</div>
<?php
require_once('footer.php');
?>