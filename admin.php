<!DOCTYPE HTML>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="homepage.css">
<link href="https://fonts.googleapis.com/css?family=Lato|Spectral" rel="stylesheet">

<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">  

<link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet"> 
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<title>Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
	

div#main-content { display: none; }
</style>
 
</head>
<body>
<script>
    $(document).ready(function() {
    $('#main-content').fadeIn(900);
});
</script>

    <div id = "main-content">
    
    
<nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="">VibEvents</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="Home.php">Home</a></li>
              <li><a href="About.php">About</a></li>
              <?php
                if (isset($_SESSION["username"]) && !isset($_SESSION["companyName"])) {
                    echo '<li><a href="ViewAllEvents.php">View All Your Events</a></li>';
                 } 
              ?>      
              <!-- <li><a href="ViewAllEvents.php">View All Your Events</a></li> -->
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
           
          if (!isset($_SESSION["username"]) && !isset($_SESSION["companyName"])) {
                echo '<li><a href="Login.php">Login</a></li>
              <li><a href="Signup.php">Sign Up</a></li>';
              echo '<li><a href="VendorSignup.php">Vendor Sign Up</a></li>';
              echo '<li><a href="VendorLogin.php">Vendor Log In</a></li>';
            }
            
                if (isset($_SESSION["username"])) {
                echo '<li><a href="ProfilePage.php">Welcome ' . $_SESSION["username"] . '</a></li>';
                echo '<li><a href="CreateEvent.php">Create An Event ' . '</a></li>';
                echo '<li><a href="Signout.php">Sign Out</a></li>';
                }
                
                if(isset($_SESSION["companyName"])) {
                    echo '<li><a href="ProfilePage.php">Welcome ' . $_SESSION["companyName"] . '</a></li>';
                echo '<li><a href="Signout.php">Sign Out</a></li>';
                    
                
                }
                
               
            
          
          ?>
              
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

<?php
require_once"honey.php";

$honey = new Honey('localhost','vibeven2_alexgronowski1','testPW','vibeven2_vibevents');

if($_SERVER["REQUEST_METHOD"] == "POST") {
$honey->log($_SERVER['HTTP_X_FORWARDED_FOR']);

}

?>
<h2 style = "text-align: center"> Welcome admin please use the username: admin and password: admin to login onto the admin panel </h2>
<h1 style = "text-align:center;color:red;">THIS IS A SECRET WEBSITE DON'T SHARE THE LINK WITH ANYONE </h1>
    <form method = "POST" action = "">
  <div class="form-group col-md-4 col-md-offset-4">
    <label for="formGroupExampleInput">Username</label>
    <input pattern=".{5,10}" required title="5 to 10 characters" name = "username" type="text" class="form-control" placeholder="Enter Your Username" required>
  </div>
<div class="col-md-4">
</div>
    <style>
    	
    </style>
        
         <div class="form-group col-md-4 col-md-offset-4">
    <label for="formGroupExampleInput2">Password</label>
    <input pattern=".{5,10}" required title="5 to 10 characters" name = "password" type="password" class="form-control" placeholder="Enter your Password" required>
  </div>
        
        <div class="form-group col-md-4 col-md-offset-4">
<input style = "padding-left: 25px; padding-right: 25px; font-weight: 600" type = "submit" class="btn btn-primary" value = "Log In">
              </div>
</form>


</body>
</html>