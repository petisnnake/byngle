<div id="maincontent" class="roundedcorners">
<?php if($just_payed == 1) echo '<p class="tip"><span class="tip info roundedmedium">Info</span><b>Payment successful!</b> We also sent you an email with all the transaction details to your address registered to PayPal.</p>'; ?>
<h1>Your I.Q. score is: <span id="score" class="roundedmedium innershadow"><?php echo $test['iq']; ?></span></h1>
<p class="tip roundedmedium"><span class="tip">Tip</span>The region with the grey background represents the percent of people who have a lower I.Q. than you.</p>
<div class="wrap">
	<div class="wrapper">
		<div id="bg"></div>
		<div id="img"><img id="curve" title="I.Q. Curve" src="/public/img/IQ_curve.png" /></div>
	</div>
	<div id="minimenu_float" class="roundedmax">
		<div id="share">
			<h2>Please Share</h2>
			<small>(your score will not be shared)</small>
			<a name="fb_share" type="box_count" share_url="<?php echo URL; ?>"></a> 
			<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" 
			        type="text/javascript">
			</script>			
			<a href="http://twitter.com/share" class="twitter-share-button" data-url="http://byngle.com" data-text="Just took an I.Q. test." data-count="vertical">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
		</div>
	</div>
</div>
<p>You got question(s) <?php $wrong = explode(',', $test['wrong']); foreach($wrong as $nr) { echo $nr + 1 . ' '; } ?> wrong.</p>
<div class="wrap">
	<div class="faq">
	<h2 class="t1">Can I view my test results at a later time if I wish?</h2>
	<p>You can alwayst come back to this page (<?php echo URL . '/iqtest/full/' . $test['id']; ?>) and view your full test results.</p>
	<h2 class="t2">Can I take the test again?</h2>
	<p>You can certainly take the test as many times as you wish but it will lose it's accuracy for obvious reasons. You also have to pay for each time you re-take the I.Q. test.</p>
	<h2 class="t3">Why can't I see the correct answers?</h2>
	<p>The correct answeres are not published, however we will show you which questions you got wrong.</p>
	</div>
	<div class="faq">
	<h2 class="t4">How accurate is the test?</h2>
	<p>More accurate than any online I.Q. test, far less accurate than any standard I.Q. test.</p>
	<h2 class="t5">How is my I.Q. calculated?</h2>
	<p>We use the standard deviation used in many tests, (including the Weschsler IQ test), deviation 15. To see more on how I.Q. is calculated, or to learn about deviations, please go <a href="http://www.iqtest.com/whatisaniqscore.html">here</a>.</p>
	<h2 class="t6">Did time of completion matter?</h2>
	<p>No. The only restriction we impose is that you complete the test under <?php echo TIME; ?> minutes.</p>
	</div>
</div>
</div> 