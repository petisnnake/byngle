$(function() {
	//default: minutes=(time for test - 1), seconds=60
	var minutes = 41;
	var seconds = 60;
	
	t = setInterval(function() {
		if(seconds > 0)
		{
			seconds--;
		}
		else if(minutes > 0)
		{
			minutes--;
			seconds = 59;
		}
		else
		{
			clearInterval(t);
			
			//THE HANDLER OF THE TIMER
			$('#finish').trigger('click');
		}
		
		var sec = (seconds < 10) ? ('0' + seconds) : (seconds); 
		$('#timer').html(minutes + ":" + sec);
	}, 1000)
});