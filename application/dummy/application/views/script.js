let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");

sidebarBtn.onclick = function(){
	sidebar.classList.toggle("active");
}
let btn = document.querySelector(".btn");

var timer,hour,minute,second,my_int;
var getHour = 0;
var getMinute = 0;
var getSecond = 0;

function stopwatch(){
	this.start = function(){
		
		hour = document.getElementById('hour');
		minute = document.getElementById('minute');
		second = document.getElementById('second');
		
		if(getSecond >= 0){
			getSecond++;
			second.innerHTML = getSecond;
		}
		if(getSecond < 10){
			second.innerHTML = "0"+ getSecond;
		}
		if(getSecond >= 60){
			getSecond = 0;
			getMinute++;
			minute.innerHTML =  getMinute;
		}
		if(getSecond <10){
			minute.innerHTML = "0"+ getMinute +".";
		}
		if(getMinute>=60){
			getMinute = 0;
			getHour++;
			hour.innerHTML =  getHour;
		}
		if(getHour < 10){
			hour.innerHTML = "0"+getHour +".";
		}
		my_int = setTimeout(my_obj.start, 1000);
	}
	this.stop = function(){
		clearTimeout(my_int);
	}
	this.reset = function(){
		if(getSecond >= 0){
			getSecond = 0;
			getMinute = 0;
			getHour = 0;
			second.innerHTML = "0" +getSecond;
			minute.innerHTML = "0" +getMinute +".";
			hour.innerHTML = "0" +getHour+ ".";
			clearTimeout(my_int);
		}
	}
}
var my_obj = new stopwatch();