$(document).ready(function() {
  
  //bg stretcher
  bgImageTotal=21;
  randomNumber = Math.round(Math.random()*(bgImageTotal-1))+1;

  // Initialize Backgound Stretcher
  $(document).bgStretcher({
    images: ['/images/bg/'+randomNumber+'.jpg'],
    imageWidth: 1024,
    imageHeight: 683,
    slideShow: false
  });
  
  //menu
  $('#menu-main li').hover(
		function () {
			//show its submenu
			$('ul', this).slideDown(100);
		}, 
		function () {
			//hide its submenu
			$('ul', this).slideUp(100);			
		}
	);
	
	$('#menu-main li ul li').hover(
		function () {
			//show its submenu
			$('ul', this).slideDown(100);
		}, 
		function () {
			//hide its submenu
			$('ul', this).slideUp(100);			
		}
	);
	
	//random enter button
	$("#random").each(function() {
    var numRandy = Math.floor(Math.random()*300);
    var numRandx = Math.floor(Math.random()*850);
    $(this).css({'margin-left': numRandx});
    $(this).css({'margin-top': numRandy});
  });
  
  //postcard click switch
  $("#toggle").click(function() { 
    $("#pc1, #pc2").toggle();
  });
  
  //twitter widget
  // setTimeout(twitterHeight, 1500);
  
});

function twitterHeight(){
  var tw = $('.twtr-tweet-text').height();
  var tw = (tw + 10) + 'px';
  $('.twtr-timeline').css('height', tw);
};
