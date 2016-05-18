/* jshint browser: true */
/*global Debugger, CanvasHelper, FPS*/

var Grafiek = (function() {

	function Grafiek() {
	
	}
	
	Grafiek.prototype.update = function(canvas, type, dag1, valDag1, dag2, valDag2, dag3, valDag3, dag4, valDag4, dag5, valDag5, dag6, valDag6, dag7, valDag7) {
		this.canvas = canvas;
		this.context = canvas.context;
		this.width = this.canvas.width;
		this.height = this.canvas.height;
		this.type = type;
		this.valDag1 = valDag1;
		this.valDag2 = valDag2;
		this.valDag3 = valDag3;
		this.valDag4 = valDag4;
		this.valDag5 = valDag5;
		this.valDag6 = valDag6;
		this.valDag7 = valDag7;
		this.dag1 = dag1;
		this.dag2 = dag2;
		this.dag3 = dag3;
		this.dag4 = dag4;
		this.dag5 = dag5;
		this.dag6 = dag6;
		this.dag7 = dag7;
	
	};
	
	Grafiek.prototype.draw = function() {
		drawAxis (this.context, this.width, this.height);
		drawValues(this.context, this.width, this.height, this.dag1, this.valDag1, this.dag2, this.valDag2, this.dag3, this.valDag3,  this.dag4, this.valDag4, this.dag5, this.valDag5, this.dag6, this.valDag6, this.dag7, this.valDag7);
	};
	
	function drawAxis(context, width, height) {
                console.log(this.context);

		context.clearRect(0,0,width + 100,height);
		context.save();
		context.beginPath();
		context.moveTo(20,height - 20);
		context.lineTo(width - 20, height - 20);
		context.strokeStyle = "#D2D2D2";
		context.lineWidth = 2;
		context.lineCap = "round";
		context.stroke();
		context.beginPath();
		context.moveTo(20,height - 20);
		context.lineTo(20, 20);
		context.stroke();
		context.restore();
	}
	
	function drawValues(context, width, height, dag1, val1, dag2, val2, dag3, val3, dag4, val4, dag5, val5, dag6, val6, dag7, val7) {
		
		var posY1 = height - ((val1/100) * 180);
		var posY2 = height - ((val2/100) * 180);
		var posY3 = height - ((val3/100) * 180); 
		var posY4 = height - ((val4/100) * 180);
		var posY5 = height - ((val5/100) * 180); 
		var posY6 = height - ((val6/100) * 180);
		var posY7 = height - ((val7/100) * 180); 
		
		var dag = [dag1 ,dag2 ,dag3 ,dag4 ,dag5 ,dag6 ,dag7];
		
		var posArray = [posY1, posY2, posY3, posY4, posY5, posY6, posY7];
		
		width = width - 40;
		var interval = width/6;
		
		//gradient
		
		var grd = context.createLinearGradient(0,0,0,190);
		grd.addColorStop(0,"#7BCAE9");
		grd.addColorStop(1,"rgba(255,255,255,0)");		
		
		context.save();
		context.beginPath();
		context.moveTo(20, posY1);
		context.lineTo(interval, posY2);
		context.lineTo(2 * interval, posY3);
		context.lineTo(3 * interval, posY4);
		context.lineTo(4 * interval, posY5);
		context.lineTo(5 * interval, posY6);
		context.lineTo(6 * interval + 2, posY7);
		context.lineTo(6 * interval + 2, height - 20);
		context.lineTo(20, height - 20);
		context.closePath();
		context.fillStyle = grd;
		context.fill();
		context.restore();		
		
		//line
		
		context.save();
		context.beginPath();
		context.moveTo(23, posY1);
		context.lineTo(interval, posY2);
		context.lineTo(2 * interval, posY3);
		context.lineTo(3 * interval, posY4);
		context.lineTo(4 * interval, posY5);
		context.lineTo(5 * interval, posY6);
		context.lineTo(6 * interval, posY7);
		context.lineCap = "round";
		context.strokeStyle = "#7BCAE9";
		context.lineWidth = 5;
		context.stroke();
		context.restore();
		
		//val
		
		for(var i = 1; i <= 5; i++) {
			context.beginPath();
			context.lineWidth = 10;
			context.strokeStyle = "#7BCAE9";
			context.ellipse(i * interval, posArray[i], 3, 3, 45 * Math.PI/180, 0, 2 * Math.PI);
			context.stroke();
			context.fillStyle = "#FFF";
			context.fill();
		}
		
		context.fillStyle = "#B3B3B3";
		context.font = '12px avenir';
		context.textBaseline = 'top';
		context.fillText  (dag[0], 20, 185);
		
		for(var j = 1; j <= 6; j++) {
			
			context.fillStyle = "#B3B3B3";
			context.font = '12px avenir';
			context.textBaseline = 'top';
			context.fillText  (dag[j], j * interval, 185);
			
		}
		
	}


	return Grafiek;
	
})();



	
	
		
			