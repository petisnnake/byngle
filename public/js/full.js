$(function() {
	var intro_time = 3000;
	var iq = 123; //parseInt($('#score').html());
	var counter = 10;
	$('#score').html('10');
	var w = ((iq - 60) * 7.8) + 58;
	$('#bg').animate({width: w + "px"}, intro_time, function() {});
	
	var delay = Math.floor(intro_time / iq);
	
	var t = setInterval(function() {
		if(counter >= iq)
		{
			clearTimeout(t);
		}
		else
		{
			counter++;
			$('#score').html(counter);
		}
	}, delay);
});