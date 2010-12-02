<div id="r_maincontent">
<div id="r_infodiv">
<h1 class="results">I.Q. Test results</h1>
<p class="startbutton"><a id="fullresults" class="startsubmit" href="#">Full Results</a></p>
<h2>Full results cost <?php echo PRICE; ?>$ and have the following benefits:</h2>
<div id="paypal">
	<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
	<input type="hidden" name="cmd" value="_xclick">
	<input type="hidden" name="business" value="A38G4FANGTWGQ">
	<input type="hidden" name="lc" value="US">
	<input type="hidden" name="item_name" value="Sandbox Byngle">
	<input type="hidden" name="button_subtype" value="services">
	<input type="hidden" name="no_note" value="1">
	<input type="hidden" name="no_shipping" value="1">
	<input type="hidden" name="currency_code" value="USD">
	<input type="hidden" name="return" value="<?php echo URL . '/iqtest/full/' . $id; ?>"/>
	<input type="hidden" name="amount" value="<?php echo number_format(PRICE, 2, ".", ","); ?>"/>
	<input type="hidden" name="bn" value="PP-BuyNowBF:btn_paynowCC_LG.gif:NonHosted">
	<input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
	<img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
	</form>
	<p>sdsd</p>
	<p>sdsd</p> 
</div>
<ul class="benefits">
<li>Your I.Q. score</li>
<li>See where you rank compared to other facebook users</li>
<li>Enter the leaderboards</li>
<li>See which questions you got wrong</li>
<li>Detailed explanation of your personality based on your answers</li>
</ul>
<hr></hr>
<p class="startbutton"><a class="startsubmit" href="#">Just Iq score</a></p>
<h2>Calculating your I.Q. is completely free, but you will miss out on these great options:</h2>
<ul class="benefits">
<li>Your I.Q. score will be calculated</li>
<li>You won't be apart of the leaderboards</li>
<li>You won't know which questions you got wrong</li>
<li>No analysis based on your answers</li>
</ul>
</div>
</div>