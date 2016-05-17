/* jshint browser: true */
/*global Debugger, CanvasHelper, FPS*/

var Grafiek = (function() {

	function Grafiek() {
	
	}
	
	Grafiek.prototype.update = function(canvas, type, valDag1, valDag2, valDag3, valDag4, valDag5, valDag6, valDag7) {
		this.canvas = canvas;
		this.context = canvas.context;
		this.type = type;
		this.valDag1 = valDag1;
		this.valDag2 = valDag2;
		this.valDag3 = valDag3;
		this.valDag4 = valDag4;
		this.valDag5 = valDag5;
		this.valDag6 = valDag6;
		this.valDag7 = valDag7;
	
	};
	
	Grafiek.prototype.draw = function() {

		drawAxis (this.canvas,this.context, this.width, this.height);

	};
	
	function drawAxis(canvas,context, width, height) {
		
		context.save();
		context.beginPath();
		context.moveTo(10,200);
		context.lineTo(width - 10, 200);
		context.strokeStyle = "#D2D2D2";
		context.lineWidth = 8;
		context.lineCap = "round";
		context.stroke();
		
	}

	return Grafiek;
	
})();



	
	
		
			