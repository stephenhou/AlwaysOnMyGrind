<?php
ini_set('session.save_path', '/home/w/w9g0b/public_html/session');
session_start();

include 'join.php';
include 'division.php';
include 'aggregation.php';

if (!(isset($_SESSION['gid']) && $_SESSION['gid'] != '')) {
    header ("Location: index.php");
  }

$gid = $_SESSION['gid'];
$exFromEquip = $_SESSION['exFromEquip'];
$bp = $_SESSION['bp'];
$pr = $_SESSION['pr'];

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
  		<h1 class="login"><a type="button" class="btn-lg btn-danger" href="logout.php">Log Out</a></h1>
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
  					<a class="navbar-brand" href="main.php">AOMG</a>
  				</div>

  				<!-- Collect the nav links, forms, and other content for toggling -->
  				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
  					<ul class="nav navbar-nav">
  						<li class="active"><a href="myworkouts.php">My Workouts<span class="sr-only">(current)</span></a></li>
  						<li><a href="myexercises.php">My Exercises</a></li>
  						<li class="active"><a href="mytrainers.php">My Trainers</a></li>
  						<li><a href="myappointments.php">My Appointments</a></li>
  					</ul>
  					<ul class="nav navbar-nav navbar-right">
  						<li class="active"><a href="aboutus.php">About Us</a></li>
  					</ul>
  				</div><!-- /.navbar-collapse -->
  			</div><!-- /.container-fluid -->
  		</nav>
  	</div>

  	<div class="col-md-6">
       	<h3 class="lg-txt">Find Exercises for your Equipment!</h3>
          <form class="wrapper spacing" method="post">
            <select type="text" name="equipName">
              <option value="bench">Bench</option>
              <option value="squat rack">Squat Rack</option>
              <option value="all mighty machine">All Mighty Machine</option>
              <option value="dumbbells">Dumbbells</option>
              <option value="barbell">Barbell</option>
              <option value="treadmill">Treadmill</option>
              <option value="bike">Bike</option>
              <option value="water">Water</option>
            </select>
            <input type="submit" value="Submit" name="exName_equipName">
          </form>
          <?PHP printResult($exFromEquip);?>
          
    </div>


    <div class="col-md-6">
        <h3 class="lg-txt">Find Exercises that Train Your Whole Body!</h3>
          <form class="wrapper spacing" method="post">
            <input type="submit" value="Submit" name="all_bodyparts">
          </form>
          <?PHP printResult($bp);?>
    </div>
    <div class="col-md-12">
        <h3 class="lg-txt">Cool Stats!</h3>
          <form class="wrapper spacing" method="post">
            <select type="number" name="statchoice">
              <option value=2>Personal Records</option>
              <option value=3>Personal Worsts :(</option>
              <option value=4>Average Exercise Weights</option>
              <option value=5>Total Times Performed</option>
            </select>
            <input type="submit" value="Submit" name="agr">
          </form>
          <?PHP printResultForAggregation($pr);?>
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