$(function()
{
	function go() 
	{
		count = 5;
		interval = setInterval(function()
		{
			$('#foo').html(count);
			count--;
			if(count == -1) clearInterval(interval);
		}, 1000);		
	}
	
	
});