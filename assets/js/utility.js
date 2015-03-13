/**
 * Created by AndrewMalachel on 12/17/14.
 */

var addZero = function (numb) {
	numb = parseInt(numb);
	numb = numb<10?'0'+numb:numb.toString();
	return numb;
};

var dateFromToday = function(day) {
	day = parseInt(day);
	var daysInMilliSeconds = (1000*60*60*24)*day;
	var now = new Date().getTime();
	var returnDate = now + daysInMilliSeconds;
	var d = new Date(returnDate);
	return {
		'year'		: d.getFullYear(),
		'month'		: addZero(d.getMonth()+1),
		'date'		: addZero(d.getDate()),
		'hour'		: addZero(d.getHours()),
		'minute'	: addZero(d.getMinutes()),
		'second'	: addZero(d.getSeconds()),
		'monthWrd'	: monthWord(d.getMonth()+1)
	}
};

var monthWord = function(digit) {
	switch(digit) {
		case		1 :
			return		'Jan';
		case		2 :
			return		'Feb';
		case		3 :
			return		'Mar';
		case		4 :
			return		'Apr';
		case		5 :
			return		'May';
		case		6 :
			return		'Jun';
		case		7 :
			return		'Jul';
		case		8 :
			return		'Aug';
		case		9 :
			return		'Sep';
		case		10 :
			return		'Oct';
		case		11 :
			return		'Nov';
		case		12 :
			return		'Des';
		default :
			return;
	}
};

var todayDate = dateFromToday(0);

var hashSeed = "23456789ABCDEFGHJKLMNPQRSTUVWXY";
var hashGenerator = function(length) {
	if( ! length) length = 8;
	var i=0;
	var hash='';
	while(i++ < length) {
		var pos = Math.floor((Math.random()*hashSeed.length));
		hash += hashSeed.charAt(pos);
	}
	return hash;
};

// input type number
$(document).ready(function(){
	$('input[type=number]').keydown(function(e){
		if(
				( e.keyCode < 48 || e.keyCode > 57 )
				&& !(
					false
					|| e.keyCode == 8 // backspace
					|| e.keyCode == 9 // tabs
					|| e.keyCode == 17 // ctrl
					|| e.keyCode == 18 // alt
					|| e.keyCode == 33 // pgup
					|| e.keyCode == 34 // pgdn
					|| e.keyCode == 35 // end
					|| e.keyCode == 36 // home
					|| e.keyCode == 37 // left
					|| e.keyCode == 38 // up
					|| e.keyCode == 39 // right
					|| e.keyCode == 40 // down
					|| e.keyCode == 45 // ins
					|| e.keyCode == 46 // delete
				)
		) return false;
	});
});

