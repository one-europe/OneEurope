
	
	<section class="contactus">
		<div class="h"><span>Say Hello</span></div>
		
		<form id="contactForm" action="<?php Site::out_url('theme') ?>/mail.php" method="post">

			<div class="container">
				<span>Want to get involved, give some feedback or found an error? No Problem! Drop us a line:</span>
			    <input id="senderName" placeholder="Name" name="senderName" required="required" type="text" />
			    <input id="senderEmail" placeholder="Email" name="senderEmail" required="required" type="email" />
			    <textarea id="message" name="message" required="required"></textarea>
			    <input id="sendMessage" type="submit" name="sendMessage" value="Send message" />
				<div class="clear"></div>
			</div>

		</form>
		
	</section>
