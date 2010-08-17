$(document).ready(function() {

// $(".bild").mousedown(function() {
// 	$("#gallery").draggable({ grid: [130, 0] });
// });
	$("#gallery").offset({ left:0});

imageMove(2);

$(window).resize(function(elem) {
	$(".active").each(function() {
		var x =$(this).attr('id');
		var y=x.split('_');
		var zahl = y[1];
		imageResize(zahl);
	});
});


$(".bild").touchwipe({
	wipeLeft: function() { 

		$(".active").each(function() {
			var x =$(this).attr('id');
			var y=x.split('_');
			var zahl = parseInt(y[1]);

			if(	$(this).next()!=0){
				
				imageMove(zahl+1);
				$('#gallery .active').next().addClass("active");
				$(this).removeClass("active");
			}
		});


	},
	wipeRight: function() { 
		$(".active").each(function() {
			var x =$(this).attr('id');
			var y=x.split('_');
			var zahl = y[1];
			if (zahl>1){
				imageMove(zahl-1);
				$('#gallery .active').prev().addClass("active");
				$(this).removeClass("active");
			}
		});
	}
});

$(".bild").click(function() {

	var x =$(this).attr('id');
	var y=x.split('_');
	var zahl = y[1];
	console.log(zahl);
	imageMove(1);
	$('#gallery .active').removeClass("active");
	$(this).addClass("active");
	console.log('bild clicked');
	

});	
});
animateTransition= function(offset) {
	$('#gallery').animate({
		left: offset
		}, 500, 'linear', null);
	}
	
	
	imageMove= function(zahl){

		var hilfe=$('#Content'/*window*/).width();
		var zahl2  = Math.round(((hilfe/2)-((zahl-0.5)*($('#gallery li img').width()))-((zahl-1)*90)-((zahl-0.5)*2)))
	$('#oben').html(zahl + ':' + zahl2);
		var ergebniss;
	//	$('#oben').html(ergebniss=Math.round(((hilfe/2)-((zahl-0.5)*300)-((zahl-1)*80)-((zahl-0.5)*2))));
		animateTransition(zahl2);


	}
	imageResize= function(zahl){

		var hilfe=$('#Content'/*window*/).width();
		var ergebniss;
		if (zahl>1){
			ergebniss=Math.round(((hilfe/2)-((zahl-0.5)*300 /*($('#gallery li img').width())*/)-((zahl-1)*90)-((zahl-0.5)*2)));// 90 und 2
			
			$("#gallery").offset({ left:ergebniss});
		}

	}