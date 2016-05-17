/* jshint browser: true */
/*global Debugger, CanvasHelper, FPS*/

var Hartmeter = (function() {

	function Hartmeter() {
	
	}
	
	Hartmeter.prototype.update = function(canvas, valueMin, valueMax, nightmode) {
	
		this.canvas = canvas;
		this.context = canvas.context;
		this.valueMin = valueMin;
		this.valueMax = valueMax;
		this.nightmode = nightmode;
	
	};
	
	Hartmeter.prototype.draw = function() {

		drawBar(this.context);
		drawStatus(this.context,this.valueMin,this.valueMax);
		
		if(this.valueMin >= 30){
			drawStart(this.context,this.valueMin,this.valueMax);
		}
		
		if(this.valueMax <= 260){
			drawStop(this.context,this.valueMax);
		}
			
	};
	
	function drawBar(context) {

		context.beginPath();
		context.moveTo(40, 60);
		context.lineTo(260, 60);
		context.strokeStyle = "#D2D2D2";
		context.lineWidth = 8;
		context.lineCap = "round";
		context.stroke();
		
	}
			
	function drawStatus(context,valueMin,valueMax) {

		context.beginPath();
		context.moveTo(valueMin, 60);
		context.lineTo(valueMax, 60);
		context.strokeStyle = "#7BCAE9";
		if(valueMin <= 30 || valueMax >= 260) {
			context.strokeStyle = "#FF3068";
		}
		context.lineWidth = 8;
		context.lineCap = "round";
		context.stroke();
		
	}
	
	function drawStart(context,valueMin,valueMax) {
	
		context.beginPath();
		context.ellipse(valueMin, 60, 8, 8, 45 * Math.PI/180, 0, 2 * Math.PI);
		context.fillStyle = "#7BCAE9";
		if(valueMax >= 260){
			context.fillStyle = "#FF3068";
		}
		context.fill();
		context.font = '100 18px avenir';
		context.fillStyle = '#7BCAE9';
		context.textBaseline = 'top';
		context.fillText  (valueMin, valueMin - 10, 20);
		
	}
	
	function drawStop(context,valueMax,valueMin) {
	
		context.beginPath();
		context.ellipse(valueMax, 60, 8, 8, 45 * Math.PI/180, 0, 2 * Math.PI);
		context.fillStyle = "#7BCAE9";
		if(valueMin <= 30){
			context.fillStyle = "#FF3068";
		}
		context.fill();
		context.font = '100 18px avenir';
		context.fillStyle = '#7BCAE9';
		context.textBaseline = 'top';
		context.fillText  (valueMax, valueMax - 14, 20);
		
	}
	
	return Hartmeter;
	
})();



	
	
		
			