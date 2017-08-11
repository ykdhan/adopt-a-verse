// Countdown Timer
function getTimeRemaining(endtime) {
	var t = Date.parse(endtime) - Date.parse(new Date());
	var seconds = Math.floor( (t/1000) % 60);
	var minutes = Math.floor( (t/1000/60) % 60);
	var hours = Math.floor( (t/(1000*60*60)) %24);
	var days = Math.floor( t/(1000*60*60*24) );
	return {
		'total': t,
		'days': days,
		'hours': hours,
		'minutes': minutes,
		'seconds': seconds
	}
}
function updateClock(endtime) {
	var t = getTimeRemaining(endtime);
	var hours = ('0' + t.hours).slice(-2);
	var minutes = ('0' + t.minutes).slice(-2);
	var seconds = ('0' + t.seconds).slice(-2);
    $('.countdown-days').html(t.days);
    $('.countdown-hours').html(hours);
    $('.countdown-minutes').html(minutes);
    $('.countdown-seconds').html(seconds);
	if(t.total <= 0) {
		clearInterval(timeinterval);
	}
}
var timeinterval;
function countdownDate(deadline) {
	updateClock(deadline);
	timeinterval = setInterval(function() {
		updateClock(deadline)
	}, 1000);
}
