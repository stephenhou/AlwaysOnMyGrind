<?php
ini_set('session.save_path', '/home/x/x3b0b/public_html/session');
session_start();

include 'Selection_Projection.php';

$gid = $_SESSION['gid'];
$na = $_SESSION['na'];
$ew = $_SESSION['ew'];

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
  		<h1 class="login"><button type="button" class="btn-lg btn-danger" id="logout">Log Out</button></h1>
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
  					<a class="navbar-brand" href="#">AOMG</a>
  				</div>

  				<!-- Collect the nav links, forms, and other content for toggling -->
  				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
  					<ul class="nav navbar-nav">
  						<li class="active"><a href="myworkouts.php">Search<span class="sr-only">(current)</span></a></li>
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
       	<h3 class="lg-txt">Find a Trainer by Age</h3>
          <form class="wrapper" method="post">
            <select type="number" name="age">
              <option value=20>20</option>
              <option value=25>25</option>
              <option value=30>30</option>
              <option value=35>35</option>
              <option value=40>40</option>
              <option value=45>45</option>
              <option value=50>50</option>
              <option value=55>55</option>
              <option value=60>60</option>
            </select>
            <input type="submit" value="Submit" name="nameandage">
          </form>
          <?PHP printResult($na);?>
          
    </div>


    <div class="col-md-6">
        <h3 class="lg-txt">Find a Trainer Email by Weight</h3>
          <form class="wrapper" action="mytrainers.php" method="post">
            <select name="weight">
              <option value=180>180</option>
              <option value=190>190</option>
              <option value=210>210</option>
              <option value=220>220</option>
              <option value=230>230</option>
              <option value=240>240</option>
              <option value=250>250</option>
              <option value=260>260</option>
              <option value=270>270</option>
              <option value=280>280</option>
              <option value=290>290</option>
              <option value=300>300</option>
            </select>
            <input type="submit" value="Submit" name="emailandweight">
          </form>
          <?PHP printResult($ew); ?>
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