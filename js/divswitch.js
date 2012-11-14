$(function() // run after page loads
{
  $("#toggle").click(function()
  { 
    // hides matched elements if shown, shows if hidden
    $("#pc1, #pc2").toggle();
  });
});
