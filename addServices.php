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
<title>Add Services</title>
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
require_once'AddServicesCompany.php';
    /* Start the session if the session is active via the user logging in */
   

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["events"]) && isset($_POST["services"])) {
        $vendor = new AddServices('localhost','vibeven2_alexgronowski1','testPW','vibeven2_vibevents', $_SESSION["companyName"], $_POST["events"], $_POST["services"]);
    $vendor->createVendorDataTable();
    $vendor->insert();
        echo "<div class='text-primary' style = 'text-align:center; font-size: 150%;font-weight: 600;'>Thank you For Adding Your Services and Event Type</div>";
    }
   else {
       echo "<div class='text-danger' style = 'text-align:center; font-size: 150%;font-weight: 600;'>Please select a service and event type</div>";
   }
}

    ?>
    
    <?php
    if(isset($_SESSION["companyName"])) {
        echo '
    <form method = "POST" action = "">
  
        
        
        
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
    <label for="formGroupExampleInput2">Services Offered</label>
    <select name="services[]" size="3" multiple="multiple" class="form-control">
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
<input style = "padding-left: 25px; padding-right: 25px; font-weight: 600" type = "submit" class="btn btn-primary" value = "Submit Your Services">
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