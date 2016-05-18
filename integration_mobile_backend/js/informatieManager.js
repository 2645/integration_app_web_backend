/* jshint browser: true */
/* global Debugger, CanvasHelper, Statusbar, FPS, Hartmeter, Grafiek*/

window.addEventListener("load", init);

//var canvas1,canvas2,canvas3,fps,temp1,temp2,temp3,canvas4,canvas5,canvas6;
var i = 0;
var j = 0;

var statusbars = [];
var hartmeters = [];


var foto = new Image();

var fps = new FPS(60);
	

var chartCanvas;


var chart;

var myElem;


foto.src = 'uploads/bigmike';


function init() {
	
	  if(!CanvasHelper.canvasSupport()) {
        Debugger.log("Geen canvas-ondersteuning!");		
        return false;
		
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

	myElem = document.getElementById('canvasPersoon');
	if (myElem === null) {}
	else {
		myElem = new CanvasHelper('canvasPersoon');
		myElem.scaleOnHiDPI();
		drawStatusBar(1.3, myElem, 200, 200);
	}
	
	window.requestAnimFrame(render);
	chartCanvas = new CanvasHelper('myChart');
	chartCanvas.scaleOnHiDPI();

	
	
	window.addEventListener('resize', resizeCanvas, false);
	
	resizeCanvas();
}

function redraw() {
				drawChart();
			}

function resizeCanvas() {
				var scaler = document.getElementById('scaler');
				chartCanvas.width = scaler.clientWidth - 50;
				redraw();
			}

function drawStatusBar(value, canvas, width, heigth){
				
	var statusbar = new Statusbar();
	statusbar.update(canvas,width,heigth,value,foto,1);
	statusbar.draw();	
}

function drawChart() {
	
	chart = new Grafiek();
	chart.update(chartCanvas, "gewicht", "maandag", 70, "dinsdag", 65, "woensdag", 72, "donderdag", 64, "vrijdag", 68, "zaterdag", 65, "zondag", 70);
	chart.draw();
	
}

function drawHartmeter(canvas,valueMin,valueMax){
			
	var hartmeter = new Hartmeter();
	hartmeter.update(canvas,valueMin,valueMax,1);
	hartmeter.draw();	
}

function render() {
	if (fps.update()) {	

	}
	 window.requestAnimFrame(render);
	
	for (var k = 0; k < hartmeters.length; k++) {
			
		drawStatusBar(90,statusbars[k],110,110);
		drawHartmeter(hartmeters[k],90,220);
	}
	
}

/*function animateBars(value1, value2, value3){
	
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
*/
