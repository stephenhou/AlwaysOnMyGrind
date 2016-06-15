$(document).ready(function(){

   $("#show_login").click(function(){
    showpopup();
   });
   $("#close_login").click(function(){
    hidepopup();
   });

   $("#show_trainerlogin").click(function(){
    trainershowpopup();
   });
   $("#close_trainerlogin").click(function(){
    trainerhidepopup();
   });

});


function showpopup()
{
   $("#loginform").fadeIn();
   $("#loginform").css({"visibility":"visible","display":"block"});
}

function hidepopup()
{
   $("#loginform").fadeOut();
   $("#loginform").css({"visibility":"hidden","display":"none"});
}

function trainershowpopup()
{
   $("#trainerform").fadeIn();
   $("#trainerform").css({"visibility":"visible","display":"block"});
}

function trainerhidepopup()
{
   $("#trainerform").fadeOut();
   $("#trainerform").css({"visibility":"hidden","display":"none"});
}