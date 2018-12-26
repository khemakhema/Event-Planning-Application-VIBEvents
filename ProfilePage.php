<?php

if (session_status() !== "") {
    session_start(); 
    }
?>
<!DOCTYPE HTML>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="Signup.css">
<link href="https://fonts.googleapis.com/css?family=Lato|Spectral" rel="stylesheet">

<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">  

<link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet"> 
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<title>Profile</title>
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
              <li><a href="Home.php">Home</a></li>
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
                echo '<li class="active"><a href="ProfilePage.php">Welcome ' . $_SESSION["username"] . '</a></li>';
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
    if(!isset($_SESSION["username"])) die("you don't have permissions for this page");
require_once'Profile.php';
$profile = new Profile('localhost','vibeven2_alexgronowski1','testPW','vibeven2_vibevents');
$info =  $profile->getProfileInformation($_SESSION["username"]);
$info = explode(" ", $info);
?>
    
    <div class="container" style = "text-align:center;">
  <div class="jumbotron">
    <h1>Your Profile</h1>      
  </div>
    

    
    <div class = "text-align:center">
    <?php
        echo "
        
        
         <table class='table table-hover'>
    
    <tbody>
  <thead>
      <tr>
        <th></th>
        <th></th>
        
      </tr>
    </thead>
      <tr>
        <td>Username</td>
        <td>{$info[0]}</td>
       
      </tr>
      <tr>
        <td>Email</td>
        <td>{$info[1]}</td>
       
      </tr>
      <tr>
        <td>First Name</td>
        <td>{$info[2]}</td>
       
      </tr>
      <tr>
        <td>Last Name</td>
        <td>{$info[3]}</td>
       
      </tr>
      
       <tr>
        <td>Phone Number</td>
        <td>{$info[4]}</td>
       
      </tr>
      
        <tr>
        <td>Home Address</td>
        <td>{$info[5]}</td>
       
      </tr>
      
    </tbody>
  </table>
        
        ";
        
    ?>
    </div>
    
    </div>
    
</body>
</html>