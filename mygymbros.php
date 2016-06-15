<?php
ini_set('session.save_path', '/home/w/w9g0b/public_html/trainersession');
session_start();

include 'nested_aggregation.php';
include 'delete_op.php';

if (!(isset($_SESSION['pid']) && $_SESSION['pid'] != '')) {
    header ("Location: index.php");
}

$pid = $_SESSION['pid'];
$prg = $_SESSION['prg'];
$show = $_SESSION['show'];

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

  	<div class="col-md-4">
  		<h1 class="title">AOMG</h1>
  	</div>
  	<div class="col-md-4">
  		<h1 class="title" id="todayDate">
  	</div>
  	<div class="col-md-4">
  		<h1 class="login"><a type="button" class="btn-lg btn-danger" href="trainerlogout.php">Log Out</a></h1>
  	</div>
  	<div class="col-md-12">
  		<nav class="navbar navbar-inverse">
  			<div class="container-fluid">
  				<!-- Brand and toggle get grouped for better mobile display -->
  				<div class="navbar-header">
  					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
  						<span class="sr-only">Toggle navigation</span>
  						<span class="icon-bar"></span>
  						<span class="icon-bar"></span>
  						<span class="icon-bar"></span>
  					</button>
  					<a class="navbar-brand" href="trainermain.php">AOMG</a>
  				</div>

  				<!-- Collect the nav links, forms, and other content for toggling -->
  				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
  					<ul class="nav navbar-nav">
  						<li class="active"><a href="mytrainees.php">My Trainees<span class="sr-only">(current)</span></a></li>
  						<li><a href="mytrainerworkouts.php">My Workouts</a></li>
  						<li class="active"><a href="mytrainerappointments.php">My Appointments</a></li>
  					</ul>
  					<ul class="nav navbar-nav navbar-right">
  						<li class="active"><a href="aboutus.php">About Us</a></li>
  					</ul>
  				</div><!-- /.navbar-collapse -->
  			</div><!-- /.container-fluid -->
  		</nav>
  	</div>

    <div class="col-md-6">
        <h3 class="lg-txt">Cool Gym Bro Stats! (Selected by Body Weight Class)</h3>
        <form class="wrapper spacing" method="post">
            <select type="text" name="exercise">
              <option value="Dumbbell press">Dumbbell press</option>
              <option value="Incline Dumbbell press">Incline Dumbbell press</option>
              <option value="Decline Dumbbell press">Decline Dumbbell press</option>
              <option value="Incline Bench presss">Incline Bench press</option>
              <option value="Decline Bench press">Decline Bench press</option>
              <option value="Cable cross">Cable cross</option>
              <option value="Dumbbell curls">Dumbbell curls</option>
              <option value="Barbell curls">Barbell curls</option>
              <option value="Cable curls">Cable curls</option>
              <option value="Rope push-downs">Rope push-downs</option>
              <option value="Cable Pull-downs">Cable Pull-downs</option>
              <option value="Back machine">Back machine</option>
              <option value="Lunges">Lunges</option>
              <option value="Squats">Squats</option>
              <option value="Leg Press">Leg Press</option>
            </select>
            <select type="number" name="statchoice">
              <option value=2>Personal Records</option>
              <option value=3>Personal Worsts :(</option>
              <option value=4>Average Exercise Weights</option>
              <option value=5>Total Times Performed</option>
            </select>
            <select type="number" name="bodyw">
              <option value=150>Gym Bro Body Weight: <150 lbs</option>
              <option value=200>Gym Bro Body Weight: <200 lbs</option>
              <option value=250>Gym Bro Body Weight: <250 lbs</option>
              <option value=300>Gym Bro Body Weight: <300 lbs</option>
            </select>
            <input type="submit" value="Submit" name="nest">
        </form>
        <?PHP printResultForAggregation($prg);?>
    </div>

    <div class="col-md-6">
        <h3 class="lg-txt">Delete Quitters</h3>
        <?PHP printMultAtrResult($show);?>
        <h4 class="wrapper">Now please <strong>carefully</strong> type in the ID of the Gym Bro you wish to remove <strong>(this is permanent)</strong> </h4>

        <form method="post" class="wrapper">
          <input type="number" name="delete">
          <input type="submit" name="delsubmit">
        </form>
    </div>




  	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) and links to other JS files-->
  	<script src="js/jquery.min.js"></script>

  	<!-- Include all compiled plugins (below), or include individual files as needed -->
  	<script src="js/bootstrap.min.js"></script>

  	<!-- Login Javascipt -->
  	<script src="js/logout.js"></script>
    <script src="js/date.js"></script>
  </body>
  </html>