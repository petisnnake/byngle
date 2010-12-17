$(function()
{
	const NR_QUESTIONS = 43;
	var page = 1;
	var answers = Array(NR_QUESTIONS);
	var questions = Array(NR_QUESTIONS);
	var test_id;
	for(i = 0; i < NR_QUESTIONS; i++)
	{
		questions[i] = new Array(8);
	}
		
	changePage(1);
	
	function isDone()
	{
		var rez = true;
		for(i = 0; i < NR_QUESTIONS; i++)
		{
			if(answers[i] == null || answers[i] == undefined)
			{
				rez = false;
			}			
		}
		return rez;
	}
	
	function writeTest(newPage)
	{
		letters = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];
		$('#questions').append('<img src="/public/img/iqtest/diff' + newPage + '/q.png"><br>');
		$('#questions').append('<table><tr></tr><tr></tr></table>');
		for(i = 1; i < 5; i++)
		{		
			$('#questions tr').eq(0).append('<td><span class="letter">' + letters[i - 1] + '</span></td><td class="answerimg"><img src="/public/img/iqtest/diff' + newPage + '/a' + questions[newPage - 1][i - 1] + '.png"></td>');
		}
		for(i = 5; i < 9; i++)
		{		
			$('#questions tr').eq(1).append('<td><span class="letter">' + letters[i - 1] + '</span></td><td class="answerimg"><img src="/public/img/iqtest/diff' + newPage + '/a' + questions[newPage - 1][i - 1] + '.png"></td>');
		}
		
		$('.answerimg').click(function() {
			answers[page - 1] = $(this).prev().children().html();
			$('#testnav > .selected_nr').html(page + '<b>' + answers[page - 1] + '</b>');
			if(isDone())
			{
				$('.finishhint').html('Finished! Click \'Finish\' to calculate your IQ.');
			}				
			changePage(page + 1);	
		});	
	}
	
	/** order = order of questions the script generated, answer = the nr of answer the user chose; **/
	function changePage(newPage)
	{
		$('#testnav > div').eq(page - 1).removeClass('selected_nr').addClass('number');
		$('#testnav > div').eq(newPage - 1).addClass('selected_nr');
		$('#testnav > div').eq(newPage - 1).addClass('roundedmedium');
		$('#foo').html(newPage);
		
	/** question order has already been generated **/		
		if(questions[newPage - 1][0] != null)
		{
			$('#questions').children().remove();
			writeTest(newPage);	
		}
		
	/** question order needs to be generated **/	
		else
		{
			for(i=1; i < 9; i++)
			{
				questions[newPage - 1][i - 1] = i;
			}		
			
			questions[newPage - 1].sort(function() {return 0.5 - Math.random()})
			
			$('#questions').children().remove();
			writeTest(newPage);
		}

		page = newPage;	
	}
	
	$('#testnav > div').click(function() {
		if($(this).html() != page)
		{
			changePage(parseInt($(this).html()));
		}
	});	
		
	$('#finish').click(function()
	{
		$.ajax(
		{
		   type: "POST",
		   url: "/scripts/calculate.php",
		   data: "answers=" + answers + "&order=" + questions,
		   success: function(id)
		   {
			window.location= '/iqtest/results/' + id;
			test_id = id;
		   }
		});
	});
	
	// JS for the results page...
	$('#fullresults').click(function() {
		$('#paypal').slideDown();
		$('#fullresults').hide();
		
	});
	
});