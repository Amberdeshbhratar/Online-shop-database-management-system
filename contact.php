<?php
require_once("top.php");
?>
<style>
<?php include 'contact.css'; ?>
</style>

	<div class="container">
		<div class="contact-box">
			<div class="left"></div>
			<div class="right">
				<h2>Contact Us</h2>
                <form action="post">
				<input type="text" class="field" name="name" id="name" placeholder="Your Name">
				<input type="email" class="field" name="email" id="email" placeholder="Your Email">
				<input type="text" class="field" name="mobile" id="mobile" placeholder="Phone">
				<textarea placeholder="Message" name="comment" id="comment" class="field"></textarea>
				<button class="btn" type="button" onclick="send_message()">Send</button>
                </form>
			</div>
		</div>
	</div>
<?php
require_once("footer.php");
?>