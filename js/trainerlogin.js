$(document).ready(function(){

   $("#show_trainerlogin").click(function(){
    showpopup();
   });
   $("#close_trainerlogin").click(function(){
    hidepopup();
   });

});


function showpopup()
{
   $("#trainerform").fadeIn();
   $("#trainerform").css({"visibility":"visible","display":"block"});
}

function hidepopup()
{
   $("#trainerform").fadeOut();
   $("#trainerform").css({"visibility":"hidden","display":"none"});
}