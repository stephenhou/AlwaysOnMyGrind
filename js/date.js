var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1;
var yyyy = today.getFullYear();

var weekday = new Array(7);
weekday[0]=  "Today's Workout (Sunday):";
weekday[1] = "Today's Workout (Monday):";
weekday[2] = "Today's Workout (Tuesday):";
weekday[3] = "Today's Workout (Wednesday):";
weekday[4] = "Today's Workout (Thursday):";
weekday[5] = "Today's Workout (Friday):";
weekday[6] = "Today's Workout (Saturday):";
var specDay = weekday[today.getDay()];

if(dd<10) {
	dd='0'+dd
} 

if(mm<10) {
	mm='0'+mm
} 

today = mm+'/'+dd+'/'+yyyy;

window.onload = function date() {
 //when the document is finished loading, replace everything
//between the <a ...> </a> tags with the value of splitText
	document.getElementById("todayDate").innerHTML=today;
	document.getElementById("today").innerHTML=specDay;
} 

