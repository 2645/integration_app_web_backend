/* jshint browser: true */
/* global Debugger, CanvasHelper, Statusbar, FPS, Hartmeter, Grafiek */

window.addEventListener("load", init);

//var canvas1,canvas2,canvas3,fps,temp1,temp2,temp3,canvas4,canvas5,canvas6;
var i = 0;
var j = 0;

var statusbars = [];
var hartmeters = [];
var chart;

var foto = new Image();

var start2= false;
var start3= false;

var fps = new FPS(60);
	
var temp1 = 0.0;
var temp2 = 0.0;
var temp3 = 0.0;

var chartCanvas;
			
var chartContext;


foto.src = '/img/Walter-White.jpg';


function init() {
	
	  if(!CanvasHelper.canvasSupport()) {
        Debugger.log("Geen canvas-ondersteuning!");		
        return false;
		
    }
	
	
	chartCanvas = document.getElementById('myChart');
	
	if (chartCanvas === null){
	
	} else {
	chartContext = chartCanvas.getContext('2d');	
	
	window.addEventListener('resize', resizeCanvas, false);
	
	resizeCanvas();
		
	}
	
	
	$(document).ready(function(){
		$('.statusbar').each(function() {
			
			var statusbar = new CanvasHelper(this.id);
			statusbar.scaleOnHiDPI();
			statusbars[i] = statusbar;
			i++;
		});
		$('.hartmeter').each(function() {
			
			var hartmeter = new CanvasHelper(this.id);
			hartmeter.scaleOnHiDPI();
			hartmeters[j] = hartmeter;
			j++;
		});
	});

	
	window.requestAnimFrame(render);
	
	
	setTimeout( start2ndBar, 400 );
	setTimeout( start3rdBar, 800 );
	
}

function drawStatusBar(value, canvas){
				
	var statusbar = new Statusbar();
	statusbar.update(canvas,110,110,value,foto,1);
	statusbar.draw();	
}

function drawHartmeter(canvas,valueMin,valueMax){
			
	var hartmeter = new Hartmeter();
	hartmeter.update(canvas,valueMin,valueMax,1);
	hartmeter.draw();	
}

function render() {
	if (fps.update()) {	
		animateBars(1.6, 1, 1.2);
    }
	 window.requestAnimFrame(render);
	
	for (var k = 0; k < hartmeters.length; k++) {
			
		drawStatusBar(temp1,statusbars[k]);
		drawHartmeter(hartmeters[k],90,230);
	}
}

function animateBars(value1, value2, value3){
	
	if(temp1 <= value1) {

		temp1+=0.025;
	}
	
	if(temp2 <= value2 && start2) {
			
		temp2+=0.025;
	}
	
	if(temp3 <= value3 && start3) {
		
		temp3+=0.025;
	}
}

function start2ndBar() {
	start2 = true;
}

function start3rdBar() {
	start3 = true;
}
	

function resizeCanvas() {
	chartCanvas.width = window.innerWidth - 370;
	chartCanvas.height = 210;
	redraw();
}

function redraw() {
	console.log(chartCanvas);
	chart = new Grafiek();
	chart.update(chartCanvas,"",79,50,87,87,87,98,98);
	chart.draw();
}