$(document).ready(function(){
	$(".box_heading").click(function () {		
			$(".box_menu").slideUp(200);
			$(this).next(".box_menu").slideDown('slow');		
	});
	screenshotPreview();
});

this.screenshotPreview = function(){	
	xOffset = 100;
	yOffset = 10;
	$("a.screenshot").hover(function(e){
		this.t = this.title;
		this.title = "";	
		var c = (this.t != "") ? "<br/>" + this.t : "";
		$("body").append("<p id='screenshot'><img src='"+ this.rel +"' alt='url preview' />"+ c +"</p>");								 
		$("#screenshot")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px")
			.fadeIn("fast");						
    },
	function(){
		this.title = this.t;	
		$("#screenshot").remove();
    });	
	$("a.screenshot").mousemove(function(e){
		$("#screenshot")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px");
	});	
    
    $('.read_more').click(function(){
        $('.demo-hide').hide();
        $('.demo-show').show();
        $(this).parent('div').slideUp('10');
        $(this).parent('div').next('div').show();
    })
    
    $('.read_less').click(function(){
        $(this).parent('div').hide();
        $(this).parent('div').prev('div').show();
    })		
};

