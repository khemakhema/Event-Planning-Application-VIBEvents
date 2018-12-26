<?php  
    /* Start the session if the session is active via the user logging in */
    if (session_status() !== "") {
    session_start(); 
    }

    ?>

<!DOCTYPE HTML>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Lato|Spectral" rel="stylesheet">

<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">  

<link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet"> 
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<title>View All Events</title>
<style>
div.col-sm-12 {
color: #008080;
margin-bottom: 15px;
font-size: 22px;
}

form {
height: 200px;
}

#snackbar {

    min-width: 250px;
    margin-left: -125px;
    background-color: #333;
    color: #fff;
    text-align: center;
    border-radius: 2px;
    padding: 16px;
    position: fixed;
    z-index: 1;
    left: 50%;
    bottom: 30px;
    font-size: 17px;
}
</style>
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
              <li class="active"><a href="ViewAllEvents.php">View All Your Events</a></li>
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
                // Welcome AdminUsername
                if (isset($_SESSION["adminUsername"])) {
                echo '<li><a href="ProfilePage.php">Welcome ' . $_SESSION["adminUsername"] . '</a></li>';
                echo '<li><a href="CreateEvent.php">Create An Event ' . '</a></li>';
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
    <div class="col-sm-6"><a style = "color:white;"  href="CreateLocation.php">Create your Location</a></div>
  </div>
        ';
  
        echo "</div>";
    }

if(isset($_SESSION["username"])) {
require_once'Event.php';
$event = new Event('localhost','vibeven2_alexgronowski1','testPW','vibeven2_vibevents');
if (empty($_GET)) {
    echo "<div class = bg-primary text-white style = text-align:center;padding-top:15px;padding-bottom:15px;font-size: 20px;margin-bottom:30px;>To Add a Vendor Click on Your Event Box!</div>";
$event->selectAllEventsBasedOnUsername($_SESSION["username"]);
}

else {
if(!empty($_GET["place"]) && !empty($_GET["date"])) {
echo "<div id=snackbar>Selected Your Event on " . $_GET["date"] . " at the " . $_GET["place"] . "</div>";
echo   '<form method = "POST" action = "">
         <div class="form-group col-md-4 col-md-offset-4">
    <label for="formGroupExampleInput2">Search For Services Offered</label>
    <select name="services" size="3" class="form-control">
        <option>Wedding Cakes</option>
        <option>Baked Goods</option>
        <option>Birthday Cakes</option>
        <option>Catered Food</option>
        <option>Spanish Food</option>
        <option>Chinese Food</option>
        <option>Japenese Food</option>
        <option>Cuban Food</option>
        <option>Italian Food</option>
        <option>Security</option>
        <option>Tables & Chairs</option>
      </select>
  </div>
        
     
        
        <div class="form-group col-md-4 col-md-offset-4">
<input style = "padding-left: 25px; padding-right: 25px; font-weight: 600" type = "submit" class="btn btn-primary" value = "Search For Vendors" name = "search">
              </div>
</form>';
if($_SERVER["REQUEST_METHOD"] == "POST") {
if(isset($_POST["search"])) {

echo $event->selectVendor($_GET["place"], $event->selectType($_GET["place"], $_GET["date"]), $_POST["services"]);
}

if(isset($_POST["selection"])) {
$pieces = explode(":", $_POST["selection"]);
if($event->insertVendorForEvent($_GET["place"], $_GET["date"], $pieces[1])) {
echo "Inserted";
}

else {
echo "Could not insert";
}
    }
}
else {
echo $event->selectVendor($_GET["place"], $event->selectType($_GET["place"], $_GET["date"], ""));
}
}
}
}
    ?>
    
</body>
</html>