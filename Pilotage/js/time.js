function stripGetParams( url )
{
	if( typeof url == "undefined" ) var url = document.location.href;
	
	url = url.substring( 0, ( url.indexOf("?") == -1 ) ? url.length : url.indexOf("?") );
	
	return url;
}

function padLength( nb ) { // Duplicate
	return padZeroes( nb, 2 )
}

function padZeroes( number, maxlength )
{
	var output = number.toString();
	while( output.length < maxlength )
	{
		output = '0' + output;
	}
	
	return output;
}

function displayServerTime() { // Show & update the time
	sdate.setSeconds(sdate.getSeconds()+1);
	//var datestr = montharray[sdate.getMonth()]+" "+padLength(serverdate.getDate())+", "+sdate.getFullYear()
	var timestr = padLength(sdate.getHours())+":"+padLength(sdate.getMinutes())+":"+padLength(sdate.getSeconds());
	
	document.getElementById("serverTime").innerHTML = timestr;
}

function mkCountdownText( seconds )
{
	if( seconds < 0 )
		seconds = 0;
	
	var days = Math.floor(seconds / (60*60*24));
	seconds = seconds % (60*60*24);
	
	var hours = Math.floor(seconds / (60*60));
	seconds = seconds % (60*60);
	
	var minutes = Math.floor(seconds / (60));
	seconds = seconds % (60);
	
	var output = '';
	
	if( days > 0 )
	{
		output = output + days.toString() + ' jour'
		if( days > 1 )
			output = output + 's';
		
		output = output + ' ';
	}
	
	output = output + padZeroes( hours, 2 ) + ':' + padZeroes( minutes, 2 ) + ':' + padZeroes( seconds, 2 );
	
	return output;
}

function createCountdown( objectid, seconds )
{
	if( !window.countdowns )
	{ /* Create new global countdowns variable if there is none */
		window.countdowns = new Object;
	}
	
	var text = mkCountdownText( seconds );
	var exp = 'updateCountdown(\'' + objectid + '\');';
	
	document.getElementById(objectid).innerHTML = text;
	
	countdowns[objectid] = new Object;
	countdowns[objectid]['left'] = seconds;
	countdowns[objectid]['interval'] = setInterval(exp, 1000);
}

function updateCountdown( objectid )
{
	countdowns[objectid]['left'] = countdowns[objectid]['left'] - 1;
	
	var text = mkCountdownText( countdowns[objectid]['left'] );
	
	document.getElementById(objectid).innerHTML = text;
	if( countdowns[objectid]['left'] <= 0 )
	{
		clearInterval(countdowns[objectid]['interval']);
		
		if( typeof window.endRedirect == "undefined" ) window.endRedirect = 0;
		if( typeof window.stripGetRedirect == "undefined" ) window.stripGetRedirect = 0;
		if( typeof window.appendRedirect == "undefined" ) window.setGetRedirect = null;
		
		if( window.stripGetRedirect )
		{
			var endUrl = stripGetParams(window.location.href);
		} else {
			var endUrl = window.location.href;
		}
		
		if( window.appendRedirect != null )
		{
			endUrl = endUrl + window.appendRedirect;
		}
		
		
		if( window.endRedirect )
		{
			window.location = endUrl;
			return false;
		}
		else
		{
			var a = document.createElement('a'); //window.location = window.location.href;
			a.href = '#';
			a.innerHTML = 'Terminé';
			a.onclick = function () { window.location = endUrl; return false; };
			
			document.getElementById(objectid).innerHTML = '';
			document.getElementById(objectid).appendChild(a);
		}

	}
}