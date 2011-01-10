$(document).ready(function(){
bgImageTotal=9;
randomNumber = Math.round(Math.random()*(bgImageTotal-1))+1;

// Initialize Backgound Stretcher
$(document).bgStretcher({
images: ['./images/bg/'+randomNumber+'.jpg'],
imageWidth: 1024,
imageHeight: 768,
slideShow: false
});

});