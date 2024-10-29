//var d = new Date("2015-05-14T14:15:00Z");

function refreshTime(){
	var tempsCourant = document.getElementById("temps-actuel");
	var d = new Date();
	tempsCourant.innerHTML = d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds();
}

refreshTime();
setInterval(refreshTime,1000);