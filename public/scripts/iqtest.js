$(function()
{
	const NR_QUESTIONS = 44;
	var page = 1;
	var answers = Array(NR_QUESTIONS);
	var questions = Array(NR_QUESTIONS);
	for(i = 0; i < NR_QUESTIONS; i++)
	{
		questions[i] = new Array(8);
	}
	
	function writeTest(newPage)
	{
		letters = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];
		$('#questions').append('<img src="/public/img/iqtest/diff' + newPage + '/q.png"><br>');
		$('#questions').append('<table><tr></tr><tr></tr></table>');
		for(i = 1; i < 5; i++)
		{		
			$('#questions tr').eq(0).append('<td><span class="letter">' + letters[i - 1] + '</span><img src="/public/img/iqtest/diff' + newPage + '/a' + questions[newPage - 1][i - 1] + '.png"></td>');
		}
		for(i = 5; i < 9; i++)
		{		
			$('#questions tr').eq(1).append('<td><span class="letter">' + letters[i - 1] + '</span><img src="/public/img/iqtest/diff' + newPage + '/a' + questions[newPage - 1][i - 1] + '.png"></td>');
		}
	}
	
	/** order = order of questions the script generated, answer = the nr of answer the user chose; **/
	function changePage(newPage, answer)
	{
		$('#testnav > div').removeClass('selected_nr');
		$('#testnav > div').eq(newPage - 1).addClass('selected_nr');
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
	
	$('#startsubmit').click(function() {

		$('#foo').html(1);
		
		$('#infodiv').slideUp('fast');
		$('#maincontent').append('<div id="test"><div id="testnav"></div><div id="content"><p id="foo">status</p><div id="questions"></div></div></div>');
		for(i = 1; i < NR_QUESTIONS; i++)
		{
			$('#testnav').append('<div>' + i + '</div>');
		}
		
		$('#testnav > div').eq(0).addClass("selected_nr");

		$('#testnav > div').click(function() {
			if($(this).html() != page)
			{
				changePage($(this).html(), 0);
			}
		});
		
	});
});