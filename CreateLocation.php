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
<link rel="stylesheet" href="Signup.css">
<link href="https://fonts.googleapis.com/css?family=Lato|Spectral" rel="stylesheet">

<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 

<link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet"> 
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<title>Create Location</title>
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
require_once'CreateLocationClass.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$location = new CreateLocation('localhost','vibeven2_alexgronowski1','testPW','vibeven2_vibevents', $_POST["locationName"], $_POST["locationAddress"], $_POST["email"], $_SESSION["companyName"], $_POST["max"], $_POST["description"], $_POST["events"]);
if($location->insertLocations()) {
echo "<div class='text-primary' style = 'text-align:center; font-size: 150%;font-weight: 600;'>Your Location Has Been Created</div>";
}
}

?>
    <?php
    if(isset($_SESSION["companyName"])) {
    echo '
    <form method = "POST" action = "">
  <div class="form-group col-md-4 col-md-offset-4">
    <label for="formGroupExampleInput">Location Name</label>
    <input pattern=".{1,50}" required title="1 to 50 characters" name = "locationName" type="text" class="form-control" placeholder="Enter Your Location Name" required>
  </div>
        

   <div class="form-group col-md-4 col-md-offset-4">
    <label for="formGroupExampleInput">Location Address</label>
    <input name = "locationAddress" type="text" class="form-control" placeholder="Enter The Address of Your Location" required>
  </div>
        
        <div class="form-group col-md-4 col-md-offset-4">
    <label for="formGroupExampleInput">Enter the owner\'s email For This Location</label>
    <input name = "email" type="email" class="form-control" placeholder="Enter the owner\'s email For This Location" required>
  </div>  
  
  
        
       <div class="form-group col-md-4 col-md-offset-4">
    <label for="formGroupExampleInput">Enter the Number of Max Attendees</label>
    <input name = "max" type="number" class="form-control" placeholder="Enter the Number of Max Attendees" required>
  </div>    
  
    <div class="form-group col-md-4 col-md-offset-4">
    <label for="formGroupExampleInput">Enter A Description of this venue</label>
    <textarea name = "description" class="form-control" placeholder="Enter the Number of Max Attendees" required>
    </textarea>
  </div> 

<div class="form-group col-md-4 col-md-offset-4">
    <label for="formGroupExampleInput2">Events Serviced</label>
    <select name="events[]" size="3" multiple="multiple" class="form-control">
        <option>Weddings</option>
        <option>Birthdays</option>
        <option>Bridal Showers</option>
        <option>Baby Showers</option>
        <option>Corporate Events</option>
        <option>Catering</option>
        <option>Graduation Parties</option>
        <option>Meetings</option>
        <option>Appreciations Events</option>
        <option>Board Meetings</option>
        <option>Investor Meetings</option>
      </select>
  </div>
      
        
        <div class="form-group col-md-4 col-md-offset-4">
<input style = "padding-left: 25px; padding-right: 25px; font-weight: 600" type = "submit" class="btn btn-primary" value = "Submit Location">
              </div>
</form>
';
    }
        else {
            echo "<div class='text-danger' style = 'text-align:center; font-size: 150%;font-weight: 600;'>You do not have valid permissions for this page.</div>";
        }
        
        ?>
    
</body>
</html>