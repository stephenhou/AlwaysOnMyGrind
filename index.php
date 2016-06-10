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
<<<<<<< HEAD

      <div class="col-md-6">
        <h1 class="title">Always On My Grind</h1>
      </div>
      <div class="col-md-6">
        <h1 class="login"><button type="button" class="btn-lg btn-danger" id="show_login" value="Show Login">Log in</button></h1>
      </div>

      <center>

        <form id="loginform" method = "post" action = "login.php">
          <p>Login to see your workouts</p>
            <i class="fa fa-close" id = "close_login"></i>
            <input type = "text" id = "login" placeholder = "Username" name = "uid">
            <input type = "password" id = "password" name = "upass" placeholder = "Password">
            <input type = "submit" id = "dologin" value = "Login">
          </form>

      </center>
=======
      <h1>Always On My Grind AOMGAOMG</h1>
>>>>>>> 371c08c6ef1fda0bd33fdb647631bc7e244042cc

      <div class="col-md-6">
        <h3 class="lg-txt">Let's build a <br>better you.</h3>
        <div class="checklist">
          <i class="fa fa-check"></i>Manage your workouts<br><br>
          <i class="fa fa-check"></i>Find helpful trainers<br><br>
          <i class="fa fa-check"></i>Achieve your goals
        </div> 
      </div>
      <div class="col-md-6">
        <h3 class="lg-txt">Sign Up</h3>

        <form id="regForm" action="submit.php" method="post">

          <div class="col-md-6 spacing">
            <input type="text" class="fld" name="fname" value="" placeholder="First Name">
          </div>

          <div class="col-md-6 spacing">
            <input type="text" class="fld" name="lname" value="" placeholder="Last Name">
          </div>
          <div class="col-md-12 spacing">
            <input type="text" class="fld" name="email" value="" placeholder="Your email address">
          </div>
          <div class="col-md-12 spacing">
            <input type="text" class="fld" name="username" value="" placeholder="Pick a username">
          </div>
          <div class="col-md-12 spacing">
            <input type="text" class="fld" name="password" value="" placeholder="Create a password">
          </div>
          <div class="wrapper">
            <button type="button" class="btn-lg btn-danger">Sign up!</button>
          </div>

        </form>

      </div>




      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) and links to other JS files-->
      <script src="js/jquery.min.js"></script>

      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="js/bootstrap.min.js"></script>

      <!-- Login Javascipt -->
      <script src="js/login.js"></script>
    </body>
    </html>