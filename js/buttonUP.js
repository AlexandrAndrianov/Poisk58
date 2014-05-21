


var displ = window.innerHeight;
displ = displ - 50;

var btn = document.getElementById('btnUp');
btn.style.top = displ + 'px';
btn.addEventListener('click', up, false);

function up()
{
	var pixel = 50;
	var cutoff = 100;
	var speed = 15;

	
	var scrollCur = window.pageYOffset 
					|| document.documentElement.scrollTop 
					|| document.body.scrollTop;
					
	var animate = setInterval(
		function()
		{	
			scrollCur = scrollCur - pixel;
			window.scrollBy(0, -pixel);
			if(scrollCur < 0) clearInterval(animate);
			//if(scrollCur < cutoff) pixel = 4;
		}, speed);
}


window.addEventListener('scroll',btnUp,false);
function btnUp()
{
	var cutoffbtn = 280;
	var scrollCur = window.pageYOffset 
					|| document.documentElement.scrollTop 
					|| document.body.scrollTop;
	
	var scrollDown = document.documentElement.scrollHeight -
		scrollCur -
		document.documentElement.clientHeight;
	
	if( scrollCur > cutoffbtn) btn.style.visibility = 'visible';
	if( scrollCur < cutoffbtn) btn.style.visibility = 'hidden';
	//console.log(scrollCur);
}