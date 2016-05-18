/* jshint browser: true */
/*global Debugger, CanvasHelper, FPS*/

var Statusbar = (function() {

	function Statusbar() {
	
	}
	
	Statusbar.prototype.update = function(canvas, width, height, value, foto, nightmode) {
	
		this.canvas = canvas;
		this.context = canvas.context;
		this.width = width;
		this.height = height;
		this.value = value;
		this.foto = foto;
		this.nightmode = nightmode;
	
	};
	
	Statusbar.prototype.draw = function() {

		cropImage(this.context, this.width, this.height);
		drawCircle(this.context);
		drawStatus(this.context,this.value, this.width, this.height);

	};
	
	function cropImage(context, width, height) {
		context.save();
		context.beginPath();
		context.arc(width/2, height/2, 2 * width/6, 0, Math.PI*2, true);   
		context.closePath();
		context.clip();
		context.drawImage(this.foto,0,(height/6),width,1.3 * height/2);
		context.beginPath();
		context.arc(width/2, height/2, 2 * width/6 + 10, 0, Math.PI*2, true);
		context.clip();
		context.closePath();
		context.restore();
	}
			
	function drawCircle(context) {
		
		context.strokeStyle = "#D2D2D2";
		context.lineWidth=4;
		context.stroke();

	}

	 function drawStatus(context, value, width, height){
				
		context.beginPath();
		context.strokeStyle= "#6EBFE5";
		context.lineWidth = 6;
		context.lineCap="round";
		context.ellipse(width/2, height/2,  2 * width/6 + 10,  2 * width/6 + 10, 3 * (Math.PI / 2), 0, value * Math.PI);
		context.stroke();
	
	}
	return Statusbar;
	
})();



	
	
		
			