<?php
  require 'SignUp.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>GRIND - Optimize your Workout!</title>

  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Optional theme -->
  <link href="css/bootstrap-theme.min.css" rel="stylesheet">

  <!-- remember own stylesheet must go here, below bootstrap-->
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Cabin' rel='stylesheet' type='text/css'>
  <link href="css/stylesheet.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
    </head>
    <body>

  
      <div class="col-md-6">
        <h1 class="title">AOMG</h1>
      </div>
      <div class="col-md-6">
        <h1 class="login"><button type="button" class="btn-lg btn-danger" id="logout">Log out</button></h1>
      </div>


      <div class="col-md-12">
        <h3 class="lg-txt">We just need a little more information to get started!</h3>
      </div>

        <form id="followupForm" action="main.php" method="post">
          <div class="col-md-12">
          <div class="col-md-3"></div>
          <div class="col-md-6 spacing">
            <input type="text" class="fld" name="gender" value="" placeholder="Gender">
          </div>
          <div class="col-md-3"> </div>
          </div>

          <div class="col-md-12">
          <div class="col-md-3"> </div>
          <div class="col-md-6 spacing">
            <input type="text" class="fld" name="weight" value="" placeholder="Body weight in lbs (just the number)">
          </div>
          <div class="col-md-3"></div>
          </div>

          <div class="col-md-12">
          <div class="col-md-3"></div>
          <div class="col-md-6 spacing">
            <input type="text" class="fld" name="phone" value="" placeholder="Phone number (no dashes or parantheses)">
          </div>
          <div class="col-md-3"></div>
          </div>

          <div class="col-md-12">
          <div class="col-md-3"></div>
          <div class="col-md-6 spacing">
            <input type="text" class="fld" name="age" value="" placeholder="Age">
          </div>
          <div class="col-md-3"></div>
          </div class>

          <div class="wrapper col-md-12">
            <button type="submit" class="btn-lg btn-danger">Finish sign up!</button>
          </div>

        </form>

   
   

      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) and links to other JS files-->
      <script src="js/jquery.min.js"></script>

      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="js/bootstrap.min.js"></script>

      <!-- Login Javascipt -->
      <script src="js/logout.js"></script>
    </body>
    </html>