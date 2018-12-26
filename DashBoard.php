<?php  
require_once"Management.php";
$manage = new Manage('localhost', 'alexgronowski1', 'testPW', 'vibevents');

    /* Start the session if the session is active via the user logging in */
    if (session_status() !== "") {
    session_start(); 
    }

    ?>

<!DOCTYPE HTML>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="homepage.css">
<link href="https://fonts.googleapis.com/css?family=Lato|Spectral" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet"> 
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<title>Home</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
</head>
<body>
<script>
    
</script>
    
    
    
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
              <li><a href="ViewAllEvents.php">View All Your Events</a></li>
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
    if(isset($_SESSION["companyName"])) {
        echo '<div class="container-fluid" style = "text-align: center; background-color: #232AD8;">';
        
        echo '
        <div class="row card">
    <div class="col-sm-6"><a style = "color:white;" href="addServices.php">Add The Services You Offer</a></div>
    <div class="col-sm-6"><a style = "color:white;"  href="../navbar-static-top/">Create your Location</a></div>
  </div>
        ';
  
        echo "</div>";
    }
    
    
    ?>
    
    <?php
    if (isset($_SESSION["username"])) {
                echo '<div class="container">
  <div class="jumbotron" style = "text-align: center; padding-top:25px;padding-bottom: 25px;">
    <h2>Create An Event</h2>      
  </div>
</div>';
        
        echo '  <form method = "POST" action = "">
  <div class="form-group col-md-4 col-md-offset-4">
    <label for="formGroupExampleInput">Location Name</label> ';
    $manage->displayAllLocations();
   echo '</div>';
  
        
        
    }
    else {
        echo "You don't Have Access to this page";
    }
    
    ?>
    
    
</body>
</html>