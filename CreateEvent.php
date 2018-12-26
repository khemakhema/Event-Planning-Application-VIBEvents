<?php  

    /* Start the session if the session is active via the user logging in */
    if (session_status() !== "") {
    session_start(); 
    }


require_once'Event.php';
$event = new Event('localhost','vibeven2_alexgronowski1','testPW','vibeven2_vibevents');
//$event->createLocationTable();
//$event->createLocationDataTable();
//$event->createEventTable();


    ?>

<!DOCTYPE HTML>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="homepage.css">
<link href="https://fonts.googleapis.com/css?family=Lato|Spectral" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet">

<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">  
 
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<title>Create an Event</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    if(isset($_POST["selectLocation"])) {
        
        echo "<script>var array= [" . $event->generateInvalidDates($event->parseLocation($_POST['locations'])) . "];</script>";
    }
    
    ?>
<script>
  //  alert(disabledDays);
    /* create an array of days which need to be disabled */
 



/* create datepicker */
    
   // var array = ["2019-03-14","2013-03-15","2013-03-16"]

$('#date').datepicker({
    beforeShowDay: function(date){
        var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
        return [ array.indexOf(string) == -1 ]
    }
});
    
jQuery(document).ready(function() {
	$('#date').datepicker({
minDate: 0,
    beforeShowDay: function(date){
        var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
        return [ array.indexOf(string) == -1 ]
    }
});
});
    
</script>
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
                echo '<li><a href="ProfilePage.php">Welcome ' . $_SESSION["username"] . '</a></li>';
                echo '<li class="active"><a href="CreateEvent.php">Create An Event ' . '</a></li>';
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
    <script>
        
            
        
    
    </script>
    
    <?php
    if(isset($_POST["selectLocation"])) {
        
        
        echo '<script>
        $(document).ready(function() {
        $("#giveVal").val("'.$event->parseLocation($_POST['locations']) .'");
        });
        </script>';
    }
    
    if(isset($_POST["createEvent"])) {
        if($event->insertEvent($_POST["locationName"], $_POST["date"], $_POST["events"], $_SESSION["username"])) {
            echo "<div class = bg-primary text-white style = text-align:center;padding-top:15px;padding-bottom:15px;font-size: 20px;>Thank You Your Event Has Been Added</div>";
        }
        else {
            echo "<div class = bg-primary text-white style = text-align:center;padding-top:15px;padding-bottom:15px;font-size: 20px;>Something Went Wrong</div>";

        }
    }
    
    ?>
    <?php
    if (isset($_SESSION["username"])) {
      
        

        echo '<form method = "POST" action = "">
        
         <div class="form-group col-md-4 col-md-offset-4">
    <label for="formGroupExampleInput2">Events Serviced</label>
    <select name="events" size="3" class="form-control">
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
        <div class="form-group col-md-4 col-md-offset-4" style="text-align: center">
<input style = "padding-left: 25px; padding-right: 25px; font-weight: 600" type = "submit" class="btn btn-primary" value = "Select Type of Event" name = "selectType">
              </div>';
        
        
        
        echo '<form method = "POST" action = "">';
        if (isset($_POST["events"])) {
            $event->displayAllLocations($_POST["events"]);
        }
        
        echo  '<div class="form-group col-md-4 col-md-offset-4" style="text-align: center">
<input style = "padding-left: 25px; padding-right: 25px; font-weight: 600" type = "submit" class="btn btn-primary" value = "Select Location Of That Type" name = "selectLocation">
              </div>';
        echo "</form>";
        
        echo '  <form method = "POST" action = "">';
        
    echo '
       
  
  <div class="form-group col-md-4 col-md-offset-4" style="text-align: center">
    <label for="formGroupExampleInput">Location Name</label>
    <input name = "locationName" type="text" class="form-control" placeholder="Please Select a Location From Above" required id = "giveVal">
  </div>
        
    
        
        <div class="form-group col-md-4 col-md-offset-4" style="text-align: center">
  <label for="example-date-input">Date</label>
  <div>
    <input name = "date" class="form-control" id = "date" value="">
  </div>
  <br>
  
  
         <div class="form-group col-md-4 col-md-offset-4">
    <label for="formGroupExampleInput2">Select Type of Event</label>
    <select name="events" class="form-control">
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
<input style = "padding-left: 25px; padding-right: 25px; font-weight: 600" type = "submit" class="btn btn-primary" value = "Create Event" name = "createEvent">
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