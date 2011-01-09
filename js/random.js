

$(document).ready(function(){
   $("#random").each(function() {
     var numRandy = Math.floor(Math.random()*300);
var numRandx = Math.floor(Math.random()*850);
     $(this).css({'margin-left': numRandx});
$(this).css({'margin-top': numRandy});
});
});

